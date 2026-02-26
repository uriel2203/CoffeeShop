<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Orders extends Component
{
    public $search = '';

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('livewire.dashboard.orders')
            ->layout('layouts.dashboard');
    }
}
