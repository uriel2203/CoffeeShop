<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Reports extends Component
{
    public $search = '';

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('livewire.dashboard.reports')
            ->layout('layouts.dashboard');
    }
}
