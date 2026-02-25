<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caféra | Dashboard</title>

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
    <!-- DASHBOARD MODULE (CENTER)                  -->
    <!-- ========================================== -->
    <main class="flex-1 flex flex-col h-full overflow-y-auto bg-transparent p-6 md:p-8">
        
        <!-- Header -->
        <header class="mb-8">
            <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Dashboard</h1>
            <p class="text-sm text-[#5c4a3b] mt-1">Real-time summary, analytics, and stock status</p>
        </header>

        <!-- 1.1 Today's Sales Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Sales -->
            <div class="bg-white/70 rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-[#8a7663] uppercase tracking-wider mb-1">Today's Total Sales</p>
                    <h3 class="font-serif text-2xl font-bold text-[#8c5319]">$1,245.50</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#ebd9c8] flex items-center justify-center text-[#8c5319]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Total Products Sold -->
            <div class="bg-white/70 rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-[#8a7663] uppercase tracking-wider mb-1">Total Products Sold</p>
                    <h3 class="font-serif text-2xl font-bold text-[#8c5319]">142</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#ebd9c8] flex items-center justify-center text-[#8c5319]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
            </div>

            <!-- Number of Orders -->
            <div class="bg-white/70 rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-xs font-bold text-[#8a7663] uppercase tracking-wider mb-1">Number of Orders</p>
                    <h3 class="font-serif text-2xl font-bold text-[#8c5319]">86</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#ebd9c8] flex items-center justify-center text-[#8c5319]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
             </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-8">
            <!-- 1.2 Sales Filter & Analytics Chart (2 columns) -->
            <div class="lg:col-span-2 bg-white/70 rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex flex-col" x-data="{ timeFilter: 'Daily' }">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h2 class="font-serif font-bold text-lg text-[#2a241f]">Sales Analytics</h2>
                    <!-- Filters -->
                    <div class="flex bg-white border border-[#dcc5ae] rounded-lg overflow-hidden text-xs font-medium">
                        <button @click="timeFilter = 'Daily'" :class="timeFilter === 'Daily' ? 'bg-[#8c5319] text-white' : 'text-[#8a7663] hover:bg-[#ebd9c8]/30'" class="px-3 py-1.5 transition-colors">Daily</button>
                        <button @click="timeFilter = 'Weekly'" :class="timeFilter === 'Weekly' ? 'bg-[#8c5319] text-white' : 'text-[#8a7663] hover:bg-[#ebd9c8]/30'" class="px-3 py-1.5 transition-colors border-l border-[#dcc5ae]">Weekly</button>
                        <button @click="timeFilter = 'Monthly'" :class="timeFilter === 'Monthly' ? 'bg-[#8c5319] text-white' : 'text-[#8a7663] hover:bg-[#ebd9c8]/30'" class="px-3 py-1.5 transition-colors border-l border-[#dcc5ae]">Monthly</button>
                        <button @click="timeFilter = 'Yearly'" :class="timeFilter === 'Yearly' ? 'bg-[#8c5319] text-white' : 'text-[#8a7663] hover:bg-[#ebd9c8]/30'" class="px-3 py-1.5 transition-colors border-l border-[#dcc5ae]">Yearly</button>
                    </div>
                </div>
                <!-- Chart Area (using CSS bars with hover tooltips for interactive visualization) -->
                <div class="flex-1 w-full relative min-h-[250px] flex items-end justify-between gap-2 md:gap-4 px-2 mt-auto border-b border-[#ebd9c8] pb-1">
                    <!-- Daily Bars (Example mapping) -->
                    <div class="w-1/12 bg-[#ebd9c8] rounded-t-md h-[40%] hover:bg-[#8c5319] transition-colors relative group">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">$240</div>
                    </div>
                    <div class="w-1/12 bg-[#ebd9c8] rounded-t-md h-[60%] hover:bg-[#8c5319] transition-colors relative group">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">$450</div>
                    </div>
                    <div class="w-1/12 bg-[#ebd9c8] rounded-t-md h-[30%] hover:bg-[#8c5319] transition-colors relative group">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">$180</div>
                    </div>
                    <div class="w-1/12 bg-[#ebd9c8] rounded-t-md h-[80%] hover:bg-[#8c5319] transition-colors relative group">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">$750</div>
                    </div>
                    <div class="w-1/12 bg-[#ebd9c8] rounded-t-md h-[50%] hover:bg-[#8c5319] transition-colors relative group">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">$360</div>
                    </div>
                    <div class="w-1/12 bg-[#8c5319] rounded-t-md h-[95%] hover:bg-[#a66a2a] transition-colors relative group">
                         <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">$920</div>
                    </div>
                    <div class="w-1/12 bg-[#ebd9c8] rounded-t-md h-[70%] hover:bg-[#8c5319] transition-colors relative group">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">$610</div>
                    </div>
                </div>
            </div>

            <!-- 1.3 Low Stock Indicator (1 column) -->
            <div class="bg-white/70 rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex flex-col">
                <h2 class="font-serif font-bold text-lg text-[#2a241f] mb-4">Stock Status</h2>
                
                <div class="space-y-4 flex-1 overflow-y-auto pr-2">
                    
                    <!-- Red / Critical -->
                    <div class="flex items-center justify-between p-3 border border-red-200 bg-red-50 rounded-xl hover:shadow-sm transition-shadow">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]"></div>
                            <div>
                                <p class="text-sm font-bold text-[#2a241f]">Whole Milk</p>
                                <p class="text-[0.65rem] text-red-600 font-medium tracking-wide">Must Restock Immediately</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-[#2a241f]">1L left</span>
                    </div>

                    <!-- Yellow / Low -->
                    <div class="flex items-center justify-between p-3 border border-yellow-200 bg-yellow-50 rounded-xl hover:shadow-sm transition-shadow">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.5)]"></div>
                            <div>
                                <p class="text-sm font-bold text-[#2a241f]">Vanilla Syrup</p>
                                <p class="text-[0.65rem] text-yellow-600 font-medium tracking-wide">Restock Soon</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-[#2a241f]">3 btl left</span>
                    </div>

                     <!-- Yellow / Low -->
                     <div class="flex items-center justify-between p-3 border border-yellow-200 bg-yellow-50 rounded-xl hover:shadow-sm transition-shadow">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.5)]"></div>
                            <div>
                                <p class="text-sm font-bold text-[#2a241f]">Caramel Drizzle</p>
                                <p class="text-[0.65rem] text-yellow-600 font-medium tracking-wide">Restock Soon</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-[#2a241f]">4 btl left</span>
                    </div>

                    <!-- Blue / Sufficient -->
                    <div class="flex items-center justify-between p-3 border border-blue-200 bg-blue-50 rounded-xl hover:shadow-sm transition-shadow">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                            <div>
                                <p class="text-sm font-bold text-[#2a241f]">Espresso Beans</p>
                                <p class="text-[0.65rem] text-blue-600 font-medium tracking-wide">Plenty of Stock</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-[#2a241f]">25kg left</span>
                    </div>

                    <!-- Blue / Sufficient -->
                    <div class="flex items-center justify-between p-3 border border-blue-200 bg-blue-50 rounded-xl hover:shadow-sm transition-shadow">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                            <div>
                                <p class="text-sm font-bold text-[#2a241f]">Matcha Powder</p>
                                <p class="text-[0.65rem] text-blue-600 font-medium tracking-wide">Plenty of Stock</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-[#2a241f]">12kg left</span>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
</html>
