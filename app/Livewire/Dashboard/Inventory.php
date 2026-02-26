<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Inventory extends Component
{
    public $search = '';

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('livewire.dashboard.inventory')
            ->layout('layouts.dashboard');
    }
}
