<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Products extends Component
{
    public $search = '';

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('livewire.dashboard.products')
            ->layout('layouts.dashboard');
    }
}
