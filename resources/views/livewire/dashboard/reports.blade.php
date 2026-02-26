<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Reports Component
        Handles real-time searching and dynamic report generation.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Sales Reports</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Review financial performance and generate printing records</p>
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- Date & Time Filter -->
                    <div class="relative w-full md:w-auto">
                        <input type="month" class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] cursor-pointer" title="Filter report period">
                    </div>

                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <input type="text" 
                            wire:model.live="search"
                            placeholder="Search transactions..." 
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-4 md:mt-6">
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

        <!-- Transactions Table -->
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
                        {{-- More transaction rows looped here --}}
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
