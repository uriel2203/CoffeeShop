<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class Orders extends Component
{
    public $search = '';

    /**
     * Cancel an order and return stock.
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
            
            session()->flash('message', 'Order cancelled and stock returned.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error cancelling order: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $orders = Order::with('items.product.ingredients')
            ->where(function($q) {
                $q->where('order_number', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.dashboard.orders', [
            'orders' => $orders
        ])->layout('layouts.dashboard');
    }
}
