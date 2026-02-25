<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caféra | Ingredients</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Utilities -->
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        .font-sans {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

@extends('dashboard.layout')

@section('content')
    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA (CENTER)                 -->
    <!-- ========================================== -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header & Search Bar -->
        <header class="p-6 md:p-8 pb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#ebd9c8]">
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Ingredients</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Manage all raw materials and stock levels</p>
            </div>
            
            <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                <!-- Date & Time Filter -->
                <div class="relative w-full md:w-auto">
                    <input type="datetime-local" class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] cursor-pointer" title="Filter by date and time">
                </div>

                <!-- 4.2 Search Bar to quickly filter the ingredient list by name -->
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Search for products..." class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                
                <!-- 4.3 Create New Ingredient Button to add a new raw material -->
                <button class="bg-[#8c5319] hover:bg-[#a66a2a] text-white font-bold text-sm py-2.5 px-6 rounded-full shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create new ingredient
                </button>
            </div>
        </header>

        <!-- 4.1 Ingredients List Table -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="bg-white/80 rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#ebd9c8] bg-[#fcfaf8] text-xs uppercase tracking-wider text-[#8a7663]">
                            <th class="px-6 py-4 font-bold">ID</th>
                            <th class="px-6 py-4 font-bold">Ingredient</th>
                            <th class="px-6 py-4 font-bold">Category</th>
                            <th class="px-6 py-4 font-bold">Amount</th>
                            <th class="px-6 py-4 font-bold">Unit</th>
                            <th class="px-6 py-4 font-bold hidden md:table-cell">Created At</th>
                            <th class="px-6 py-4 font-bold">Updated At</th>
                            <th class="px-6 py-4 font-bold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ebd9c8] text-sm text-[#2a241f]">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">1</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Beef</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Meat</td>
                            <td class="px-6 py-4 font-medium">10000.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">g</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs">40 minutes ago</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <!-- 4.4 Edit Ingredient Button (Blue) -->
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">2</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Chicken</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Meat</td>
                            <td class="px-6 py-4 font-medium">10000.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">g</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs">40 minutes ago</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">3</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Pork</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Meat</td>
                            <td class="px-6 py-4 font-medium">10000.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">g</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs">40 minutes ago</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">4</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Bacon</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Meat</td>
                            <td class="px-6 py-4 font-medium">10000.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">g</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs">40 minutes ago</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">5</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Sausage</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Meat</td>
                            <td class="px-6 py-4 font-medium">10000.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">pcs</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs">40 minutes ago</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 6 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">6</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Ham</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Meat</td>
                            <td class="px-6 py-4 font-medium">10000.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">g</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs">40 minutes ago</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 7 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">7</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Egg</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Meat</td>
                            <td class="px-6 py-4 font-medium">100.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">pcs</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs">40 minutes ago</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 8 (from screenshot) -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">8</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Black Pepper</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Spices</td>
                            <td class="px-6 py-4 font-medium">0.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">g</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs"></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 9 (from screenshot) -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors border-b-transparent">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">9</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Salt</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Spices</td>
                            <td class="px-6 py-4 font-medium">0.00</td>
                            <td class="px-6 py-4 text-[#5c4a3b]">g</td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs hidden md:table-cell"></td>
                            <td class="px-6 py-4 text-[#5c4a3b] text-xs"></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
                
                <!-- 4.5 Automatic Stock Deduction Reminder Message -->
                <!-- HTML Comment for user: Stock deduction happens logically in the backend at order processing. This UI is currently purely visual layout. -->
            </div>
        </div>
    </main>

@endsection
</html>
