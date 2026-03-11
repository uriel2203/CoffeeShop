<div class="flex-1 flex overflow-hidden w-full" x-data="{ showReceipt: @entangle('showReceipt') }">
    {{-- 
        Livewire Menu POS Component
        Restored to original UI layout while maintaining the new reactive POS logic.
    --}}
    
    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA (CENTER)                 -->
    <!-- ========================================== -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
        <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8] flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Welcome Message -->
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Welcome, {{ Auth::user()->name ?? 'Demo User' }}</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Discover whatever you need easily</p>
            </div>
            
            <!-- Search Bar (Livewire Bound) -->
            <div class="relative w-full md:w-64 lg:w-80">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search Product....." 
                    class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-4 pr-10 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]"
                >
                <div class="absolute right-3 top-1/2 -translate-y-1/2 text-[#a08f80]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>
        </header>

        {{-- Main Menu Content Area --}}
        <div class="flex-1 overflow-y-auto bg-white/30">

        <!-- Category Pills -->
        <div class="px-6 md:px-8 py-4 overflow-x-auto whitespace-nowrap hide-scrollbar flex gap-2.5">
            
            <button 
                wire:click="$set('activeCategory', 'All')"
                class="flex flex-col items-center justify-center min-w-[5rem] h-[5.2rem] rounded-[1.25rem] transition-all {{ $activeCategory === 'All' ? 'bg-[#fffdfa] border-2 border-[#8c5319] text-[#8c5319] shadow-[0_2px_8px_-3px_rgba(140,83,25,0.3)]' : 'bg-[#fffaf5]/60 border border-[#dcc5ae]/70 text-[#5c4a3b]' }}"
            >
                <div class="p-2 rounded-xl mb-1.5 {{ $activeCategory === 'All' ? 'bg-[#ebd9c8]' : 'bg-transparent opacity-80' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <span class="text-[0.6rem] font-bold">All Menus</span>
            </button>
            
            @foreach($categories as $cat)
            <button 
                wire:click="$set('activeCategory', '{{ $cat }}')"
                class="flex flex-col items-center justify-center min-w-[5rem] h-[5.2rem] rounded-[1.25rem] transition-all {{ $activeCategory === $cat ? 'bg-[#fffdfa] border-2 border-[#8c5319] text-[#8c5319] shadow-[0_2px_8px_-3px_rgba(140,83,25,0.3)]' : 'bg-[#fffaf5]/60 border border-[#dcc5ae]/70 text-[#5c4a3b]' }}"
            >
                <div class="p-2 rounded-xl mb-1.5 {{ $activeCategory === $cat ? 'bg-[#ebd9c8]' : 'bg-transparent opacity-80' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                    </svg>
                </div>
                <span class="text-[0.6rem] font-medium">{{ $cat }}</span>
            </button>
            @endforeach
        </div>

        <!-- Product Grid Area -->
        <div class="flex-1 px-6 md:px-8 pb-8 pt-4">
            <div class="bg-white border border-[#dcc5ae] rounded-2xl p-5 shadow-sm">
                <h2 class="font-serif font-bold text-lg text-[#2a241f] mb-4">Available Menus</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                    @forelse($products as $product)
                        <!-- Product Card -->
                        <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                            <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3 bg-[#fcf8f4]">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#dcc5ae]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 opacity-30">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6.75A1.5 1.5 0 0 0 19.5 5.25h-16.5A1.5 1.5 0 0 0 2 6.75v10.5a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                @endif
                                <button 
                                    wire:click="addToCart({{ $product->id }})"
                                    class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                            <h3 class="font-bold text-sm text-[#2a241f] mb-1 line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">{{ $product->description }}</p>
                            <div class="flex justify-between items-center mt-auto">
                                <span class="font-bold text-[#8c5319] text-sm">₱{{ number_format($product->price, 2) }}</span>
                                <span class="text-[0.6rem] text-green-600 font-medium tracking-wide">(In Stock)</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-10 text-center text-[#a08f80]">
                            <p>No products found in this category.</p>
                        </div>
                    @endforelse
                </div>
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
            <button wire:click="$set('cart', [])" class="text-[#a08f80] hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
        </header>

        <div class="p-6 pb-2 space-y-3">
            <div>
                <label class="block text-xs font-bold text-[#2a241f] mb-2">Customer Name</label>
                <input type="text" wire:model="customerName" placeholder="Customer Name" class="w-full border border-[#dcc5ae] rounded-lg px-3 py-2.5 text-sm bg-white focus:outline-none focus:border-[#8c5319] placeholder:text-[#dcc5ae]">
            </div>
            
            <div class="flex gap-1">
                <button wire:click="$set('discountType', 'none')" class="flex-1 py-1.5 rounded-lg text-[0.6rem] font-bold border transition-all {{ $discountType === 'none' ? 'bg-[#2a241f] text-white border-[#2a241f]' : 'bg-white text-[#5c4a3b] border-[#ebd9c8]' }}">NONE</button>
                <button wire:click="$set('discountType', 'senior')" class="flex-1 py-1.5 rounded-lg text-[0.6rem] font-bold border transition-all {{ $discountType === 'senior' ? 'bg-[#8c5319] text-white border-[#8c5319]' : 'bg-white text-[#5c4a3b] border-[#ebd9c8]' }}">SENIOR</button>
                <button wire:click="$set('discountType', 'pwd')" class="flex-1 py-1.5 rounded-lg text-[0.6rem] font-bold border transition-all {{ $discountType === 'pwd' ? 'bg-[#8c5319] text-white border-[#8c5319]' : 'bg-white text-[#5c4a3b] border-[#ebd9c8]' }}">PWD</button>
            </div>

            <div class="flex gap-1">
                <button wire:click="$set('paymentMethod', 'cash')" class="flex-1 py-1.5 rounded-lg text-[0.6rem] font-bold border transition-all {{ $paymentMethod === 'cash' ? 'bg-[#2a241f] text-white border-[#2a241f]' : 'bg-white text-[#5c4a3b] border-[#ebd9c8]' }}">CASH</button>
                <button wire:click="$set('paymentMethod', 'gcash')" class="flex-1 py-1.5 rounded-lg text-[0.6rem] font-bold border transition-all {{ $paymentMethod === 'gcash' ? 'bg-[#2a241f] text-white border-[#2a241f]' : 'bg-white text-[#5c4a3b] border-[#ebd9c8]' }}">GCASH</button>
            </div>
            
            @if($paymentMethod === 'cash')
                <input type="number" wire:model.live="cashTendered" placeholder="Amount Tendered" class="w-full border border-[#dcc5ae] rounded-lg px-3 py-2.5 text-sm bg-white focus:outline-none focus:border-[#8c5319] placeholder:text-[#dcc5ae] mt-2">
            @endif
        </div>

        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            @foreach($cart as $id => $item)
                <div class="flex items-center gap-3 group">
                    <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 border border-[#ebd9c8] bg-[#fcf8f4]">
                        @php $p = \App\Models\Product::find($id); @endphp
                        @if($p && $p->image_path)
                            <img src="{{ asset('storage/' . $p->image_path) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[#dcc5ae]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-bold text-[#2a241f] truncate">{{ $item['name'] }}</h4>
                        <p class="text-[0.6rem] text-[#8c5319] font-medium mt-0.5">₱{{ number_format($item['total'], 2) }}</p>
                        <div class="flex items-center gap-2 mt-1.5">
                            <button wire:click="decrementQuantity({{ $id }})" class="w-5 h-5 rounded-md border border-[#dcc5ae] flex items-center justify-center text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">-</button>
                            <span class="text-[0.65rem] font-bold text-[#2a241f] w-4 text-center">{{ $item['quantity'] }}</span>
                            <button wire:click="incrementQuantity({{ $id }})" class="w-5 h-5 rounded-md border border-[#dcc5ae] flex items-center justify-center text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">+</button>
                        </div>
                    </div>
                    <button wire:click="removeFromCart({{ $id }})" class="text-[#dcc5ae] hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="px-6 py-4 space-y-2 pb-0 border-t border-[#ebd9c8] bg-white/30">
            <div class="flex justify-between items-center text-[0.65rem]">
                <span class="text-[#8a7663]">Subtotal</span>
                <span class="font-bold text-[#2a241f]">₱{{ number_format($this->subtotal, 2) }}</span>
            </div>
            @if($this->discountAmount > 0)
                <div class="flex justify-between items-center text-[0.65rem] text-green-600">
                    <span>Discount ({{ strtoupper($discountType) }})</span>
                    <span class="font-bold">-₱{{ number_format($this->discountAmount, 2) }}</span>
                </div>
            @endif
            <div class="flex justify-between items-center text-[0.65rem]">
                <span class="text-[#8a7663]">Tax (12% Included)</span>
                <span class="font-bold text-[#2a241f]">₱{{ number_format($this->taxAmount, 2) }}</span>
            </div>
            @if($paymentMethod === 'cash')
                <div class="flex justify-between items-center text-[0.65rem] pt-1">
                    <span class="text-[#8a7663]">Change</span>
                    <span class="font-bold text-[#8c5319]">₱{{ number_format($this->cashChange, 2) }}</span>
                </div>
            @endif
            <div class="flex justify-between items-center text-sm pt-2 border-t border-[#ebd9c8]/60 mt-1">
                <span class="font-bold text-[#2a241f]">Total</span>
                <span class="font-bold text-[#8c5319]">₱{{ number_format($this->total, 2) }}</span>
            </div>
        </div>

        <div class="p-6 bg-white/50 border-t border-[#ebd9c8] mt-4">
            <button 
                wire:click="confirmOrder"
                class="w-full bg-[#8c5319] hover:bg-[#a66a2a] text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-[#8c5319]/20 transition-all disabled:opacity-50 disabled:grayscale"
                @if(empty($cart) || ($paymentMethod === 'cash' && (!$cashTendered || $cashTendered < $this->total))) disabled @endif
            >
                Confirm Order
            </button>
        </div>
    </aside>

    <!-- Receipt Modal (Restored visual but unified logic) -->
    <div 
        x-show="showReceipt" 
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#2c221a]/80 backdrop-blur-sm"
        style="display: none;"
    >
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm overflow-hidden p-8 flex flex-col items-center">
            <div class="w-16 h-16 bg-green-50 text-green-500 rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <h2 class="font-serif text-xl font-bold text-[#2a241f] mb-1">Order Confirmed!</h2>
            <p class="text-xs text-[#8a7663] mb-6">Payment processed successfully.</p>
            
            <button 
                wire:click="newOrder"
                class="w-full py-3 rounded-xl bg-[#8c5319] text-white font-bold text-sm shadow-md"
            >
                Start New Order
            </button>
        </div>
    </div>
</div>
