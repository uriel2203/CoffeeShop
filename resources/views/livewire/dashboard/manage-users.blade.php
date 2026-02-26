<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire ManageUsers Component
        Handles real-time searching and administration of system accounts.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Manage Users</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Administer system accounts and roles</p>
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- Filter by Status -->
                    <div class="relative w-full md:w-auto">
                        <select 
                            wire:model.live="status"
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 pr-10 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] appearance-none cursor-pointer">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-[#a08f80] pointer-events-none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <input type="text" 
                            wire:model.live="search"
                            placeholder="Search users..." 
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-4 md:mt-6">
                <div class="text-sm font-medium text-[#8a7663] flex gap-6 border-b border-transparent">
                    <a href="#" class="text-[#8c5319] border-[#8c5319] border-b-2 pb-2">Users</a>
                </div>

                <button class="bg-[#a48466] hover:bg-[#8e6e52] text-white font-medium text-sm py-2 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Add User
                </button>
            </div>
        </header>

        <!-- User List Grid -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Admin User Card -->
                <div class="bg-white rounded-xl border border-[#dcc5ae] p-4 flex justify-between items-start shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-[#4a3b32] text-white flex items-center justify-center font-bold text-xl shrink-0">
                            U
                        </div>
                        <div>
                            <h3 class="font-medium text-[#2a241f] text-base">Uriel2203</h3>
                            <p class="text-xs text-[#a08f80] mb-1">uriel2203@example.com</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs font-semibold text-[#5c4a3b]">Admin</span>
                                <span class="bg-[#0052ff] text-white text-[0.65rem] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- User cards looped here --}}
            </div>
        </div>
    </main>
</div>
