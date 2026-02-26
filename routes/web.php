<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard Routes protected by Auth and Role-Based Access Control (RBAC)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Core Dashboard pages accessible to all authenticated staff
    Route::get('dashboard', \App\Livewire\Dashboard\Index::class)->name('dashboard');
    Route::get('dashboard/menu', \App\Livewire\Dashboard\Menu::class)->name('dashboard.menu');
    Route::get('dashboard/orders', \App\Livewire\Dashboard\Orders::class)->name('dashboard.orders');

    // Shared management pages accessible to both Admin and Employee
    Route::get('dashboard/products', \App\Livewire\Dashboard\Products::class)->name('dashboard.products');
    Route::get('dashboard/ingredients', \App\Livewire\Dashboard\Ingredients::class)->name('dashboard.ingredients');
    Route::get('dashboard/inventory', \App\Livewire\Dashboard\Inventory::class)->name('dashboard.inventory');
    Route::get('dashboard/reports', \App\Livewire\Dashboard\Reports::class)->name('dashboard.reports');

    // Restricted Admin-only pages
    Route::middleware(['role:admin'])->group(function () {
        Route::get('dashboard/manage-users', \App\Livewire\Dashboard\ManageUsers::class)->name('dashboard.manage-users');
    });
});

require __DIR__.'/settings.php';
