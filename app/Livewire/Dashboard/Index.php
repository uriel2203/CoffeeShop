<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Index extends Component
{
    /**
     * Time period filter for the analytics chart.
     * Possible values: 'Daily', 'Weekly', 'Monthly', 'Yearly'
     */
    public $timeFilter = 'Daily';
    
    /**
     * Computes sales summary metrics based on the selected $timeFilter.
     * - totalSales: Sum of revenue in the selected period.
     * - productsSold: Total quantity of items sold in the selected period.
     * - orderCount: Count of transactions in the selected period.
     *
     * @return array
     */
    public function getPeriodMetricsProperty()
    {
        $query = \App\Models\Order::where('status', '!=', 'cancelled');
        $itemQuery = \App\Models\OrderItem::whereHas('order', function ($q) {
            $q->where('status', '!=', 'cancelled');
        });

        switch ($this->timeFilter) {
            case 'Daily':
                $query->whereDate('created_at', now()->toDateString());
                $itemQuery->whereHas('order', fn($q) => $q->whereDate('created_at', now()->toDateString()));
                break;
            case 'Weekly':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                $itemQuery->whereHas('order', fn($q) => $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]));
                break;
            case 'Monthly':
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                $itemQuery->whereHas('order', fn($q) => $q->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year));
                break;
            case 'Yearly':
                $query->whereYear('created_at', now()->year);
                $itemQuery->whereHas('order', fn($q) => $q->whereYear('created_at', now()->year));
                break;
            case 'All':
                // No filters for all time
                break;
        }

        return [
            'totalSales' => $query->sum('total'),
            'productsSold' => $itemQuery->sum('quantity'),
            'orderCount' => $query->count(),
        ];
    }
    
    /**
     * Generates data for the interactive sales analytics chart based on $timeFilter.
     * - Daily: Groups sales by hour (00-23) for today.
     * - Weekly: Groups sales by day of the current week.
     * - Monthly: Groups sales by calendar day for the current month.
     * - Yearly: Groups sales by month for the current year.
     *
     * Each data point includes a label, value, and calculated height percentage for the bar.
     * 
     * @return array
     */
    public function getAnalyticsDataProperty()
    {
        $data = [];
        
        switch ($this->timeFilter) {
            case 'Daily':
                // Query: SELECT HOUR(created_at) as hour, SUM(total) as total ... GROUP BY hour
                $results = \App\Models\Order::selectRaw('HOUR(created_at) as hour, SUM(total) as total')
                    ->whereDate('created_at', now()->toDateString())
                    ->where('status', '!=', 'cancelled')
                    ->groupBy('hour')
                    ->pluck('total', 'hour');
                
                // Fill all 24 hours to ensure a complete chart
                for ($i = 0; $i < 24; $i++) {
                    $val = $results[$i] ?? 0;
                    $data[] = [
                        'label' => $i . ':00',
                        'value' => $val,
                        'height' => $this->calculateHeight($val, 5000) // 5000 is a mock max scale
                    ];
                }
                break;

            case 'Weekly':
                // Group by DAYNAME (Monday, Tuesday, etc.)
                $start = now()->startOfWeek();
                $results = \App\Models\Order::selectRaw('DAYNAME(created_at) as day, SUM(total) as total')
                    ->where('created_at', '>=', $start)
                    ->where('status', '!=', 'cancelled')
                    ->groupBy('day')
                    ->pluck('total', 'day');
                
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                foreach ($days as $day) {
                    $val = $results[$day] ?? 0;
                    $data[] = [
                        'label' => substr($day, 0, 3),
                        'value' => $val,
                        'height' => $this->calculateHeight($val, 20000)
                    ];
                }
                break;

            case 'Monthly':
                // Group by DAY number (1st, 2nd, etc.)
                $start = now()->startOfMonth();
                $end = now()->endOfMonth();
                $results = \App\Models\Order::selectRaw('DAY(created_at) as day, SUM(total) as total')
                    ->whereBetween('created_at', [$start, $end])
                    ->where('status', '!=', 'cancelled')
                    ->groupBy('day')
                    ->pluck('total', 'day');
                
                for ($i = 1; $i <= $end->day; $i++) {
                    $val = $results[$i] ?? 0;
                    $data[] = [
                        'label' => $i,
                        'value' => $val,
                        'height' => $this->calculateHeight($val, 10000)
                    ];
                }
                break;

            case 'Yearly':
                // Group by MONTHNAME (January, February, etc.)
                $results = \App\Models\Order::selectRaw('MONTHNAME(created_at) as month, SUM(total) as total')
                    ->whereYear('created_at', now()->year)
                    ->where('status', '!=', 'cancelled')
                    ->groupBy('month')
                    ->pluck('total', 'month');
                
                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                foreach ($months as $month) {
                    $val = $results[$month] ?? 0;
                    $data[] = [
                        'label' => substr($month, 0, 3),
                        'value' => $val,
                        'height' => $this->calculateHeight($val, 100000)
                    ];
                }
                break;

            case 'All':
                // Group by Year for all time
                $results = \App\Models\Order::selectRaw('YEAR(created_at) as year, SUM(total) as total')
                    ->where('status', '!=', 'cancelled')
                    ->groupBy('year')
                    ->orderBy('year', 'asc')
                    ->pluck('total', 'year');
                
                foreach ($results as $year => $total) {
                    $data[] = [
                        'label' => $year,
                        'value' => $total,
                        'height' => $this->calculateHeight($total, 500000)
                    ];
                }
                break;
        }

        return $data;
    }

    /**
     * Helper to calculate CSS height percentage for chart bars.
     * Prevents bars from disappearing (min 5%) or overflowing (max 100%).
     */
    private function calculateHeight($value, $max)
    {
        if ($max <= 0) return '0%';
        $percent = ($value / $max) * 100;
        return min(100, max(5, $percent)) . '%';
    }

    /**
     * Fetches and audits stock levels for all ingredients.
     * Applies color coding based on thresholds:
     * - Red (Critical): Amount is at or below critical_stock_threshold.
     * - Yellow (Low): Amount is at or below low_stock_threshold.
     * - Blue (Sufficient): Amount is above both thresholds.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getStockStatusProperty()
    {
        return \App\Models\Ingredient::all()->map(function ($ing) {
            $color = 'blue';
            $note = 'Sufficient / Plenty of Stock';
            
            if ($ing->amount <= $ing->critical_stock_threshold) {
                $color = 'red';
                $note = 'Critical / Must Restock Immediately';
            } elseif ($ing->amount <= $ing->low_stock_threshold) {
                $color = 'yellow';
                $note = 'Low / Restock Soon';
            }

            return [
                'name' => $ing->name,
                'color' => $color,
                'note' => $note,
                'quantity' => number_format($ing->amount, 1) . ' ' . $ing->unit . ' left'
            ];
        })->sortByDesc(function($item) {
            // Priority Sort: Red > Yellow > Blue
            return match($item['color']) {
                'red' => 3,
                'yellow' => 2,
                'blue' => 1,
            };
        })->take(10);
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
