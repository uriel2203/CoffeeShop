<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Ingredients extends Component
{
    public $search = '';

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('livewire.dashboard.ingredients')
            ->layout('layouts.dashboard');
    }
}
