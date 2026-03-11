<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Reports Component
        Handles real-time searching and dynamic report generation.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            @if (session()->has('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Sales Reports</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Review financial performance and generate printing records</p>
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- Date & Time Filter -->
                    <div class="relative w-full md:w-auto">
                        <input type="month" 
                            wire:model.live="dateFilter"
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] cursor-pointer" title="Filter report period">
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

                @if(auth()->user()->isAdmin())
                <button 
                    wire:click="generateReport"
                    wire:loading.attr="disabled"
                    class="bg-[#a48466] hover:bg-[#0092b3] text-white font-medium text-sm py-2 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <svg wire:loading xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 animate-spin">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span wire:loading.remove>Generate report</span>
                    <span wire:loading>Generating...</span>
                </button>
                @endif
            </div>
        </header>

        <!-- Transactions Table Content -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-white/30">
            <div class="bg-white rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden min-w-[800px] md:min-w-0 flex flex-col h-full">
                <div class="flex-1 overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#fcf8f4] sticky top-0 z-10 border-b-2 border-[#ebd9c8]">
                            <tr class="text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">
                                <th class="px-6 py-5 w-24">Order ID</th>
                                <th class="px-6 py-5">Order Items</th>
                                <th class="px-6 py-5 w-32">Grand Total</th>
                                <th class="px-6 py-5">Discount Status</th>
                                <th class="px-6 py-5">Payment & Type</th>
                                <th class="px-6 py-5">Transaction Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f5ede4]">
                            @forelse($orders as $order)
                                <tr class="hover:bg-[#fcf8f4]/80 transition-all duration-200 group align-top" wire:key="rep-{{ $order->id }}">
                                    <td class="px-6 py-4">
                                        <div class="text-[0.6rem] font-black text-[#8c5319] uppercase tracking-widest mb-0.5">#{{ str_pad($order->order_number, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-[0.65rem] font-bold text-[#a08f80]">ID: {{ $order->id }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-2">
                                            @foreach($order->items as $item)
                                                <div class="border-l-2 border-[#ebd9c8] pl-3 py-1">
                                                    <div class="flex justify-between max-w-[300px]">
                                                        <span class="text-[0.7rem] font-black text-[#2a241f] truncate">{{ $item->quantity }}x {{ $item->product_name }}</span>
                                                        <span class="text-[0.65rem] font-bold text-[#8a7663]">₱{{ number_format($item->price, 2) }}</span>
                                                    </div>
                                                    @if($item->product && $item->product->ingredients->count() > 0)
                                                        <p class="text-[0.6rem] text-[#8c5319]/70 italic mt-0.5 leading-relaxed">
                                                            <span class="font-black uppercase text-[0.55rem] not-italic mr-1">Recipe:</span>
                                                            @foreach($item->product->ingredients as $ing)
                                                                {{ $ing->name }} ({{ number_format($ing->pivot->amount * $item->quantity, 1) }}{{ $ing->unit }}){{ !$loop->last ? ' • ' : '' }}
                                                            @endforeach
                                                        </p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-black text-[#2a241f]">₱ {{ number_format($order->total, 2) }}</div>
                                        <div class="text-[0.6rem] text-[#a08f80] italic mt-0.5">Final Amount</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->discount_type && $order->discount_type !== 'none')
                                            <div class="flex flex-col gap-1">
                                                <span class="inline-flex items-center w-fit px-2 py-0.5 rounded-md text-[0.6rem] font-black bg-green-50 text-green-600 border border-green-100 uppercase tracking-tighter">
                                                    {{ ucwords($order->discount_type) }} Applied
                                                </span>
                                                <span class="text-[0.65rem] font-bold text-green-700/70">-₱ {{ number_format($order->discount_amount, 2) }}</span>
                                            </div>
                                        @else
                                            <span class="text-[0.65rem] font-bold text-[#a08f80] opacity-60 italic whitespace-nowrap">No discount applied</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1">
                                            <span @class([
                                                'inline-flex items-center w-fit px-2 py-0.5 rounded-md text-[0.6rem] font-black uppercase tracking-tighter',
                                                'bg-[#ebd9c8]/40 text-[#8c5319] border border-[#ebd9c8]/60' => $order->payment_method === 'cash',
                                                'bg-blue-50 text-blue-600 border border-blue-100' => $order->payment_method !== 'cash',
                                            ])>
                                                {{ $order->payment_method }}
                                            </span>
                                            @if($order->status === 'cancelled')
                                                <span class="text-[0.55rem] font-black text-red-500 uppercase">Void Transaction</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-[0.7rem] font-bold text-[#5c4a3b]">{{ $order->created_at->format('M d, Y') }}</div>
                                        <div class="text-[0.6rem] text-[#a08f80] italic">{{ $order->created_at->format('h:i A') }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center max-w-xs mx-auto">
                                            <div class="w-16 h-16 bg-[#fcf8f4] rounded-full flex items-center justify-center mb-4 border border-[#ebd9c8]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#dcc5ae]">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-sm font-bold text-[#2a241f] mb-1">No transactions found</h3>
                                            <p class="text-xs text-[#a08f80]">Try adjusting your search criteria or date filter.</p>
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
