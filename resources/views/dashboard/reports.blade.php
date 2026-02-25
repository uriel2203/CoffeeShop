<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caféra | Reports</title>

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
        
         <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Sales Reports</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Review financial performance and generate printing records</p>
                    
                    <!-- 8.2 & 8.3 PDF Generation & Scope Notes -->
                    <!-- HTML Comment: The "Generate Report" action converts this current filtered view into a downloadable PDF format (including Café Name/Logo, Range Title, structured table, subtotals/totals, and footer stamps). Scope-wise, this table mirrors the finalized transactions from the Orders module. Future implementations will include dynamic Date-Range filtering to constrain the generated dataset. Admin-only functionality regarding the PDF export logic should be enforced at the backend controller level. -->
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- Date & Time Filter Placeholder (for future 8.3 scope filtering) -->
                    <div class="relative w-full md:w-auto">
                        <input type="month" class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] cursor-pointer" title="Filter report period">
                    </div>

                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Search transactions..." class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- 8.2 Generate Report Button -->
            <!-- Placed below the header text/search in its own right-aligned bar matching the mockup spacing -->
            <div class="flex justify-between items-center mt-4 md:mt-6">
                 <!-- Tabs aligned left as secondary filter method per mockup styling conventions -->
                 <div class="text-sm font-medium text-[#8a7663] flex gap-6 border-b border-transparent">
                    <a href="#" class="text-[#8c5319] border-[#8c5319] border-b-2 pb-2 font-bold">Transactions</a>
                </div>

                <button class="bg-[#00a8cf] hover:bg-[#0092b3] text-white font-medium text-sm py-2 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Generate report
                </button>
            </div>
        </header>

        <!-- 8.1 Transactions Table -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="bg-white/80 rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#ebd9c8] bg-[#fcfaf8] text-xs font-bold text-[#2a241f] tracking-wide">
                            <th class="px-6 py-4 w-24">Order ID</th>
                            <th class="px-6 py-4">Orders</th>
                            <th class="px-6 py-4 w-32">Total</th>
                            <th class="px-6 py-4">Discount</th>
                            <th class="px-6 py-4">Payment Method</th>
                            <th class="px-6 py-4">Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ebd9c8] text-[0.85rem] text-[#5c4a3b]">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">1</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-between max-w-[280px]">
                                    <span class="font-medium text-[#2a241f]">1x Dark Chocolate</span>
                                    <span class="text-[#8a7663]">₱ 139.00</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 111.20</td>
                            <td class="px-6 py-4 text-[#8a7663]">Senior Citizen Discount/PWD: 20%</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4">October 14, 2024, 12:31 am</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">2</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-between max-w-[280px]">
                                    <span class="font-medium text-[#2a241f]">1x Strawberry Matcha</span>
                                    <span class="text-[#8a7663]">₱ 159.00</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 127.20</td>
                            <td class="px-6 py-4 text-[#8a7663]">Senior Citizen Discount/PWD: 20%</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4">October 14, 2024, 12:32 am</td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">3</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1 max-w-[280px]">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Cappuccino</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Dark Chocolate</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f] align-top">₱ 222.40</td>
                            <td class="px-6 py-4 text-[#8a7663] align-top">Senior Citizen Discount/PWD: 20%</td>
                            <td class="px-6 py-4 align-top">Cash</td>
                            <td class="px-6 py-4 align-top">October 14, 2024, 4:09 am</td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">4</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-between max-w-[280px]">
                                    <span class="font-medium text-[#2a241f]">2x English Tea</span>
                                    <span class="text-[#8a7663]">₱ 140.00</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 140.00</td>
                            <td class="px-6 py-4 text-[#8a7663]">No discount</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4">October 14, 2024, 4:11 am</td>
                        </tr>

                        <!-- Row 7 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">7</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-between max-w-[280px]">
                                    <span class="font-medium text-[#2a241f]">1x Americano</span>
                                    <span class="text-[#8a7663]">₱ 139.00</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 139.00</td>
                            <td class="px-6 py-4 text-[#8a7663]">No discount</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4">October 14, 2024, 4:15 am</td>
                        </tr>

                        <!-- Row 8 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">8</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-between max-w-[280px]">
                                    <span class="font-medium text-[#2a241f]">1x Green Apple</span>
                                    <span class="text-[#8a7663]">₱ 119.00</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 119.00</td>
                            <td class="px-6 py-4 text-[#8a7663]">No discount</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4">October 14, 2024, 4:36 am</td>
                        </tr>

                        <!-- Row 9 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">9</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1 max-w-[280px]">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Espresso</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Americano</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Cappuccino</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Chicken Adobo</span>
                                        <span class="text-[#8a7663]">₱ 190.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Green Apple</span>
                                        <span class="text-[#8a7663]">₱ 119.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f] align-top">₱ 716.00</td>
                            <td class="px-6 py-4 text-[#8a7663] align-top">No discount</td>
                            <td class="px-6 py-4 align-top">Gcash</td>
                            <td class="px-6 py-4 align-top">October 14, 2024, 4:43 am</td>
                        </tr>

                        <!-- Row 10 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">10</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1 max-w-[280px]">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Espresso</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Americano</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Cappuccino</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Dark Chocolate</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Pure Green Tea</span>
                                        <span class="text-[#8a7663]">₱ 70.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f] align-top">₱ 492.80</td>
                            <td class="px-6 py-4 text-[#8a7663] align-top">Senior Citizen Discount/PWD: 20%</td>
                            <td class="px-6 py-4 align-top">Gcash</td>
                            <td class="px-6 py-4 align-top">October 14, 2024, 4:44 am</td>
                        </tr>

                        <!-- Row 11 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">11</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1 max-w-[280px]">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Lemon</span>
                                        <span class="text-[#8a7663]">₱ 119.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Strawberry Matcha</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Chicken Adobo</span>
                                        <span class="text-[#8a7663]">₱ 190.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Espresso</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f] align-top">₱ 453.60</td>
                            <td class="px-6 py-4 text-[#8a7663] align-top">Senior Citizen Discount/PWD: 20%</td>
                            <td class="px-6 py-4 align-top">Cash</td>
                            <td class="px-6 py-4 align-top">October 14, 2024, 4:45 am</td>
                        </tr>

                        <!-- Row 13 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top border-b-transparent">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">13</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1 max-w-[280px]">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Cappuccino</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-[#2a241f]">1x Dark Chocolate</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f] align-top">₱ 278.00</td>
                            <td class="px-6 py-4 text-[#8a7663] align-top">No discount</td>
                            <td class="px-6 py-4 align-top">Cash</td>
                            <td class="px-6 py-4 align-top">October 14, 2024, 4:48 am</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection
</html>
