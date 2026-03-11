<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Ingredient;
use Livewire\WithPagination;

class Ingredients extends Component
{
    use WithPagination;

    // Search property
    public $search = '';

    // Form properties
    public $ingredientId = null;
    public $unit = '';
    public $lowStockThreshold = 100;
    public $criticalStockThreshold = 50;

    // UI state
    public $showModal = false;

    /**
     * Reset pagination when search changes.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Prepare form for creating a new ingredient.
     */
    public function createIngredient()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /**
     * Prepare form for editing an existing ingredient.
     */
    public function editIngredient($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $this->ingredientId = $ingredient->id;
        $this->name = $ingredient->name;
        $this->category = $ingredient->category;
        $this->unit = $ingredient->unit;
        $this->lowStockThreshold = $ingredient->low_stock_threshold;
        $this->criticalStockThreshold = $ingredient->critical_stock_threshold;
        $this->showModal = true;
    }

    /**
     * Reset form fields to defaults.
     */
    private function resetForm()
    {
        $this->ingredientId = null;
        $this->name = '';
        $this->category = '';
        $this->unit = '';
        $this->lowStockThreshold = 100;
        $this->criticalStockThreshold = 50;
    }

    /**
     * Save/Update ingredient data.
     */
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:ingredients,name,' . $this->ingredientId,
            'category' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'lowStockThreshold' => 'required|numeric|min:0',
            'criticalStockThreshold' => 'required|numeric|min:0',
        ]);

        $data = [
            'name' => $this->name,
            'category' => $this->category,
            'unit' => $this->unit,
            'low_stock_threshold' => $this->lowStockThreshold,
            'critical_stock_threshold' => $this->criticalStockThreshold,
        ];

        // Track if this is a new ingredient to ensure default amount 0
        $isNew = $this->ingredientId === null;
        if ($isNew) {
            $data['amount'] = 0;
        }

        Ingredient::updateOrCreate(['id' => $this->ingredientId], $data);

        $this->showModal = false;
        $this->resetForm();
        
        session()->flash('message', $isNew ? 'New ingredient defined successfully. Add stock in the Inventory module.' : 'Ingredient definition updated.');
    }

    /**
     * Render the component with search and pagination.
     */
    public function render()
    {
        $query = Ingredient::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
            });

        // Fetch existing categories for the form datalist
        $existingCategories = Ingredient::select('category')->distinct()->pluck('category');

        return view('livewire.dashboard.ingredients', [
            'ingredients' => $query->orderBy('id', 'asc')->paginate(10),
            'existingCategories' => $existingCategories
        ])->layout('layouts.dashboard');
    }
}
