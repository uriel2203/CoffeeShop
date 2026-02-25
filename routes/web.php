<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');    

Route::view('dashboard/menu', 'dashboard.menu')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.menu');

Route::view('dashboard/products', 'dashboard.products')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.products');

Route::view('dashboard/ingredients', 'dashboard.ingredients')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.ingredients');

Route::view('dashboard/orders', 'dashboard.orders')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.orders');

Route::view('dashboard/inventory', 'dashboard.inventory')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.inventory');

Route::view('dashboard/manage-users', 'dashboard.manage-users')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.manage-users');

require __DIR__.'/settings.php';
