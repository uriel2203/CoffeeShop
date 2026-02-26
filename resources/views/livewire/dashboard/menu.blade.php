<div class="flex-1 flex overflow-hidden w-full">
    {{-- 
        Livewire Menu POS Component
        Transferred from static blade to enable real-time interactivity.
        Wire-model is used for search to allow future filtering logic.
    --}}
    
    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA (CENTER)                 -->
    <!-- ========================================== -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
        <!-- Header -->
        <header class="p-6 md:p-8 pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Welcome Message -->
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Welcome, {{ Auth::user()->name ?? 'Demo User' }}</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Discover whatever you need easily</p>
            </div>
            
            <!-- Search Bar (Livewire Bound) -->
            <div class="relative w-full md:w-64 lg:w-80">
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="Search Product....." 
                    class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-4 pr-10 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]"
                >
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-[#a08f80] hover:text-[#8c5319]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </div>
        </header>

        <div class="mx-6 md:mx-8 border-t border-[#dcc5ae]"></div>

        <!-- Category Pills -->
        <div class="px-6 md:px-8 py-4 overflow-x-auto whitespace-nowrap hide-scrollbar flex gap-2.5">
            
            <!-- Active Category: All Menus -->
            <button class="flex flex-col items-center justify-center min-w-[5rem] h-[5.2rem] rounded-[1.25rem] bg-[#fffdfa] border-2 border-[#8c5319] text-[#8c5319] shadow-[0_2px_8px_-3px_rgba(140,83,25,0.3)] transition-all">
                <div class="bg-[#ebd9c8] p-2 rounded-xl mb-1.5">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <span class="text-[0.6rem] font-bold">All Menus</span>
            </button>
            
            <!-- Other categories... (simplified for brevity, keeping original styles) -->
            @php
                $categories = [
                    ['name' => 'Cold Brew', 'icon' => 'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'],
                    ['name' => 'Iced Lattes', 'icon' => 'M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5'],
                    ['name' => 'Hot Coffee', 'icon' => 'M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z'],
                ];
            @endphp

            @foreach($categories as $cat)
            <button class="flex flex-col items-center justify-center min-w-[5rem] h-[5.2rem] rounded-[1.25rem] bg-[#fffaf5]/60 border border-[#dcc5ae]/70 text-[#5c4a3b] hover:bg-[#fffdfa] hover:border-[#8c5319]/50 transition-all shadow-sm">
                <div class="bg-transparent p-2 rounded-xl mb-1.5 opacity-80">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $cat['icon'] }}" />
                    </svg>
                </div>
                <span class="text-[0.6rem] font-medium">{{ $cat['name'] }}</span>
            </button>
            @endforeach
        </div>

        <div class="mx-6 md:mx-8 border-t border-[#dcc5ae]"></div>

        <!-- Product Grid Area -->
        <div class="flex-1 overflow-y-auto px-6 md:px-8 pb-8 pt-4">
            <div class="bg-white/70 border border-[#dcc5ae] rounded-2xl p-5 shadow-sm">
                <h2 class="font-serif font-bold text-lg text-[#2a241f] mb-4">Available Menus</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                    {{-- 
                        This area will eventually be dynamic based on the $search property.
                        For now, we keep the original static UI blocks as requested for the transfer.
                    --}}
                    
                    <!-- Product Card 1 -->
                    <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                        <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3">
                            <img src="https://loremflickr.com/400/300/icedcoffee,glass/all" alt="Signature Cold Brew" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                            <button class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                        <h3 class="font-bold text-sm text-[#2a241f] mb-1">Signature Cold Brew</h3>
                        <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">Slow-steeped over 18 hours for maximum smoothness and bold flavor.</p>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="font-bold text-[#8c5319] text-sm">$4.50</span>
                            <span class="text-[0.6rem] text-green-600 font-medium tracking-wide">(In Stock)</span>
                        </div>
                    </div>

                    <!-- More cards would go here... -->
                </div>
            </div>
        </div>
    </main>

    <!-- ========================================== -->
    <!-- CART / ORDER MENU SIDEBAR (RIGHT)          -->
    <!-- ========================================== -->
    <aside class="hidden lg:flex w-72 bg-[#fdfaf6] h-full flex-col shadow-[-10px_0_20px_-10px_rgba(0,0,0,0.05)] border-l border-[#dcc5ae] flex-shrink-0 z-10 transition-all duration-300">
        
        <header class="p-6 pb-4 flex justify-between items-center border-b border-[#ebd9c8]">
            <h2 class="font-serif font-bold text-lg text-[#2a241f]">Order Menu</h2>
            <button class="text-[#a08f80] hover:text-[#2a241f]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </header>

        <div class="p-6 pb-2">
            <label class="block text-xs font-bold text-[#2a241f] mb-2">Customer Name</label>
            <input type="text" placeholder="Customer Name" class="w-full border border-[#dcc5ae] rounded-lg px-3 py-2.5 text-sm bg-white focus:outline-none focus:border-[#8c5319] placeholder:text-[#dcc5ae]">
        </div>

        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            <!-- Example Item 1 -->
            <div class="flex items-center gap-3 group">
                <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 border border-[#ebd9c8]">
                    <img src="https://loremflickr.com/100/100/icedcoffee/all" alt="Signature Cold Brew" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-bold text-[#2a241f] truncate">Signature Cold Brew</h4>
                    <p class="text-[0.6rem] text-[#8c5319] font-medium mt-0.5">₱ 129.50</p>
                    <div class="flex items-center gap-2 mt-1.5">
                        <button class="w-5 h-5 rounded-md border border-[#dcc5ae] flex items-center justify-center text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">-</button>
                        <span class="text-[0.65rem] font-bold text-[#2a241f] w-4 text-center">1</span>
                        <button class="w-5 h-5 rounded-md border border-[#dcc5ae] flex items-center justify-center text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">+</button>
                    </div>
                </div>
                <button class="text-[#dcc5ae] hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>

            <!-- Example Item 2 -->
            <div class="flex items-center gap-3 group">
                <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 border border-[#ebd9c8]">
                    <img src="https://loremflickr.com/100/100/pastry/all" alt="Butter Croissant" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-xs font-bold text-[#2a241f] truncate">Butter Croissant</h4>
                    <p class="text-[0.6rem] text-[#8c5319] font-medium mt-0.5">₱ 85.25</p>
                    <div class="flex items-center gap-2 mt-1.5">
                        <button class="w-5 h-5 rounded-md border border-[#dcc5ae] flex items-center justify-center text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">-</button>
                        <span class="text-[0.65rem] font-bold text-[#2a241f] w-4 text-center">2</span>
                        <button class="w-5 h-5 rounded-md border border-[#dcc5ae] flex items-center justify-center text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">+</button>
                    </div>
                </div>
                <button class="text-[#dcc5ae] hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="px-6 py-4 space-y-2.5 border-t border-[#ebd9c8] bg-white/30">
            <div class="flex justify-between items-center text-[0.65rem]">
                <span class="text-[#8a7663]">Subtotal</span>
                <span class="font-bold text-[#2a241f]">₱ 300.00</span>
            </div>
            <div class="flex justify-between items-center text-[0.65rem]">
                <span class="text-[#8a7663]">Tax (10%)</span>
                <span class="font-bold text-[#2a241f]">₱ 30.00</span>
            </div>
            <div class="flex justify-between items-center text-sm pt-2 border-t border-[#ebd9c8]/60">
                <span class="font-bold text-[#2a241f]">Total</span>
                <span class="font-bold text-[#8c5319]">₱ 330.00</span>
            </div>
        </div>

        <div class="p-6 bg-white/50 border-t border-[#ebd9c8]">
            <button class="w-full bg-[#8c5319] hover:bg-[#a66a2a] text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-[#8c5319]/20 transition-all">
                Process to Payment
            </button>
        </div>
    </aside>
</div>
