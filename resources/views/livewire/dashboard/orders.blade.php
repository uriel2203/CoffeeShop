<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Orders Component
        Restored to original UI layout while maintaining dynamic history and voiding logic.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header & Filters -->
        <header class="p-6 md:p-8 pb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#ebd9c8]">
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Order History</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Review past transactions and order details</p>
            </div>

            <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                <!-- Search Bar -->
                <div class="relative w-full md:w-64">
                    <input type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search orders..." 
                        class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>
        </header>

        <!-- Order History Table Content -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-white/30">
            @if(session()->has('message'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-xs flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden min-w-[800px] md:min-w-0 flex flex-col h-full">
                <div class="flex-1 overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#fcf8f4] sticky top-0 z-10 border-b-2 border-[#ebd9c8]">
                            <tr class="text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">
                                <th class="px-6 py-5 w-24">Order ID</th>
                                <th class="px-6 py-5 w-1/3">Order Details</th>
                                <th class="px-6 py-5">Total Amount</th>
                                <th class="px-6 py-5">Payment & Status</th>
                                <th class="px-6 py-5 hidden xl:table-cell">Transaction Date</th>
                                <th class="px-6 py-5 text-center w-32">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f5ede4]">
                            @forelse($orders as $order)
                                <tr @class([
                                    'hover:bg-[#fcf8f4]/80 transition-all duration-200 group align-top',
                                    'opacity-50 grayscale-[0.5]' => $order->status === 'cancelled'
                                ]) wire:key="order-{{ $order->id }}">
                                    <td class="px-6 py-4">
                                        <div class="text-[0.6rem] font-black text-[#8c5319] uppercase tracking-widest mb-0.5">#{{ str_pad($order->order_number, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-sm font-bold text-[#2a241f]">Ref: {{ $order->id }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-1.5">
                                            @foreach($order->items as $item)
                                                <div class="flex justify-between items-center bg-[#fcf8f4]/40 px-2 py-1 rounded-lg border border-[#ebd9c8]/30">
                                                    <span class="text-[0.7rem] font-black text-[#2a241f]"><span class="text-[#8c5319]">{{ $item->quantity }}x</span> {{ $item->product_name }}</span>
                                                    <span class="text-[0.65rem] font-bold text-[#8a7663]">₱{{ number_format($item->total, 2) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-[#2a241f]">₱{{ number_format($order->total, 2) }}</span>
                                            @if($order->discount_amount > 0)
                                                <span class="inline-flex items-center gap-1 text-[0.6rem] text-green-600 font-black uppercase tracking-tighter mt-0.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-2.5 h-2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    Disc: -₱{{ number_format($order->discount_amount, 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1">
                                            <span class="inline-flex items-center w-fit px-2 py-0.5 rounded-md text-[0.6rem] font-black bg-[#ebd9c8]/40 text-[#8c5319] border border-[#ebd9c8]/60 uppercase tracking-tighter">
                                                {{ $order->payment_method }}
                                            </span>
                                            @if($order->status === 'cancelled')
                                                <span class="inline-flex items-center w-fit px-2 py-0.5 rounded-md text-[0.6rem] font-black bg-red-50 text-red-600 border border-red-100 uppercase tracking-tighter">
                                                    Voided / Cancelled
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 hidden xl:table-cell">
                                        <div class="text-[0.7rem] font-bold text-[#5c4a3b]">{{ $order->created_at->format('M d, Y') }}</div>
                                        <div class="text-[0.6rem] text-[#a08f80] italic">{{ $order->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($order->status !== 'cancelled')
                                            <button 
                                                wire:click="cancelOrder({{ $order->id }})"
                                                wire:confirm="Void this order and return ingredients to stock?"
                                                class="inline-flex items-center justify-center p-2 bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-200 border border-red-100 hover:border-red-500 shadow-sm group/void"
                                                title="Void Order"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        @else
                                            <div class="flex items-center justify-center">
                                                <div class="w-8 h-8 rounded-full bg-[#f5ede4] flex items-center justify-center text-[#a08f80]/50" title="Voided Transaction">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center max-w-xs mx-auto">
                                            <div class="w-16 h-16 bg-[#fcf8f4] rounded-full flex items-center justify-center mb-4 border border-[#ebd9c8]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#dcc5ae]">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-sm font-bold text-[#2a241f] mb-1">No orders found</h3>
                                            <p class="text-xs text-[#a08f80]">We couldn't find any orders matching your search criteria.</p>
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
                        Showing <span class="text-[#8c5319]">{{ $orders->firstItem() ?? 0 }}</span> to <span class="text-[#8c5319]">{{ $orders->lastItem() ?? 0 }}</span> of <span class="text-[#8c5319]">{{ $orders->total() }}</span> entries
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($orders->onFirstPage())
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
                                {{ $orders->currentPage() }}
                            </span>
                            <span class="text-[0.7rem] font-bold text-[#8a7663]">of {{ $orders->lastPage() }}</span>
                        </div>

                        @if ($orders->hasMorePages())
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
</div>
