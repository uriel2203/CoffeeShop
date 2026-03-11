<div class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
    <!-- Custom Browny Header -->
    <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8] flex-shrink-0 bg-white/10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">{{ $heading ?? 'Account Settings' }}</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">{{ $subheading ?? 'Manage your account preferences and security' }}</p>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden bg-white/30">
        <!-- Settings Sidebar -->
        <aside class="w-full md:w-64 border-r border-[#ebd9c8] bg-[#fcf8f4]/40 overflow-y-auto hidden md:block">
            <div class="p-6">
                <h3 class="text-[0.65rem] font-black text-[#a08f80] uppercase tracking-[0.2em] mb-4">Settings Menu</h3>
                <nav class="space-y-1">
                    <a href="{{ route('profile.edit') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('profile.edit') ? 'bg-[#8c5319] text-white shadow-md' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        Profile & Avatar
                    </a>
                    <a href="{{ route('user-password.edit') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('user-password.edit') ? 'bg-[#8c5319] text-white shadow-md' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        Security & Privacy
                    </a>
                    <a href="{{ route('appearance.edit') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('appearance.edit') ? 'bg-[#8c5319] text-white shadow-md' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122l9.37-9.37a2.828 2.828 0 114 4l-9.37 9.37a4.5 4.5 0 01-1.897 1.13L7 21l.379-3.379a4.5 4.5 0 011.13-1.897l1.021-1.022z" />
                        </svg>
                        Theme & Appearance
                    </a>
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <a href="{{ route('two-factor.show') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('two-factor.show') ? 'bg-[#8c5319] text-white shadow-md' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/50' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3 9-9" />
                            </svg>
                            Two-Factor Auth
                        </a>
                    @endif
                </nav>
            </div>
        </aside>

        <!-- Main Content area -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 custom-scrollbar">
            <div class="max-w-3xl mx-auto h-full">
                {{ $slot }}
            </div>
        </main>
    </div>
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
</div>
