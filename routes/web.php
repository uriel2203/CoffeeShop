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

require __DIR__.'/settings.php';
