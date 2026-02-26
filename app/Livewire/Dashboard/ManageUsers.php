<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class ManageUsers extends Component
{
    public $search = '';
    public $status = 'all';

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('livewire.dashboard.manage-users')
            ->layout('layouts.dashboard');
    }
}
