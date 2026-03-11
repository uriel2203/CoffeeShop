<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire Dashboard Index Component
        Displays real-time summary, analytics, and stock status.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
        <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Dashboard</h1>
            <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Real-time summary, analytics, and stock status</p>
        </header>

        {{-- Main Dashboard Content --}}
        <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-white/30">
            {{-- Sales Summary: Key metrics displayed based on the selected time filter --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Sales -->
                <div class="bg-white rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-xs font-bold text-[#8a7663] uppercase tracking-wider mb-1">{{ $timeFilter }}'s Total Sales</p>
                        <h3 class="font-serif text-2xl font-bold text-[#8c5319]">₱{{ number_format($this->periodMetrics['totalSales'], 2) }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-[#ebd9c8] flex items-center justify-center text-[#8c5319]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Total Products Sold -->
                <div class="bg-white rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-xs font-bold text-[#8a7663] uppercase tracking-wider mb-1">Total Products Sold</p>
                        <h3 class="font-serif text-2xl font-bold text-[#8c5319]">{{ $this->periodMetrics['productsSold'] }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-[#ebd9c8] flex items-center justify-center text-[#8c5319]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                </div>

                <!-- Number of Orders -->
                <div class="bg-white rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex items-center justify-between hover:shadow-md transition-shadow">
                    <div>
                        <p class="text-xs font-bold text-[#8a7663] uppercase tracking-wider mb-1">Number of Orders</p>
                        <h3 class="font-serif text-2xl font-bold text-[#8c5319]">{{ $this->periodMetrics['orderCount'] }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-[#ebd9c8] flex items-center justify-center text-[#8c5319]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-8">
                {{-- Sales Analytics Chart --}}
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex flex-col">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h2 class="font-serif font-bold text-lg text-[#2a241f]">Sales Analytics</h2>
                        <!-- Filters -->
                        <div class="flex bg-white border border-[#dcc5ae] rounded-lg overflow-hidden text-xs font-medium">
                            @foreach(['Daily', 'Weekly', 'Monthly', 'Yearly', 'All'] as $filter)
                                <button 
                                    wire:click="$set('timeFilter', '{{ $filter }}')"
                                    @class([
                                        'px-3 py-1.5 transition-colors',
                                        'bg-[#8c5319] text-white' => $timeFilter === $filter,
                                        'text-[#8a7663] hover:bg-[#ebd9c8]/30' => $timeFilter !== $filter,
                                        'border-l border-[#dcc5ae]' => !$loop->first
                                    ])
                                >
                                    {{ $filter }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="flex-1 w-full relative min-h-[250px] flex items-end justify-between gap-1 px-2 mt-auto border-b border-[#ebd9c8] pb-1">
                        @foreach($this->analyticsData as $item)
                            <div 
                                style="height: {{ $item['height'] }}"
                                @class([
                                    'flex-1 min-w-[4px] rounded-t-sm transition-colors relative group',
                                    'bg-[#8c5319] hover:bg-[#a66a2a]' => $item['value'] > 0,
                                    'bg-[#ebd9c8]' => $item['value'] <= 0
                                ])
                                title="{{ $item['label'] }}: ₱{{ number_format($item['value'], 2) }}"
                            >
                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-[#2a241f] text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10 whitespace-nowrap pointer-events-none shadow-lg">
                                    {{ $item['label'] }}: ₱{{ number_format($item['value']) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between px-2 mt-2">
                        <span class="text-[10px] text-[#8a7663]">{{ $this->analyticsData[0]['label'] ?? '' }}</span>
                        <span class="text-[10px] text-[#8a7663]">{{ !empty($this->analyticsData) ? $this->analyticsData[count($this->analyticsData) - 1]['label'] : '' }}</span>
                    </div>
                </div>

                {{-- Stock Status Indicator --}}
                <div class="bg-white rounded-2xl p-6 border border-[#dcc5ae] shadow-xs flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-serif font-bold text-lg text-[#2a241f]">Stock Status</h2>
                        <div class="flex gap-2">
                             <div class="w-3 h-3 rounded-full bg-red-500" title="Critical"></div>
                             <div class="w-3 h-3 rounded-full bg-yellow-500" title="Low"></div>
                             <div class="w-3 h-3 rounded-full bg-blue-500" title="Sufficient"></div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="mb-4 space-y-1">
                        <div class="flex items-center gap-2 text-[10px] text-[#5c4a3b]">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span> <span>Red — Critical / Must Restock</span>
                        </div>
                        <div class="flex items-center gap-2 text-[10px] text-[#5c4a3b]">
                            <span class="w-2 h-2 rounded-full bg-yellow-500"></span> <span>Yellow — Low / Restock Soon</span>
                        </div>
                        <div class="flex items-center gap-2 text-[10px] text-[#5c4a3b]">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span> <span>Blue — Sufficient / Plenty of Stock</span>
                        </div>
                    </div>

                    <div class="space-y-4 flex-1 overflow-y-auto pr-2 max-h-[400px]">
                        @foreach($this->stockStatus as $item)
                            <div @class([
                                'flex items-center justify-between p-3 border rounded-xl hover:shadow-sm transition-shadow',
                                'border-red-200 bg-red-50' => $item['color'] === 'red',
                                'border-yellow-200 bg-yellow-50' => $item['color'] === 'yellow',
                                'border-blue-200 bg-blue-50' => $item['color'] === 'blue',
                            ])>
                                <div class="flex items-center gap-3">
                                    <div @class([
                                        'w-3 h-3 rounded-full',
                                        'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]' => $item['color'] === 'red',
                                        'bg-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.5)]' => $item['color'] === 'yellow',
                                        'bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]' => $item['color'] === 'blue',
                                    ])></div>
                                    <div>
                                        <p class="text-sm font-bold text-[#2a241f]">{{ $item['name'] }}</p>
                                        <p @class([
                                            'text-[0.65rem] font-medium tracking-wide',
                                            'text-red-600' => $item['color'] === 'red',
                                            'text-yellow-600' => $item['color'] === 'yellow',
                                            'text-blue-600' => $item['color'] === 'blue',
                                        ])>
                                            {{ $item['note'] }}
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-[#2a241f]">{{ $item['quantity'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
