<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Product;
use App\Models\Ingredient;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;

class Products extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(history: true)]
    public $search = '';

    // Form properties
    public $productId = null;
    public $name = '';
    public $category = '';
    public $price = '';
    public $is_available = true;
    public $image;
    public $existingImage;

    // Recipe Builder
    public $selectedIngredients = []; // Array of { ingredient_id, amount }
    public $ingredientToAdd = '';
    public $amountToAdd = '';

    // UI state
    public $showModal = false;
    public $showDeleteModal = false;
    public $productToDelete = null;

    /**
     * Reset pagination when searching.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Prepare for creating a new product.
     */
    public function createProduct()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /**
     * Prepare for editing an existing product.
     */
    public function editProduct($id)
    {
        $product = Product::with('ingredients')->findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category = $product->category;
        $this->price = $product->price;
        $this->is_available = $product->is_available;
        $this->existingImage = $product->image_path;
        
        $this->selectedIngredients = $product->ingredients->map(function ($ingredient) {
            return [
                'id' => $ingredient->id,
                'name' => $ingredient->name,
                'unit' => $ingredient->unit,
                'amount' => $ingredient->pivot->amount,
            ];
        })->toArray();

        $this->showModal = true;
    }

    /**
     * Add an ingredient to the recipe list.
     */
    public function addIngredient()
    {
        $this->validate([
            'ingredientToAdd' => 'required|exists:ingredients,id',
            'amountToAdd' => 'required|numeric|min:0.01',
        ]);

        $ingredient = Ingredient::find($this->ingredientToAdd);


        $this->selectedIngredients[] = [
            'id' => $ingredient->id,
            'name' => $ingredient->name,
            'unit' => $ingredient->unit,
            'amount' => $this->amountToAdd,
        ];

        $this->ingredientToAdd = '';
        $this->amountToAdd = '';
    }

    /**
     * Remove an ingredient from the recipe list.
     */
    public function removeIngredient($index)
    {
        unset($this->selectedIngredients[$index]);
        $this->selectedIngredients = array_values($this->selectedIngredients);
    }

    /**
     * Save or update product details.
     */
    public function save()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255|unique:products,name,' . $this->productId,
                'category' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|max:2048', // 2MB Max
                'selectedIngredients' => 'required|array|min:1',
            ], [
                'selectedIngredients.required' => 'At least one ingredient is required for this product.',
            ]);

            $imagePath = $this->existingImage;
            if ($this->image) {
                // Delete old image if it exists
                if ($this->existingImage) {
                    Storage::delete($this->existingImage);
                }
                // Store the new image in the 'products' directory within the 'public' disk.
            // This maps to storage/app/public/products.
            // NOTE: 'php artisan storage:link' MUST be run for these to be web-accessible via the /storage/ URL.
            $imagePath = $this->image->store('products', 'public');
            }

            \Illuminate\Support\Facades\DB::transaction(function () use ($imagePath) {
                // 1. Validate Stock Availability (Only for NEW products)
                if (!$this->productId) {
                    foreach ($this->selectedIngredients as $item) {
                        $ingredient = Ingredient::find($item['id']);
                        if ($ingredient->amount < $item['amount']) {
                            throw new \Exception("Insufficient stock for {$ingredient->name}. Need {$item['amount']}, have {$ingredient->amount}.");
                        }
                    }
                    
                    // 2. Deduct stock
                    foreach ($this->selectedIngredients as $item) {
                        $ingredient = Ingredient::find($item['id']);
                        $ingredient->decrement('amount', $item['amount']);
                    }
                }

                // 3. Save Product
                $product = Product::updateOrCreate(['id' => $this->productId], [
                    'name' => $this->name,
                    'category' => $this->category,
                    'price' => $this->price,
                    'is_available' => $this->is_available,
                    'image_path' => $imagePath,
                ]);

                // 4. Sync ingredients
                $syncData = [];
                foreach ($this->selectedIngredients as $item) {
                    $ingredientId = $item['id'];
                    if (!isset($syncData[$ingredientId])) {
                        $syncData[$ingredientId] = ['amount' => 0];
                    }
                    $syncData[$ingredientId]['amount'] += $item['amount'];
                }
                $product->ingredients()->sync($syncData);
            });

            $this->showModal = false;
            $this->resetForm();
            session()->flash('message', 'Product saved and inventory updated successfully.');
        } catch (\Exception $e) {
            session()->flash('recipe_error', $e->getMessage());
        }
    }

    /**
     * Delete product.
     */
    public function delete()
    {
        if ($this->productToDelete) {
            $product = Product::findOrFail($this->productToDelete);
            if ($product->image_path) {
                Storage::delete($product->image_path);
            }
            $product->delete();
            $this->showDeleteModal = false;
            $this->productToDelete = null;
            session()->flash('message', 'Product deleted successfully.');
        }
    }

    /**
     * Reset form fields.
     */
    private function resetForm()
    {
        $this->productId = null;
        $this->name = '';
        $this->category = '';
        $this->price = '';
        $this->is_available = true;
        $this->image = null;
        $this->existingImage = null;
        $this->selectedIngredients = [];
        $this->ingredientToAdd = '';
        $this->amountToAdd = '';
    }

    /**
     * Render the component with search and pagination.
     */
    public function render()
    {
        $query = Product::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
            });

        return view('livewire.dashboard.products', [
            'products' => $query->with('ingredients')->latest()->paginate(10),
            'allIngredients' => Ingredient::orderBy('category')->orderBy('name')->get()->groupBy('category'),
            'existingCategories' => Product::select('category')->distinct()->pluck('category')
        ])->layout('layouts.dashboard');
    }
}
