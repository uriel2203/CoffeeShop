<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public $totalSales = 1245.50;
    public $productsSold = 142;
    public $orderCount = 86;
    
    public $timeFilter = 'Daily';
    
    /**
     * Get chart data based on the selected filter.
     * (Currently returning static data for demonstration)
     */
    public function getAnalyticsDataProperty()
    {
        $data = [
            'Daily' => [
                ['label' => 'Mon', 'value' => 240, 'height' => '40%'],
                ['label' => 'Tue', 'value' => 450, 'height' => '60%'],
                ['label' => 'Wed', 'value' => 180, 'height' => '30%'],
                ['label' => 'Thu', 'value' => 750, 'height' => '80%'],
                ['label' => 'Fri', 'value' => 360, 'height' => '50%'],
                ['label' => 'Sat', 'value' => 920, 'height' => '95%'],
                ['label' => 'Sun', 'value' => 610, 'height' => '70%'],
            ],
            // Placeholder for other filters
        ];

        return $data[$this->timeFilter] ?? $data['Daily'];
    }

    /**
     * Get stock status data.
     */
    public function getStockStatusProperty()
    {
        return [
            ['name' => 'Whole Milk', 'status' => 'critical', 'note' => 'Must Restock Immediately', 'quantity' => '1L left', 'color' => 'red'],
            ['name' => 'Vanilla Syrup', 'status' => 'low', 'note' => 'Restock Soon', 'quantity' => '3 btl left', 'color' => 'yellow'],
            ['name' => 'Caramel Drizzle', 'status' => 'low', 'note' => 'Restock Soon', 'quantity' => '4 btl left', 'color' => 'yellow'],
            ['name' => 'Espresso Beans', 'status' => 'sufficient', 'note' => 'Plenty of Stock', 'quantity' => '25kg left', 'color' => 'blue'],
            ['name' => 'Matcha Powder', 'status' => 'sufficient', 'note' => 'Plenty of Stock', 'quantity' => '12kg left', 'color' => 'blue'],
        ];
    }

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('livewire.dashboard.index')
            ->layout('layouts.dashboard');
    }
}
