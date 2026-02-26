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

            <div class="bg-white rounded-2xl border border-[#dcc5ae] shadow-sm overflow-hidden min-w-[700px] md:min-w-0">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#fcf8f4] border-b border-[#ebd9c8]">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-[#8a7663] uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#8a7663] uppercase tracking-wider">Ingredient</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#8a7663] uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#8a7663] uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#8a7663] uppercase tracking-wider">Created At</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#8a7663] uppercase tracking-wider">Updated At</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#8a7663] uppercase tracking-wider text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f5ede4]">
                        @forelse ($ingredients as $item)
                            <tr class="hover:bg-[#fcf8f4]/50 transition-colors" wire:key="ing-{{ $item->id }}">
                                <td class="px-6 py-4 text-sm text-[#8a7663]">#{{ $item->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-[#2c221a]">{{ $item->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2.5 py-1 rounded-full text-[0.7rem] font-bold bg-[#ebd9c8]/50 text-[#8c5319] uppercase tracking-wide">
                                        {{ $item->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-[#5c4a3b]">
                                    {{ number_format($item->amount, 2) }} <span class="text-xs text-[#a08f80]">{{ $item->unit }}</span>
                                </td>
                                <td class="px-6 py-4 text-xs text-[#8a7663]">
                                    {{ $item->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-xs text-[#8a7663]">
                                    {{ $item->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button 
                                        wire:click="editIngredient({{ $item->id }})"
                                        class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md text-xs font-bold transition-all border border-blue-100">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-[#a08f80]">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mb-2 opacity-50">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                        <p>No ingredients found matching your search.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                @if($ingredients->hasPages())
                    <div class="px-6 py-4 border-t border-[#f5ede4]">
                        {{ $ingredients->links() }}
                    </div>
                @endif
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
                            <select wire:model="unit" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] appearance-none cursor-pointer">
                                <option value="">Select Unit</option>
                                <option value="g">Grams (g)</option>
                                <option value="kg">Kilograms (kg)</option>
                                <option value="ml">Milliliters (ml)</option>
                                <option value="L">Liters (L)</option>
                                <option value="pcs">Pieces (pcs)</option>
                                <option value="oz">Ounces (oz)</option>
                            </select>
                            @error('unit') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
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
