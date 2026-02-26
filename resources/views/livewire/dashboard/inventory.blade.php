<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Inventory Component
        Handles real-time searching and tracking of physical restocking logs.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header & Search Bar -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Inventory History</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Track physical restocking logs and batch expirations</p>
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- Date & Time Filter -->
                    <div class="relative w-full md:w-auto">
                        <input type="datetime-local" class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] cursor-pointer" title="Filter by date and time">
                    </div>

                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <input type="text" 
                            wire:model.live="search"
                            placeholder="Search logs..." 
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-4 md:mt-6">
                <button class="bg-[#a48466] hover:bg-[#8e6e52] text-white font-medium text-sm py-2 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Stock In
                </button>
            </div>
        </header>

        <!-- Inventory List Table -->
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
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#2a241f]">1</td>
                            <td class="px-6 py-4 font-medium text-[#2a241f]">Sugar</td>
                            <td class="px-6 py-4 text-[#8a7663]">1000.00 g</td>
                            <td class="px-6 py-4 hidden md:table-cell">June 9, 2026</td>
                            <td class="px-6 py-4">2024-10-14 04:22:01</td>
                            <td class="px-6 py-4 hidden lg:table-cell">1 hour ago</td>
                        </tr>
                        {{-- More rows would be looped here --}}
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
