<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caféra | Orders</title>

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
        
         <!-- Header & Filters -->
        <header class="p-6 md:p-8 pb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#ebd9c8]">
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Order History</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Review past transactions and order details</p>
                
                <!-- 5.3 Order Integrity Note -->
                <!-- HTML Comment: Orders displayed here are permanently saved system records representing finalized transactions. They cannot be deleted by any user (including Admin) to maintain a tamper-resistant financial log. -->
            </div>

            <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                <!-- Date & Time Filter -->
                <div class="relative w-full md:w-auto">
                    <input type="datetime-local" class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] cursor-pointer" title="Filter by date and time">
                </div>

                <!-- Search Bar -->
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Search orders..." class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>
        </header>

        <!-- 5.1 Order History Table -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="bg-white/80 rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#ebd9c8] bg-[#fcfaf8] text-xs font-bold text-[#2a241f] tracking-wide">
                            <th class="px-6 py-4">Order ID</th>
                            <th class="px-6 py-4 w-1/3">Orders Details</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4 hidden md:table-cell">Discount</th>
                            <th class="px-6 py-4">Payment Method</th>
                            <th class="px-6 py-4 hidden lg:table-cell">Cashiered By</th>
                            <th class="px-6 py-4 hidden xl:table-cell">Transaction Date</th>
                            <!-- 5.2 Admin-Only Edit Access: A final 'Action' column is present here for Admin accounts, but visually indicated/disabled to explain functionality. -->
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ebd9c8] text-[0.8rem] text-[#5c4a3b]">
                        
                        <!-- Row 13 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">13</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Cappuccino</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <!-- Embedded Ingredient Use Reference for Product -->
                                    <p class="text-[0.6rem] text-[#8c5319] italic pb-1">Using: 18g Espresso Beans, 150ml Whole Milk</p>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Dark Chocolate</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <p class="text-[0.6rem] text-[#8c5319] italic pb-1">Using: 25g Cocoa Powder, 200ml Whole Milk</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 278.00</td>
                            <td class="px-6 py-4 hidden md:table-cell">No discount</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4 hidden lg:table-cell">John Smith</td>
                            <td class="px-6 py-4 hidden xl:table-cell">October 14, 2024, 4:48 am</td>
                            <td class="px-6 py-4 text-center">
                                <!-- Disabled Edit Button Example for Employees -->
                                <button class="p-1.5 bg-gray-200 text-gray-400 rounded-md cursor-not-allowed mx-auto block" title="Edit (Admin Only)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 11 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">11</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Lemon</span>
                                        <span class="text-[#8a7663]">₱ 119.00</span>
                                    </div>
                                    <p class="text-[0.6rem] text-[#8c5319] italic pb-1">Using: 20ml Lemon Syrup, 10g Sugar</p>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Strawberry Matcha</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                    <p class="text-[0.6rem] text-[#8c5319] italic pb-1">Using: 12g Matcha Powder, 20ml Strawberry Syrup</p>

                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Chicken Adobo</span>
                                        <span class="text-[#8a7663]">₱ 190.00</span>
                                    </div>
                                    <p class="text-[0.6rem] text-[#8c5319] italic pb-1">Using: 150g Chicken, 10ml Soy Sauce</p>

                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Espresso</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                    <p class="text-[0.6rem] text-[#8c5319] italic">Using: 18g Espresso Beans</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 453.60</td>
                            <td class="px-6 py-4 hidden md:table-cell">Senior Citizen Discount/PWD: 20%</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4 hidden lg:table-cell">John Smith</td>
                            <td class="px-6 py-4 hidden xl:table-cell">October 14, 2024, 4:45 am</td>
                             <td class="px-6 py-4 text-center">
                                <!-- Enabled Edit Button Example (Requires Admin logic) -->
                                <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors mx-auto block" title="Edit Order Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 10 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">10</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Espresso</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Americano</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Cappuccino</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Dark Chocolate</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Pure Green Tea</span>
                                        <span class="text-[#8a7663]">₱ 70.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 492.80</td>
                            <td class="px-6 py-4 hidden md:table-cell">Senior Citizen Discount/PWD: 20%</td>
                            <td class="px-6 py-4">Gcash</td>
                            <td class="px-6 py-4 hidden lg:table-cell">John Smith</td>
                            <td class="px-6 py-4 hidden xl:table-cell">October 14, 2024, 4:44 am</td>
                            <td class="px-6 py-4 text-center">
                                <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors mx-auto block" title="Edit Order Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                </button>
                            </td>
                        </tr>

                         <!-- Row 9 -->
                         <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">9</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Espresso</span>
                                        <span class="text-[#8a7663]">₱ 129.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Americano</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Cappuccino</span>
                                        <span class="text-[#8a7663]">₱ 139.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Chicken Adobo</span>
                                        <span class="text-[#8a7663]">₱ 190.00</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Green Apple</span>
                                        <span class="text-[#8a7663]">₱ 119.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 716.00</td>
                            <td class="px-6 py-4 hidden md:table-cell">No discount</td>
                            <td class="px-6 py-4">Gcash</td>
                            <td class="px-6 py-4 hidden lg:table-cell">John Smith</td>
                            <td class="px-6 py-4 hidden xl:table-cell">October 14, 2024, 4:43 am</td>
                            <td class="px-6 py-4 text-center">
                                <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors mx-auto block" title="Edit Order Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 8 -->
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors align-top border-b-transparent">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">8</td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-[#2a241f]">1x Green Apple</span>
                                        <span class="text-[#8a7663]">₱ 119.00</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2a241f]">₱ 119.00</td>
                            <td class="px-6 py-4 hidden md:table-cell">No discount</td>
                            <td class="px-6 py-4">Cash</td>
                            <td class="px-6 py-4 hidden lg:table-cell">John Smith</td>
                            <td class="px-6 py-4 hidden xl:table-cell">October 14, 2024, 4:36 am</td>
                            <td class="px-6 py-4 text-center">
                                <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors mx-auto block" title="Edit Order Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection
</html>
