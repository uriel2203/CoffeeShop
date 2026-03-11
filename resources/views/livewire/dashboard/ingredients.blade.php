<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Ingredients Component
        Handles real-time searching and management of raw materials.
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
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Ingredients</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Manage raw materials and components</p>
                </div>
                
                <div class="flex items-center gap-3 md:gap-4">
                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <input type="text" 
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search ingredients..." 
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>

                    <button 
                        wire:click="createIngredient"
                        class="bg-[#a48466] hover:bg-[#8e6e52] text-white font-medium text-sm py-2.5 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        New Ingredient
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content (Ingredients Table) -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-white/30">
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 text-sm animate-in fade-in slide-in-from-left-4">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden min-w-[700px] md:min-w-0 flex flex-col h-full">
                <div class="flex-1 overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#fcf8f4] sticky top-0 z-10 border-b-2 border-[#ebd9c8]">
                            <tr>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">ID</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">Ingredient</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">Category</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">Stock Level</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">Last Updated</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em] text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f5ede4]">
                            @forelse ($ingredients as $item)
                                <tr class="hover:bg-[#fcf8f4]/80 transition-all duration-200 group" wire:key="ing-{{ $item->id }}">
                                    <td class="px-6 py-4 text-xs font-bold text-[#a08f80]">#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-[#2a241f] group-hover:text-[#8c5319] transition-colors">{{ $item->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[0.65rem] font-black bg-[#ebd9c8]/40 text-[#8c5319] border border-[#ebd9c8]/60 uppercase tracking-tighter">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-[#2a241f]">{{ number_format($item->amount, 1) }} {{ $item->unit }}</span>
                                            <div class="w-24 h-1.5 bg-[#f5ede4] rounded-full mt-1 overflow-hidden">
                                                <div @class([
                                                    'h-full rounded-full transition-all duration-500',
                                                    'bg-red-500' => $item->amount <= ($item->critical_stock_threshold ?? 50),
                                                    'bg-yellow-500' => $item->amount > ($item->critical_stock_threshold ?? 50) && $item->amount <= ($item->low_stock_threshold ?? 100),
                                                    'bg-[#8c5319]' => $item->amount > ($item->low_stock_threshold ?? 100),
                                                ]) style="width: {{ min(100, ($item->amount / (($item->low_stock_threshold ?? 100) * 2)) * 100) }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-[0.7rem] text-[#5c4a3b]">{{ $item->updated_at->format('M d, Y') }}</div>
                                        <div class="text-[0.6rem] text-[#a08f80] italic">{{ $item->updated_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button 
                                            wire:click="editIngredient({{ $item->id }})"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-[#ebd9c8]/30 hover:bg-[#8c5319] text-[#8c5319] hover:text-white rounded-lg text-[0.7rem] font-black transition-all duration-200 border border-[#ebd9c8] hover:border-[#8c5319] group/btn shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center max-w-xs mx-auto">
                                            <div class="w-16 h-16 bg-[#fcf8f4] rounded-full flex items-center justify-center mb-4 border border-[#ebd9c8]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#dcc5ae]">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-sm font-bold text-[#2a241f] mb-1">No ingredients found</h3>
                                            <p class="text-xs text-[#a08f80]">Try adjusting your search criteria or add a new ingredient.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Professional Pagination -->
                <div class="px-6 py-4 bg-[#fcf8f4] border-t border-[#ebd9c8] flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-[0.65rem] font-bold text-[#8a7663] uppercase tracking-wide bg-white px-3 py-1.5 rounded-full border border-[#dcc5ae]">
                        Showing <span class="text-[#8c5319]">{{ $ingredients->firstItem() ?? 0 }}</span> to <span class="text-[#8c5319]">{{ $ingredients->lastItem() ?? 0 }}</span> of <span class="text-[#8c5319]">{{ $ingredients->total() }}</span> entries
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($ingredients->onFirstPage())
                            <span class="px-4 py-2 text-[0.65rem] font-black text-[#a08f80] bg-[#f5ede4] rounded-lg cursor-not-allowed uppercase tracking-widest border border-transparent opacity-60">Previous</span>
                        @else
                            <button 
                                wire:click="previousPage" 
                                wire:loading.attr="disabled"
                                class="px-4 py-2 text-[0.65rem] font-black text-[#8c5319] bg-white border border-[#dcc5ae] rounded-lg hover:bg-[#8c5319] hover:text-white hover:border-[#8c5319] transition-all duration-200 uppercase tracking-widest shadow-sm">
                                Previous
                            </button>
                        @endif

                        <div class="flex items-center gap-1 mx-2">
                            <span class="w-8 h-8 flex items-center justify-center rounded-full bg-[#8c5319] text-white text-[0.7rem] font-black shadow-md shadow-[#8c5319]/20">
                                {{ $ingredients->currentPage() }}
                            </span>
                            <span class="text-[0.7rem] font-bold text-[#8a7663]">of {{ $ingredients->lastPage() }}</span>
                        </div>

                        @if ($ingredients->hasMorePages())
                            <button 
                                wire:click="nextPage" 
                                wire:loading.attr="disabled"
                                class="px-4 py-2 text-[0.65rem] font-black text-[#8c5319] bg-white border border-[#dcc5ae] rounded-lg hover:bg-[#8c5319] hover:text-white hover:border-[#8c5319] transition-all duration-200 uppercase tracking-widest shadow-sm">
                                Next
                            </button>
                        @else
                            <span class="px-4 py-2 text-[0.65rem] font-black text-[#a08f80] bg-[#f5ede4] rounded-lg cursor-not-allowed uppercase tracking-widest border border-transparent opacity-60">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal: Add/Edit Ingredient -->
    @if($showModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div 
                class="absolute inset-0 bg-[#2c221a]/60 backdrop-blur-sm transition-opacity"
                wire:click="$set('showModal', false)">
            </div>

            <!-- Modal Content -->
            <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-[#dcc5ae] animate-in zoom-in duration-200">
                <div class="p-6 md:p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-[#2a241f]">{{ $ingredientId ? 'Edit' : 'Create' }} Ingredient</h2>
                            <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">{{ $ingredientId ? 'Update ingredient details' : 'Add a new raw material to your records' }}</p>
                        </div>
                        <button 
                            wire:click="$set('showModal', false)"
                            class="p-2 hover:bg-[#fcf8f4] rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-[#a08f80]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="save" class="space-y-4">
                        <!-- Name -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Ingredient Name</label>
                            <input type="text" wire:model="name" placeholder="e.g. Arabica Beans" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                            @error('name') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div class="space-y-1 relative" x-data="{ open: false, search: @entangle('category') }">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Category</label>
                            
                            <div class="relative">
                                <input 
                                    type="text" 
                                    x-model="search"
                                    @focus="open = true"
                                    @click.away="open = false"
                                    placeholder="e.g. Beans, Dairy, Sweetener" 
                                    class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]"
                                >
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none transition-transform duration-200" :class="open ? 'rotate-180' : ''">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-[#a08f80]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Custom Dropdown Menu -->
                            <div 
                                x-show="open" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 w-full mt-1 bg-white border border-[#dcc5ae] rounded-xl shadow-xl max-h-48 overflow-y-auto custom-scrollbar"
                                style="display: none;"
                            >
                                @forelse($existingCategories as $cat)
                                    <button 
                                        type="button"
                                        x-on:click="search = '{{ $cat }}'; open = false"
                                        class="w-full text-left px-4 py-2.5 text-sm text-[#5c4a3b] hover:bg-[#fcf8f4] hover:text-[#8c5319] transition-colors flex items-center justify-between group"
                                    >
                                        <span>{{ $cat }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-[#dcc5ae] group-hover:text-[#8c5319] opacity-0 group-hover:opacity-100 transition-opacity">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                    </button>
                                @empty
                                    <div class="px-4 py-3 text-xs text-[#a08f80] italic">
                                        No existing categories. Type to create one!
                                    </div>
                                @endforelse
                            </div>

                            <p class="text-[0.6rem] text-[#a08f80] mt-1 italic">Type a new category or select an existing one.</p>
                            @error('category') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Unit -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Unit of Measurement</label>
                            <div class="relative">
                                <select wire:model="unit" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] appearance-none cursor-pointer">
                                    <option value="">Select Unit</option>
                                    <option value="g">Grams (g)</option>
                                    <option value="kg">Kilograms (kg)</option>
                                    <option value="ml">Milliliters (ml)</option>
                                    <option value="L">Liters (L)</option>
                                    <option value="pcs">Pieces (pcs)</option>
                                    <option value="oz">Ounces (oz)</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-[#a08f80]">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                            </div>
                            @error('unit') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Thresholds -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Low Stock Threshold</label>
                                <input type="number" step="0.01" wire:model="lowStockThreshold" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                                <p class="text-[0.6rem] text-[#a08f80] italic mt-1">Status turns <span class="text-yellow-600 font-bold">Yellow</span></p>
                                @error('lowStockThreshold') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Critical Threshold</label>
                                <input type="number" step="0.01" wire:model="criticalStockThreshold" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                                <p class="text-[0.6rem] text-[#a08f80] italic mt-1">Status turns <span class="text-red-600 font-bold">Red</span></p>
                                @error('criticalStockThreshold') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button 
                                type="button"
                                wire:click="$set('showModal', false)"
                                class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-[#8a7663] bg-[#fcf8f4] hover:bg-[#f5ede4] transition-colors">
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-white bg-[#8c5319] hover:bg-[#6d4013] shadow-lg shadow-[#8c5319]/20 transition-all">
                                {{ $ingredientId ? 'Update Ingredient' : 'Create Ingredient' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
