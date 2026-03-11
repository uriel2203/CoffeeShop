<div class="flex-1 flex overflow-hidden w-full">
    {{--
        Livewire ManageUsers Component
        Handles real-time searching, administration, and role assignment of system accounts.
    --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8] flex-shrink-0">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Manage Users</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Administer system accounts and roles</p>
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- Filter by Role -->
                    <div class="relative w-full md:w-auto">
                        <select 
                            wire:model.live="roleFilter"
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 pr-10 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] appearance-none cursor-pointer">
                            <option value="all">All Roles</option>
                            <option value="admin">Administrators</option>
                            <option value="employee">Employees</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-[#a08f80] pointer-events-none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <!-- Search Bar -->
                    <div class="relative w-full md:w-64">
                        <input type="text" 
                            wire:model.live="search"
                            placeholder="Search by name, username..." 
                            class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-4 md:mt-6">
                <div class="text-sm font-medium text-[#8a7663] flex gap-6">
                    <button 
                        wire:click="$set('statusFilter', 'all')"
                        class="transition-all pb-2 {{ $statusFilter === 'all' ? 'text-[#8c5319] border-[#8c5319] border-b-2' : 'text-[#a08f80] border-transparent border-b-2 hover:text-[#8c5319]' }}">
                        All Accounts
                    </button>
                    <button 
                        wire:click="$set('statusFilter', 'active')"
                        class="transition-all pb-2 {{ $statusFilter === 'active' ? 'text-[#8c5319] border-[#8c5319] border-b-2' : 'text-[#a08f80] border-transparent border-b-2 hover:text-[#8c5319]' }}">
                        Active Accounts
                    </button>
                    <button 
                        wire:click="$set('statusFilter', 'inactive')"
                        class="transition-all pb-2 {{ $statusFilter === 'inactive' ? 'text-[#8c5319] border-[#8c5319] border-b-2' : 'text-[#a08f80] border-transparent border-b-2 hover:text-[#8c5319]' }}">
                        Inactive Accounts
                    </button>
                </div>

                <button 
                    wire:click="createUser"
                    class="bg-[#a48466] hover:bg-[#8e6e52] text-white font-medium text-sm py-2 px-6 rounded-md shadow-sm transition-all whitespace-nowrap flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Add New User
                </button>
            </div>
        </header>

        <!-- Main Content (User Table) -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-white/30">
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 text-sm">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-[#dcc5ae] shadow-xs overflow-hidden min-w-[800px] md:min-w-0 flex flex-col h-full">
                <div class="flex-1 overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#fcf8f4] sticky top-0 z-10 border-b-2 border-[#ebd9c8]">
                            <tr class="text-[0.65rem] font-black text-[#5c4a3b] uppercase tracking-[0.1em]">
                                <th class="px-6 py-5 w-20">ID</th>
                                <th class="px-6 py-5">User Account</th>
                                <th class="px-6 py-5">Identification</th>
                                <th class="px-6 py-5">System Role</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5 text-right w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f5ede4]">
                            @forelse ($users as $user)
                                <tr class="hover:bg-[#fcf8f4]/80 transition-all duration-200 group align-top" wire:key="user-{{ $user->id }}">
                                    <td class="px-6 py-5 text-[0.7rem] font-bold text-[#8a7663]">#{{ $user->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-2xl bg-[#fcf8f4] border border-[#ebd9c8] text-[#8c5319] flex items-center justify-center font-black text-xs shadow-sm transform group-hover:rotate-3 transition-transform">
                                                {{ $user->initials() }}
                                            </div>
                                            <div>
                                                <div class="text-[0.75rem] font-black text-[#2a241f] leading-tight">{{ $user->name }}</div>
                                                <div class="text-[0.6rem] text-[#8c5319] font-bold uppercase tracking-tighter">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-[0.7rem] font-bold text-[#5c4a3b]">@ {{ $user->username }}</span>
                                            <span class="text-[0.55rem] text-[#a08f80] uppercase tracking-widest mt-0.5">Username</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span @class([
                                            'inline-flex items-center px-2.5 py-1 rounded-md text-[0.6rem] font-black uppercase tracking-widest',
                                            'bg-[#8c5319] text-white' => $user->role === 'admin',
                                            'bg-[#ebd9c8]/40 text-[#8c5319] border border-[#ebd9c8]/60' => $user->role !== 'admin'
                                        ])>
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button 
                                            wire:click.stop="toggleStatus({{ $user->id }})"
                                            wire:loading.attr="disabled"
                                            @class([
                                                'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.6rem] font-black uppercase tracking-widest transition-all border shadow-sm',
                                                'bg-green-50 text-green-600 border-green-200 hover:bg-green-100' => $user->status == 1,
                                                'bg-red-50 text-red-600 border-red-200 hover:bg-red-100' => $user->status != 1
                                            ])>
                                            <span @class([
                                                'w-1.5 h-1.5 rounded-full animate-pulse',
                                                'bg-green-500' => $user->status == 1,
                                                'bg-red-500' => $user->status != 1
                                            ])></span>
                                            {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button 
                                            wire:click="editUser({{ $user->id }})"
                                            class="p-2 text-[#a08f80] hover:text-[#8c5319] hover:bg-white rounded-xl transition-all border border-transparent hover:border-[#ebd9c8] shadow-sm hover:shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center text-[#a08f80]">
                                        <div class="flex flex-col items-center max-w-xs mx-auto">
                                            <div class="w-16 h-16 bg-[#fcf8f4] rounded-full flex items-center justify-center mb-4 border border-[#ebd9c8]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#dcc5ae]">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-sm font-bold text-[#2a241f] mb-1">No users found</h3>
                                            <p class="text-xs text-[#a08f80]">We couldn't find any accounts matching your search or filters.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Professional Pagination -->
                @if($users->hasPages())
                    <div class="px-6 py-4 bg-[#fcf8f4] border-t border-[#ebd9c8] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-[0.65rem] font-bold text-[#8a7663] uppercase tracking-wide bg-white px-3 py-1.5 rounded-full border border-[#dcc5ae]">
                            Showing <span class="text-[#8c5319]">{{ $users->firstItem() ?? 0 }}</span> to <span class="text-[#8c5319]">{{ $users->lastItem() ?? 0 }}</span> of <span class="text-[#8c5319]">{{ $users->total() }}</span> entries
                        </div>
                        
                        <div class="flex items-center gap-2">
                            @if ($users->onFirstPage())
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
                                    {{ $users->currentPage() }}
                                </span>
                                <span class="text-[0.7rem] font-bold text-[#8a7663]">of {{ $users->lastPage() }}</span>
                            </div>

                            @if ($users->hasMorePages())
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
                @endif
            </div>
        </div>
    </main>

    <!-- Modal: Add/Edit User -->
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
                            <h2 class="font-serif text-2xl font-bold text-[#2a241f]">{{ $userId ? 'Edit' : 'Create' }} Account</h2>
                            <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">{{ $userId ? 'Update account details' : 'Assign access for a new staff member' }}</p>
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
                        <!-- Name & Username -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Full Name</label>
                                <input type="text" wire:model="name" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                                @error('name') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Username</label>
                                <input type="text" wire:model="username" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                                @error('username') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Email Address</label>
                            <input type="email" wire:model="email" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                            @error('email') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Role & Status -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">System Role</label>
                                <select wire:model="role" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] appearance-none cursor-pointer">
                                    <option value="employee">Employee</option>
                                    <option value="admin">Administrator</option>
                                </select>
                                @error('role') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">Initial Status</label>
                                <select wire:model.live="status" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] appearance-none cursor-pointer">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-[#8a7663] uppercase tracking-wide">
                                {{ $userId ? 'New Password (Optional)' : 'Default Password' }}
                            </label>
                            <input type="password" wire:model="password" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                            <p class="text-[0.65rem] text-[#a08f80] italic">Min. 8 characters</p>
                            @error('password') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
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
                                {{ $userId ? 'Update Account' : 'Create Account' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
