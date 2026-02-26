<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Inventory as InventoryModel;
use App\Models\Ingredient;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Inventory extends Component
{
    use WithPagination;

    // Search property (filters by ingredient name)
    public $search = '';

    // Form properties for "Stock In"
    public $ingredient_id = '';
    public $amount = 0;
    public $expiry_date = '';

    // Form properties for "Edit Adjustment"
    public $editingName = '';
    public $editingAmount = 0;
    public $editingExpiry = '';

    // UI state
    public $showModal = false;
    public $showEditModal = false;

    /**
     * Property updates that trigger page reset (for real-time search)
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Opens the "Stock In" modal and resets form fields.
     */
    public function openStockInModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /**
     * Processes the "Stock In" request.
     */
    public function stockIn()
    {
        $this->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'amount' => 'required|numeric|min:0.01',
            'expiry_date' => 'nullable|date',
        ]);

        $ingredient = Ingredient::find($this->ingredient_id);

        // 1. Create the inventory record
        InventoryModel::create([
            'ingredient_id' => $this->ingredient_id,
            'amount' => $this->amount,
            'expiry_date' => $this->expiry_date ?: null,
        ]);

        // 2. Increment the total stock
        $ingredient->amount += $this->amount;
        $ingredient->save();

        $this->showModal = false;
        $this->resetForm();

        session()->flash('message', "Stock added successfully for {$ingredient->name}!");
    }

    /**
     * Prepare for editing a summarized ingredient group.
     */
    public function editSummarized($name)
    {
        $this->editingName = $name;
        
        // Sum total amount for all ingredients with this name
        $this->editingAmount = Ingredient::where('name', $name)->sum('amount');

        // Get the latest expiry recorded for this ingredient name
        $this->editingExpiry = InventoryModel::whereHas('ingredient', function($q) use ($name) {
                $q->where('name', $name);
            })
            ->latest()
            ->value('expiry_date');

        $this->showEditModal = true;
    }

    /**
     * Save adjustments to a summarized ingredient group.
     */
    public function saveAdjustment()
    {
        $this->validate([
            'editingAmount' => 'required|numeric|min:0',
            'editingExpiry' => 'nullable|date',
        ]);

        // 1. Update the latest inventory record for expiry tracking
        $latestInventory = InventoryModel::whereHas('ingredient', function($q) {
                $q->where('name', $this->editingName);
            })
            ->latest()
            ->first();

        if ($latestInventory) {
            $latestInventory->update(['expiry_date' => $this->editingExpiry ?: null]);
        }

        // 2. Adjust total ingredients amounts to match target sum
        $ingredients = Ingredient::where('name', $this->editingName)->get();
        $currentSum = $ingredients->sum('amount');
        $diff = $this->editingAmount - $currentSum;

        if ($diff != 0 && $ingredients->count() > 0) {
            // Apply all difference to the first record for simplicity in this summarized context
            $first = $ingredients->first();
            $first->amount += $diff;
            $first->save();
        }

        $this->showEditModal = false;
        session()->flash('message', "Inventory for {$this->editingName} adjusted successfully.");
    }

    /**
     * Resets form fields.
     */
    private function resetForm()
    {
        $this->ingredient_id = '';
        $this->amount = 0;
        $this->expiry_date = '';
    }

    /**
     * Renders summarized list of ingredients.
     */
    public function render()
    {
        // Fetch unique ingredient names and their sums
        $query = Ingredient::select('name', 'unit', 'category', DB::raw('SUM(amount) as total_amount'))
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->groupBy('name', 'unit', 'category');

        $summarizedData = $query->paginate(10);

        // Attach latest expiry date and last updated info to each summarized row
        $summarizedData->getCollection()->transform(function($item) {
            $latestEntry = InventoryModel::whereHas('ingredient', function($q) use ($item) {
                    $q->where('name', $item->name);
                })
                ->latest()
                ->first();

            $item->latest_expiry = $latestEntry ? $latestEntry->expiry_date : null;
            $item->last_added = $latestEntry ? $latestEntry->created_at : null;
            $item->last_updated = $latestEntry ? $latestEntry->updated_at : null;
            
            return $item;
        });

        return view('livewire.dashboard.inventory', [
            'inventoryHistory' => $summarizedData,
            'ingredients' => Ingredient::orderBy('name', 'asc')->get()
        ])->layout('layouts.dashboard');
    }
}
