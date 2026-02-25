<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caféra | Inventory</title>

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
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Inventory History</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Track physical restocking logs and batch expirations</p>
                    
                    <!-- 6.3 Relationship to Ingredients Module Note -->
                    <!-- HTML Comment: The Inventory module logs incoming physical stock batches (when they arrive, how much, and expiry). When "Stock In" is utilized here, the total aggregated amount for that corresponding Ingredient over in the 'Ingredients' module is automatically increased. Real-time POS consumption deducts from the Ingredients module total, NOT these individual static Inventory logs. -->
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- Date & Time Filter -->
                    <div class="relative w-full md:w-auto">
                        <input type="datetime-local" class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] cursor-pointer" title="Filter by date and time">
                    </div>

                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Search logs..." class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- 6.2 Stock In Button -->
            <!-- Placed below the header text/search in its own right-aligned bar matching the mockup spacing -->
            <div class="flex justify-end mt-4 md:mt-6">
                <button class="bg-[#a48466] hover:bg-[#8e6e52] text-white font-medium text-sm py-2 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Stock In
                </button>
            </div>
        </header>

        <!-- 6.1 Inventory List Table -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="bg-white/80 rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#ebd9c8] bg-[#fcfaf8] text-xs font-bold text-[#2a241f] tracking-wide">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Ingredient</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4 hidden md:table-cell">Expiration Date</th>
                            <th class="px-6 py-4">Date Added</th>
                            <th class="px-6 py-4 hidden lg:table-cell">Updated At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ebd9c8] text-sm text-[#5c4a3b]">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">1</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Sugar</td>
                            <td class="px-6 py-4 text-[#8a7663]">1000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">June 9, 2026</td>
                            <td class="px-6 py-4">2024-10-14 04:22:01</td>
                            <td class="px-6 py-4 hidden lg:table-cell">1 hour ago</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">2</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Beef</td>
                            <td class="px-6 py-4 text-[#8a7663]">10000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">October 14, 2026</td>
                            <td class="px-6 py-4">2024-10-14 04:38:11</td>
                            <td class="px-6 py-4 hidden lg:table-cell">48 minutes ago</td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">3</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Chicken</td>
                            <td class="px-6 py-4 text-[#8a7663]">10000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">October 12, 2025</td>
                            <td class="px-6 py-4">2024-10-14 04:38:11</td>
                            <td class="px-6 py-4 hidden lg:table-cell">48 minutes ago</td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">4</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Pork</td>
                            <td class="px-6 py-4 text-[#8a7663]">10000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">February 10, 2025</td>
                            <td class="px-6 py-4">2024-10-14 04:38:11</td>
                            <td class="px-6 py-4 hidden lg:table-cell">48 minutes ago</td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">5</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Bacon</td>
                            <td class="px-6 py-4 text-[#8a7663]">10000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">October 12, 2025</td>
                            <td class="px-6 py-4">2024-10-14 04:38:11</td>
                            <td class="px-6 py-4 hidden lg:table-cell">48 minutes ago</td>
                        </tr>

                        <!-- Row 6 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">6</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Sausage</td>
                            <td class="px-6 py-4 text-[#8a7663]">10000.00 pcs</td>
                            <td class="px-6 py-4 hidden md:table-cell">October 20, 2025</td>
                            <td class="px-6 py-4">2024-10-14 04:38:11</td>
                            <td class="px-6 py-4 hidden lg:table-cell">48 minutes ago</td>
                        </tr>

                        <!-- Row 7 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">7</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Ham</td>
                            <td class="px-6 py-4 text-[#8a7663]">10000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">October 10, 2025</td>
                            <td class="px-6 py-4">2024-10-14 04:38:11</td>
                            <td class="px-6 py-4 hidden lg:table-cell">48 minutes ago</td>
                        </tr>

                        <!-- Row 8 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">8</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Egg</td>
                            <td class="px-6 py-4 text-[#8a7663]">100.00 pcs</td>
                            <td class="px-6 py-4 hidden md:table-cell">October 10, 2025</td>
                            <td class="px-6 py-4">2024-10-14 04:38:11</td>
                            <td class="px-6 py-4 hidden lg:table-cell">48 minutes ago</td>
                        </tr>

                        <!-- Row 9 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors border-b-transparent">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">9</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Stick Noodles</td>
                            <td class="px-6 py-4 text-[#8a7663]">2000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">October 14, 2024</td>
                            <td class="px-6 py-4">2024-10-14 04:42:15</td>
                            <td class="px-6 py-4 hidden lg:table-cell">44 minutes ago</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection
</html>
