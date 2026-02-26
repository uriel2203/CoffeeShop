<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Products Component
        Manages menu items, recipes, and image uploads.
    --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #fcf8f4;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #dcc5ae;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #8a7663;
        }
    </style>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8] flex-shrink-0">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Products & Menu</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Design your menu and link ingredients to recipes</p>
                </div>
                
                <div class="flex items-center gap-3 md:gap-4">
                    <div class="relative w-full md:w-64">
                        <input type="text" 
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search products..." 
                            class="w-full bg-white border border-[#dcc5ae] rounded-2xl py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] transition-all placeholder:text-[#a08f80] text-[#2a241f]"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>

                    <button 
                        wire:click="createProduct"
                        class="bg-[#8c5319] hover:bg-[#6f4214] text-white px-5 py-2.5 rounded-2xl font-bold text-sm transition-all shadow-lg flex items-center gap-2 flex-shrink-0 whitespace-nowrap active:scale-95"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Product
                    </button>
                </div>
            </div>
        </header>

        <!-- Product Grid -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8 custom-scrollbar bg-[#fdfaf7]/50">
            @if(session()->has('message'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm flex items-center gap-3 animate-in fade-in slide-in-from-top-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white rounded-3xl p-4 shadow-sm border border-[#f5ede4] group hover:shadow-xl hover:border-[#ebd9c8] transition-all duration-300 relative overflow-hidden">
                        <!-- Image Container -->
                        <div class="relative aspect-square rounded-2xl overflow-hidden bg-[#fcf8f4] mb-4">
                            {{-- 
                                Image retrieval uses the asset() helper with the 'storage/' prefix.
                                This works because of the symbolic link created by 'php artisan storage:link'.
                                It links public/storage to storage/app/public.
                            --}}
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-[#dcc5ae]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2 opacity-50">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6.75A1.5 1.5 0 0 0 19.5 5.25h-16.5A1.5 1.5 0 0 0 2 6.75v10.5a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <span class="text-[0.6rem] font-bold uppercase tracking-widest">No Image</span>
                                </div>
                            @endif

                            <!-- Availability Badge -->
                            @php
                                $hasStock = $product->hasSufficientStock();
                                $isActuallyAvailable = $product->is_available && $hasStock;
                                $statusLabel = $isActuallyAvailable ? 'Available' : ($hasStock ? 'Unavailable' : 'Out of Stock');
                                $badgeColor = $isActuallyAvailable ? 'bg-white/90 text-[#8c5319]' : 'bg-red-500/90 text-white';
                            @endphp
                            <div class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[0.65rem] font-bold shadow-sm backdrop-blur-md {{ $badgeColor }}">
                                {{ $statusLabel }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="space-y-1 px-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-[0.65rem] font-bold text-[#8c5319] uppercase tracking-wider mb-0.5">{{ $product->category }}</p>
                                    <h3 class="font-serif text-lg font-bold text-[#2a241f] leading-tight line-clamp-1">{{ $product->name }}</h3>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-[#2a241f]">₱{{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-3 mt-3 border-t border-[#f5ede4]">
                                <button wire:click="editProduct({{ $product->id }})" class="flex-1 bg-[#fcf8f4] hover:bg-[#ebd9c8] text-[#5c4a3b] text-xs font-bold py-2 rounded-xl transition-colors">
                                    Edit
                                </button>
                                <button wire:click="$set('productToDelete', {{ $product->id }}); $set('showDeleteModal', true)" class="w-10 h-10 flex items-center justify-center text-[#a08f80] hover:text-red-500 hover:bg-red-50 transition-colors rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20 text-[#a08f80]">
                        <div class="bg-white rounded-full p-8 mb-4 shadow-sm border border-[#f5ede4]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 opacity-30">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <p class="font-serif text-lg font-bold text-[#5c4a3b]">Design Your Menu</p>
                        <p class="text-sm">No products found. Start by adding your first menu item.</p>
                    </div>
                @endforelse
            </div>

            @if($products->hasPages())
                <div class="mt-8 pt-6 border-t border-[#ebd9c8]">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </main>

    <!-- Modal: Add/Edit Product -->
    @if($showModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-[#2c221a]/70 backdrop-blur-md transition-opacity" wire:click="$set('showModal', false)"></div>

            <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden border border-[#dcc5ae] animate-in zoom-in duration-200 flex flex-col">
                <div class="p-6 md:p-8 flex items-center justify-between border-b border-[#f5ede4] flex-shrink-0">
                    <div>
                        <h2 class="font-serif text-2xl font-bold text-[#2a241f]">{{ $productId ? 'Edit' : 'Create' }} Product</h2>
                        <p class="text-xs text-[#5c4a3b] mt-1">Configure details and ingredient recipe</p>
                    </div>
                    <button wire:click="$set('showModal', false)" class="p-2 hover:bg-[#fcf8f4] rounded-full transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 md:p-8 custom-scrollbar">
                    <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Side: Basic Info -->
                        <div class="space-y-6">
                            <div class="bg-[#fcf8f4] p-5 rounded-3xl border border-[#ebd9c8]">
                                <h3 class="text-xs font-bold text-[#8c5319] uppercase tracking-widest mb-4">Basic Information</h3>
                                
                                <div class="space-y-4">
                                    <div class="space-y-1">
                                        <label class="text-[0.65rem] font-bold text-[#8a7663] uppercase tracking-wide px-1">Product Name</label>
                                        <input type="text" wire:model="name" placeholder="e.g. Salted Caramel Latte" class="w-full bg-white border border-[#dcc5ae] rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                                        @error('name') <span class="text-[0.65rem] text-red-500 font-medium px-1">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-1 relative" x-data="{ open: false, search: @entangle('category') }">
                                            <label class="text-[0.65rem] font-bold text-[#8a7663] uppercase tracking-wide px-1">Category</label>
                                            <input type="text" x-model="search" @focus="open = true" @click.away="open = false" placeholder="e.g. Coffee" class="w-full bg-white border border-[#dcc5ae] rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                                            <div x-show="open" class="absolute z-50 w-full mt-1 bg-white border border-[#dcc5ae] rounded-xl shadow-xl max-h-32 overflow-y-auto custom-scrollbar" style="display: none;">
                                                @foreach($existingCategories as $cat)
                                                    <button type="button" x-on:click="search = '{{ $cat }}'; open = false" class="w-full text-left px-4 py-2 text-xs text-[#5c4a3b] hover:bg-[#fcf8f4] transition-colors">{{ $cat }}</button>
                                                @endforeach
                                            </div>
                                            @error('category') <span class="text-[0.65rem] text-red-500 font-medium px-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="space-y-1">
                                            <label class="text-[0.65rem] font-bold text-[#8a7663] uppercase tracking-wide px-1">Price (₱)</label>
                                            <input type="number" step="0.01" wire:model="price" placeholder="0.00" class="w-full bg-white border border-[#dcc5ae] rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319]">
                                            @error('price') <span class="text-[0.65rem] text-red-500 font-medium px-1">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 py-2 px-1">
                                        <div class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" wire:model="is_available" class="sr-only peer">
                                            <div class="w-11 h-6 bg-[#dcc5ae] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#8c5319]"></div>
                                            <span class="ml-3 text-sm font-bold text-[#2a241f]">Mark as Available</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-[#fcf8f4] p-5 rounded-3xl border border-[#ebd9c8]">
                                <h3 class="text-xs font-bold text-[#8c5319] uppercase tracking-widest mb-4">Product Image</h3>
                                
                                <div class="space-y-4">
                                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-white border-2 border-dashed border-[#dcc5ae] group flex flex-col items-center justify-center pointer-events-none">
                                        @if($image)
                                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                        @elseif($existingImage)
                                            <img src="{{ asset('storage/' . $existingImage) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-[#dcc5ae] mb-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6.75A1.5 1.5 0 0 0 19.5 5.25h-16.5A1.5 1.5 0 0 0 2 6.75v10.5a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                            <span class="text-[0.6rem] font-bold text-[#a08f80] uppercase tracking-widest">Recommended: 800x800</span>
                                        @endif

                                        <div wire:loading wire:target="image" class="absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center">
                                            <div class="w-6 h-6 border-2 border-[#8c5319] border-t-transparent rounded-full animate-spin"></div>
                                        </div>
                                    </div>

                                    <div class="relative">
                                        <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                        <div class="bg-white border border-[#dcc5ae] hover:border-[#8c5319] text-[#5c4a3b] text-xs font-bold py-3 px-4 rounded-xl transition-all flex items-center justify-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                            </svg>
                                            Upload Image
                                        </div>
                                    </div>
                                    @error('image') <span class="text-[0.65rem] text-red-500 font-medium px-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Recipe Builder -->
                        <div class="space-y-6 flex flex-col h-full">
                            <div class="bg-[#fcf8f4] p-5 rounded-3xl border border-[#ebd9c8] flex-1 flex flex-col">
                                <h3 class="text-xs font-bold text-[#8c5319] uppercase tracking-widest mb-4">Recipe Ingredients</h3>
                                
                                <!-- Tool: Add Ingredient -->
                                <div class="grid grid-cols-5 gap-2 mb-4">
                                    <div class="col-span-3">
                                        <select wire:model="ingredientToAdd" class="w-full bg-white border border-[#dcc5ae] rounded-xl py-2 px-3 text-xs focus:outline-none">
                                            <option value="">Select Ingredient</option>
                                            @foreach($allIngredients as $category => $ingredients)
                                                <optgroup label="{{ $category }}">
                                                    @foreach($ingredients as $ing)
                                                        <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }})</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-1">
                                        <input type="number" step="0.01" wire:model="amountToAdd" placeholder="Qty" class="w-full bg-white border border-[#dcc5ae] rounded-xl py-2 px-2 text-xs focus:outline-none">
                                    </div>
                                    <button type="button" wire:click="addIngredient" class="bg-[#8c5319] text-white rounded-xl flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </div>
                                @if(session()->has('recipe_error'))
                                    <p class="text-[0.6rem] text-red-500 font-medium mb-3">{{ session('recipe_error') }}</p>
                                @endif

                                <!-- List of Selection -->
                                <div class="flex-1 min-h-[200px] max-h-[400px] overflow-y-auto custom-scrollbar border border-[#f5ede4] rounded-2xl bg-white/50 p-2">
                                    @forelse($selectedIngredients as $index => $item)
                                        <div class="flex items-center justify-between p-3 bg-white border border-[#f5ede4] rounded-xl mb-2 group animate-in slide-in-from-right-2">
                                            <div>
                                                <p class="text-xs font-bold text-[#2a241f]">{{ $item['name'] }}</p>
                                                <p class="text-[0.65rem] text-[#8a7663]">{{ $item['amount'] }} {{ $item['unit'] }} per serving</p>
                                            </div>
                                            <button type="button" wire:click="removeIngredient({{ $index }})" class="p-1.5 text-[#dcc5ae] hover:text-red-500 hover:bg-red-50 rounded-lg transition-all group-hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @empty
                                        <div class="h-full flex flex-col items-center justify-center text-[#a08f80] py-10 opacity-60">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 mb-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-0.375 5.25h.007v.008H3.75v-0.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                            <p class="text-[0.65rem] font-bold uppercase tracking-widest">No Ingredients Linked</p>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="mt-2">
                                    @error('selectedIngredients') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="col-span-full pt-4 border-t border-[#f5ede4] flex justify-end gap-3 bg-white sticky bottom-0 z-10 py-4">
                            <button type="button" wire:click="$set('showModal', false)" class="px-6 py-2.5 rounded-2xl text-[#5c4a3b] font-bold text-sm hover:bg-[#fcf8f4] transition-all">
                                Cancel
                            </button>
                            <button type="submit" class="bg-[#8c5319] hover:bg-[#6f4214] text-white px-8 py-2.5 rounded-2xl font-bold text-sm shadow-lg shadow-[#8c5319]/20 transition-all flex items-center gap-2">
                                <div wire:loading wire:target="save" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                                {{ $productId ? 'Update Product' : 'Create Product' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-[70] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-[#2c221a]/80 backdrop-blur-sm transition-opacity" wire:click="$set('showDeleteModal', false)"></div>
            <div class="relative bg-white rounded-3xl shadow-2xl w-full max-sm:max-w-sm overflow-hidden p-8 animate-in zoom-in duration-200 text-center border border-[#dcc5ae]">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </div>
                <h3 class="font-serif text-xl font-bold text-[#2a241f] mb-2 font-bold">Remove Product?</h3>
                <p class="text-sm text-[#5c4a3b] mb-8 italic">This will permanently delete the product and its recipe. This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button wire:click="$set('showDeleteModal', false)" class="flex-1 px-4 py-2.5 rounded-xl border border-[#dcc5ae] text-[#5c4a3b] font-bold text-sm hover:bg-[#fcf8f4] transition-all">Cancel</button>
                    <button wire:click="delete" class="flex-1 px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold text-sm shadow-lg shadow-red-200 transition-all">Delete</button>
                </div>
            </div>
        </div>
    @endif
</div>
