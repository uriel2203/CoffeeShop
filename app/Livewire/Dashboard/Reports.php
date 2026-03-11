<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;

class Reports extends Component
{
    use WithPagination;
    /**
     * Search query for filtering transactions.
     * @var string
     */
    public $search = '';

    /**
     * Date filter for filtering transactions by month/year.
     * @var string
     */
    public $dateFilter = '';

    /**
     * Generate and download a PDF report of the transactions.
     * Restricted to Admin users.
     * 
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|void
     */
    public function generateReport()
    {
        // Check if the authenticated user is an admin
        if (!auth()->user()->isAdmin()) {
            session()->flash('error', 'Only admins can generate reports.');
            return;
        }

        $orders = $this->getFilteredOrders();

        // Calculate subtotals and totals for the report
        $subtotal = $orders->sum('subtotal');
        $discountTotal = $orders->sum('discount_amount');
        $grandTotal = $orders->sum('total');

        // Prepare data for the PDF view
        $data = [
            'orders' => $orders,
            'subtotal' => $subtotal,
            'discountTotal' => $discountTotal,
            'grandTotal' => $grandTotal,
            'generatedAt' => now()->format('F d, Y, h:i a'),
            'generatedBy' => auth()->user()->name,
            'dateRange' => $this->getDateRangeLabel(),
        ];

        // Generate PDF using Barryvdh\DomPDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.report-pdf', $data);

        // Download the generated PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Sales_Report_' . now()->format('Y-m-d_His') . '.pdf');
    }

    /**
     * Get the filtered orders base on search query and date filter.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function render()
    {
        return view('livewire.dashboard.reports', [
            'orders' => $this->getFilteredOrdersQuery()->paginate(10),
        ])->layout('layouts.dashboard');
    }

    /**
     * Get the filtered orders query.
     */
    protected function getFilteredOrdersQuery()
    {
        $query = \App\Models\Order::with('items')->orderBy('id', 'asc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('order_number', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->dateFilter) {
            $date = \Carbon\Carbon::parse($this->dateFilter);
            $query->whereYear('created_at', $date->year)
                  ->whereMonth('created_at', $date->month);
        }

        return $query;
    }

    /**
     * Get the filtered orders collection for PDF.
     */
    protected function getFilteredOrders()
    {
        return $this->getFilteredOrdersQuery()->get();
    }

    /**
     * Get a human-readable label for the current date filter.
     * 
     * @return string
     */
    protected function getDateRangeLabel()
    {
        if ($this->dateFilter) {
            return \Carbon\Carbon::parse($this->dateFilter)->format('F Y');
        }

        return 'All Time';
    }
}
