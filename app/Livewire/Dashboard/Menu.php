<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Menu extends Component
{
    /**
     * Search term for filtering products.
     * Integrated with Livewire for real-time updates.
     */
    public $search = '';

    /**
     * Currently selected category.
     */
    public $category = 'All Menus';

    /**
     * Render the Livewire component.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.dashboard.menu')
            ->layout('layouts.dashboard');
    }
}
