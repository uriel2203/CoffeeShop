<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Inventory Component
        Handles physical restocking logs and automatic ingredient stock increments.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
        <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8] flex-shrink-0">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Inventory History</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Track physical restocking logs and batch expirations</p>
                </div>
                
                <div class="flex items-center gap-3 md:gap-4">
                    <!-- Search Bar (Filters by Ingredient Name) -->
                    <div class="relative w-full md:w-64">
                        <input type="text" 
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search logs by ingredient..." 
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>

                    <button 
                        wire:click="openStockInModal"
                        class="bg-[#a48466] hover:bg-[#8e6e52] text-white font-medium text-sm py-2.5 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Stock In
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content (Inventory History Table) -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-white/30">
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 text-sm animate-in fade-in slide-in-from-left-4">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden min-w-[800px] md:min-w-0 flex flex-col h-full">
                <div class="flex-1 overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#fcf8f4] sticky top-0 z-10 border-b-2 border-[#ebd9c8]">
                            <tr>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em] text-center w-16">ID</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">Ingredient</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">Stock Amount</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em] hidden md:table-cell">Batch Expiry</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">Last Status</th>
                                <th class="px-6 py-5 text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em] text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f5ede4]">
                            @forelse ($inventoryHistory as $index => $item)
                                <tr class="hover:bg-[#fcf8f4]/80 transition-all duration-200 group" wire:key="inv-{{ $item->name }}">
                                    <td class="px-6 py-4 text-xs font-bold text-[#a08f80] text-center">#{{ str_pad($inventoryHistory->firstItem() + $index, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-[#2a241f] group-hover:text-[#8c5319] transition-colors uppercase tracking-tight">{{ $item->name }}</div>
                                        <div class="text-[0.6rem] font-black text-[#8c5319]/60 uppercase tracking-widest mt-0.5">{{ $item->category }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-[#2a241f]">{{ number_format($item->total_amount, 1) }} {{ $item->unit }}</span>
                                            <div class="text-[0.65rem] text-[#a08f80] italic">Current Total</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 hidden md:table-cell">
                                        @if($item->latest_expiry)
                                            <span @class([
                                                'inline-flex items-center px-2.5 py-1 rounded-lg text-[0.65rem] font-black border uppercase tracking-tighter',
                                                'bg-red-50 text-red-600 border-red-100' => \Carbon\Carbon::parse($item->latest_expiry)->isPast(),
                                                'bg-green-50 text-green-600 border-green-100' => !\Carbon\Carbon::parse($item->latest_expiry)->isPast(),
                                            ])>
                                                {{ \Carbon\Carbon::parse($item->latest_expiry)->format('M d, Y') }}
                                            </span>
                                        @else
                                            <span class="text-[#a08f80] italic text-[0.7rem] font-medium opacity-60">No Expiry Tracked</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <div class="text-[0.7rem] font-bold text-[#5c4a3b]">{{ $item->last_added ? $item->last_added->format('M d, g:i A') : 'N/A' }}</div>
                                            <div class="text-[0.6rem] text-[#a08f80] italic">{{ $item->last_updated ? $item->last_updated->diffForHumans() : 'N/A' }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button 
                                            wire:click="editSummarized('{{ $item->name }}')"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-[#ebd9c8]/30 hover:bg-[#8c5319] text-[#8c5319] hover:text-white rounded-lg text-[0.7rem] font-black transition-all duration-200 border border-[#ebd9c8] hover:border-[#8c5319] group/btn shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-[#8c5319] group-hover/btn:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                            Adjust
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center max-w-xs mx-auto">
                                            <div class="w-16 h-16 bg-[#fcf8f4] rounded-full flex items-center justify-center mb-4 border border-[#ebd9c8]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#dcc5ae]">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0016.5 4.5h-8.25a2.25 2.25 0 00-2.25 2.25V18a2.25 2.25 0 002.25 2.25h8.25" />
                                                </svg>
                                            </div>
                                            <h3 class="text-sm font-bold text-[#2a241f] mb-1">No logs found</h3>
                                            <p class="text-xs text-[#a08f80]">Try searching for a different ingredient or record a new stock entry.</p>
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
                        Showing <span class="text-[#8c5319]">{{ $inventoryHistory->firstItem() ?? 0 }}</span> to <span class="text-[#8c5319]">{{ $inventoryHistory->lastItem() ?? 0 }}</span> of <span class="text-[#8c5319]">{{ $inventoryHistory->total() }}</span> entries
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($inventoryHistory->onFirstPage())
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
                                {{ $inventoryHistory->currentPage() }}
                            </span>
                            <span class="text-[0.7rem] font-bold text-[#8a7663]">of {{ $inventoryHistory->lastPage() }}</span>
                        </div>

                        @if ($inventoryHistory->hasMorePages())
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

    <!-- Modal: Stock In (Add New Stock Arrival) -->
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
                            <h2 class="font-serif text-2xl font-bold text-[#2a241f]">Stock In</h2>
                            <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Record a new stock arrival and increase ingredient totals</p>
                        </div>
                        <button 
                            wire:click="$set('showModal', false)"
                            class="p-2 hover:bg-[#fcf8f4] rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-[#a08f80]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="stockIn" class="space-y-4">
                        <!-- Ingredient Dropdown -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Select Ingredient</label>
                            <select wire:model="ingredient_id" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] appearance-none cursor-pointer">
                                <option value="">Select an ingredient...</option>
                                @foreach($ingredients as $ing)
                                    <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->unit }}) - Current: {{ $ing->amount }}</option>
                                @endforeach
                            </select>
                            @error('ingredient_id') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Amount to Add -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Amount Being Added</label>
                            <input type="number" step="0.01" wire:model="amount" placeholder="e.g. 500.00" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                            <p class="text-[0.6rem] text-[#a08f80] mt-1 italic">This amount will be added to the total stock of the selected ingredient.</p>
                            @error('amount') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Expiration Date -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Batch Expiry Date (Optional)</label>
                            <input type="date" wire:model="expiry_date" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#2a241f] cursor-pointer">
                            @error('expiry_date') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
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
                                class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-white bg-[#8c5319] hover:bg-[#6d4013] shadow-lg shadow-[#8c5319]/20 transition-all flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Save Stock In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal: Edit Adjustment (Adjust Total Stock) -->
    @if($showEditModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div 
                class="absolute inset-0 bg-[#2c221a]/60 backdrop-blur-sm transition-opacity"
                wire:click="$set('showEditModal', false)">
            </div>

            <!-- Modal Content -->
            <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-[#dcc5ae] animate-in zoom-in duration-200">
                <div class="p-6 md:p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-[#2a241f]">Adjust Inventory</h2>
                            <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Update total stock and latest batch expiry for <span class="font-bold text-[#8c5319] underline capitalize">{{ $editingName }}</span></p>
                        </div>
                        <button 
                            wire:click="$set('showEditModal', false)"
                            class="p-2 hover:bg-[#fcf8f4] rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-[#a08f80]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="saveAdjustment" class="space-y-4">
                        <!-- Total Amount -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Overall Total Stock Amount</label>
                            <input type="number" step="0.01" wire:model="editingAmount" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                            <p class="text-[0.6rem] text-[#a08f80] mt-1 italic">This will adjust the sum of all ingredients named "{{ $editingName }}".</p>
                            @error('editingAmount') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Latest Expiry -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Latest Batch Expiry Date</label>
                            <input type="date" wire:model="editingExpiry" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#2a241f] cursor-pointer">
                            @error('editingExpiry') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button 
                                type="button"
                                wire:click="$set('showEditModal', false)"
                                class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-[#8a7663] bg-[#fcf8f4] hover:bg-[#f5ede4] transition-colors">
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition-all flex items-center justify-center gap-2">
                                Save Adjustments
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
