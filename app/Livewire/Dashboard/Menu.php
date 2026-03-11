<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Menu extends Component
{
    /**
     * Search term for filtering products.
     * Integrated with Livewire for real-time updates.
     */
    public $search = '';

    /**
     * Currently selected category.
     */
    public $activeCategory = 'All';

    // Order/Cart State
    public $cart = []; // Array of { product_id, name, price, quantity, total }
    public $customerName = '';
    public $discountType = 'none'; // none, senior, pwd
    public $paymentMethod = 'cash'; // cash, gcash
    public $cashTendered = '';
    
    // UI State
    public $showReceipt = false;
    public $lastOrder = null;

    protected $listeners = ['refreshStock' => '$refresh'];

    /**
     * Get products filtered by search and category.
     */
    public function getProductsProperty()
    {
        return Product::with('ingredients')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->activeCategory !== 'All', function ($q) {
                $q->where('category', $this->activeCategory);
            })
            ->where('is_available', true)
            ->get()
            ->filter(fn($p) => $p->hasSufficientStock());
    }

    /**
     * Add product to cart.
     */
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
            $this->cart[$productId]['total'] = $this->cart[$productId]['quantity'] * $this->cart[$productId]['price'];
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'total' => $product->price,
            ];
        }
    }

    /**
     * Increase quantity in cart.
     */
    public function incrementQuantity($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
            $this->cart[$productId]['total'] = $this->cart[$productId]['quantity'] * $this->cart[$productId]['price'];
        }
    }

    /**
     * Decrease quantity or remove from cart.
     */
    public function decrementQuantity($productId)
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
                $this->cart[$productId]['total'] = $this->cart[$productId]['quantity'] * $this->cart[$productId]['price'];
            } else {
                $this->removeFromCart($productId);
            }
        }
    }

    /**
     * Remove item from cart.
     */
    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
    }

    /**
     * Calculate Subtotal.
     */
    public function getSubtotalProperty()
    {
        return collect($this->cart)->sum('total');
    }

    /**
     * Calculate Tax (12% VAT included).
     */
    public function getTaxAmountProperty()
    {
        return $this->subtotal * 0.12;
    }

    /**
     * Calculate Discount (20% for Senior/PWD).
     * Applies to the entire subtotal for simplicity in this POS version.
     */
    public function getDiscountAmountProperty()
    {
        if ($this->discountType === 'senior' || $this->discountType === 'pwd') {
            return $this->subtotal * 0.20;
        }
        return 0;
    }

    /**
     * Calculate Grand Total.
     */
    public function getTotalProperty()
    {
        return $this->subtotal - $this->discountAmount;
    }

    /**
     * Calculate Change.
     */
    public function getCashChangeProperty()
    {
        if ($this->paymentMethod === 'cash' && is_numeric($this->cashTendered)) {
            $change = $this->cashTendered - $this->total;
            return $change >= 0 ? $change : 0;
        }
        return 0;
    }

    /**
     * Confirm order and deduct stock.
     */
    public function confirmOrder()
    {
        if (empty($this->cart)) return;

        if ($this->paymentMethod === 'cash' && (!is_numeric($this->cashTendered) || $this->cashTendered < $this->total)) {
            session()->flash('payment_error', 'Insufficient cash tendered.');
            return;
        }

        try {
            DB::transaction(function () {
                // 1. Create Order
                $order = Order::create([
                    'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                    'customer_name' => $this->customerName,
                    'subtotal' => $this->subtotal,
                    'tax_amount' => $this->taxAmount,
                    'discount_type' => $this->discountType,
                    'discount_amount' => $this->discountAmount,
                    'total' => $this->total,
                    'payment_method' => $this->paymentMethod,
                    'cash_tendered' => $this->paymentMethod === 'cash' ? $this->cashTendered : null,
                    'cash_change' => $this->paymentMethod === 'cash' ? $this->cashChange : null,
                    'status' => 'completed',
                ]);

                // 2. Create Order Items and Deduct Stock
                // We use a transaction to ensure either everything saves or nothing does.
                foreach ($this->cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total' => $item['total'],
                    ]);

                    // Deduct ingredients based on the recipe defined in 'product_ingredient' pivot table.
                    // This handles multiple ingredients per product (e.g., beans, milk, sugar).
                    $product = Product::with('ingredients')->find($item['id']);
                    foreach ($product->ingredients as $ingredient) {
                        $deductionAmount = $ingredient->pivot->amount * $item['quantity'];
                        
                        // Check stock again during transaction to prevent race conditions (double spending)
                        $currentStock = DB::table('ingredients')->where('id', $ingredient->id)->value('amount');
                        if ($currentStock < $deductionAmount) {
                            throw new \Exception("Insufficient stock for {$ingredient->name} while processing order.");
                        }

                        DB::table('ingredients')->where('id', $ingredient->id)->decrement('amount', $deductionAmount);
                    }
                }

                $this->lastOrder = $order;
            });

            $this->showReceipt = true;
            $this->cart = [];
            $this->customerName = '';
            $this->cashTendered = '';
            
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    /**
     * Reset everything for a new order.
     */
    public function newOrder()
    {
        $this->showReceipt = false;
        $this->lastOrder = null;
    }

    /**
     * Cancel an order (Return stock).
     */
    public function cancelOrder($orderId)
    {
        try {
            DB::transaction(function () use ($orderId) {
                $order = Order::with('items.product.ingredients')->findOrFail($orderId);
                
                if ($order->status === 'cancelled') return;

                // Return Ingredients
                foreach ($order->items as $item) {
                    if ($item->product) {
                        foreach ($item->product->ingredients as $ingredient) {
                            $returnAmount = $ingredient->pivot->amount * $item->quantity;
                            DB::table('ingredients')->where('id', $ingredient->id)->increment('amount', $returnAmount);
                        }
                    }
                }

                $order->update(['status' => 'cancelled']);
            });
            
            session()->flash('message', 'Order cancelled and stock returned to inventory.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error cancelling order: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dashboard.menu', [
            'products' => $this->products,
            'categories' => Product::select('category')->distinct()->pluck('category'),
            'orders' => Order::latest()->take(5)->get() // For recent orders view
        ])->layout('layouts.dashboard');
    }
}
