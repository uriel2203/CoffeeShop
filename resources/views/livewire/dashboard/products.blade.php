<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Products Component
        Handles real-time searching and management of coffee shop offerings.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header & Search Bar -->
        <header class="p-6 md:p-8 pb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#ebd9c8]">
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Products</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Manage your coffee shop offerings</p>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Search Bar -->
                <div class="relative w-full md:w-64">
                    <input type="text" 
                        wire:model.live="search"
                        placeholder="Search product..." 
                        class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                
                <button class="bg-[#8c5319] hover:bg-[#a66a2a] text-white font-bold text-sm py-2.5 px-6 rounded-full shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create new product
                </button>
            </div>
        </header>

        <!-- Product List Table -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="bg-white/80 rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#ebd9c8] bg-[#fcfaf8] text-xs uppercase tracking-wider text-[#8a7663]">
                            <th class="px-6 py-4 font-bold">ID</th>
                            <th class="px-6 py-4 font-bold">Product Name</th>
                            <th class="px-6 py-4 font-bold">Menu</th>
                            <th class="px-6 py-4 font-bold">Price</th>
                            <th class="px-6 py-4 font-bold">Availability</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                            <th class="px-6 py-4 text-center">View Details</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ebd9c8] text-sm text-[#2a241f]">
                        <tr class="hover:bg-[#fcfaf8]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#8a7663]">1</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://loremflickr.com/100/100/espresso/all" alt="Espresso" class="w-10 h-10 rounded-md object-cover border border-[#ebd9c8] bg-white">
                                    <span class="font-bold">Espresso</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#5c4a3b]">Coffee</td>
                            <td class="px-6 py-4 font-bold">₱129.00</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-green-700 bg-green-100 px-3 py-1 rounded-full border border-green-200">Available</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-sm transition-colors" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button class="p-1.5 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-sm transition-colors" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#8a7663] hover:text-[#8c5319] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    View
                                </a>
                            </td>
                        </tr>
                        {{-- More product rows will be looped here --}}
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
