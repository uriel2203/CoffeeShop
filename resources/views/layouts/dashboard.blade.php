<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Caféra' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS & JS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Custom Font Utilities -->
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#ebd9c8] text-[#2c221a] font-sans antialiased h-screen overflow-hidden flex selection:bg-[#9f6a27] selection:text-white">

    <!-- ========================================== -->
    <!-- SIDEBAR (LEFT)                             -->
    <!-- ========================================== -->
    <aside class="w-16 md:w-56 bg-white/60 h-full flex flex-col justify-between border-r border-[#dcc5ae] flex-shrink-0 transition-all duration-300">
        
        <!-- Logo Area & Manage Account Link -->
        <div class="px-3 md:px-6 pt-6 md:pt-8 pb-4 flex flex-col items-center md:items-start border-b border-[#dcc5ae]/30 mb-2">
            <!-- Brand Mark / Name -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Dashboard Logo" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-full shadow-sm border border-[#dcc5ae] bg-white">
                <div class="font-serif text-xl md:text-2xl font-bold tracking-widest text-[#8c5319]">
                    <span class="hidden md:inline">CAFÉRA</span>
                </div>
            </div>
            
            <!-- Manage Account Link (Small & Subtile) -->
            <a href="{{ route('profile.edit') }}" class="group mt-3 flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-[#ebd9c8]/40 transition-all duration-200">
                <div class="p-1 rounded-md bg-[#ebd9c8]/20 group-hover:bg-[#8c5319]/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-[#8c5319]/70 group-hover:text-[#8c5319]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.114-.94h1.086c.554 0 1.024.398 1.114.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.122l.768.768a1.125 1.125 0 01.122 1.45l-.527.737c-.25.35-.272.807-.107 1.205.166.397.506.71.93.78l.894.15c.542.09.94.56.94 1.114v1.086c0 .554-.398 1.024-.94 1.114l-.894.149c-.424.07-.764.383-.93.78-.165.398-.143.854.107 1.205l.527.738a1.125 1.125 0 01-.122 1.45l-.768.768a1.125 1.125 0 01-1.45.122l-.737-.527c-.35-.25-.807-.272-1.205-.107-.397.165-.71.505-.78.93l-.15.894c-.09.542-.56.94-1.114.94h-1.086c-.554 0-1.024-.398-1.114-.94l-.149-.894c-.07-.424-.383-.764-.78-.93-.398-.164-.854-.142-1.205.108l-.738.527a1.125 1.125 0 01-1.45-.122l-.768-.768a1.125 1.125 0 01-.122-1.45l.527-.737c.25-.35.272-.807.108-1.205-.165-.397-.505-.71-.93-.78l-.894-.15a1.125 1.125 0 01-.94-1.114v-1.086c0-.554.398-1.024.94-1.114l.894-.149c.424-.07.764-.383.93-.78.165-.398.143-.854-.108-1.205l-.527-.738a1.125 1.125 0 01.122-1.45l.768-.768a1.125 1.125 0 011.45-.122l.737.527c.35.25.807.272 1.205.107.397-.165.71-.505.78-.93l.15-.894z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="hidden md:block text-[0.65rem] font-bold text-[#8a7663] group-hover:text-[#8c5319] transition-colors uppercase tracking-tight">Manage Account</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-1">
            
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
              </svg>
              <span class="hidden md:block">Dashboard</span>
            </a>

            <!-- Menu (POS) -->
            <a href="{{ route('dashboard.menu') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard.menu') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
              </svg>
              <span class="hidden md:block">Menu</span>
            </a>

            <!-- Admin & Employee: Products Area -->
            @if(Auth::user()->isAdmin() || Auth::user()->isEmployee())
            <!-- Products -->
            <a href="{{ route('dashboard.products') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard.products') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
              </svg>
              <span class="hidden md:block">Product</span>
            </a>

            <!-- Ingredients -->
            <a href="{{ route('dashboard.ingredients') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard.ingredients') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15m-6.75-12c.251.023.501.05.75.082M19.8 15a2.25 2.25 0 01.45 1.318c0 1.467-.757 2.747-1.887 3.457L6 21.75a3.375 3.375 0 01-3.75-5.59L5 14.5m14.8.5L19.8 15M5 14.5l-.75.75" />
              </svg>
              <span class="hidden md:block">Ingredients</span>
            </a>
            @endif

          
            <!-- Orders -->
            <a href="{{ route('dashboard.orders') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard.orders') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
              </svg>
              <span class="hidden md:block">Orders</span>
            </a>

            <!-- Management & Reports -->
            @if(Auth::user()->isAdmin() || Auth::user()->isEmployee())
            <!-- Inventory -->
            <a href="{{ route('dashboard.inventory') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard.inventory') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
              </svg>
              <span class="hidden md:block">Inventory</span>
            </a>

            <!-- Manage Users (Admin Only) -->
            @if(Auth::user()->isAdmin())
            <a href="{{ route('dashboard.manage-users') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard.manage-users') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
              </svg>
              <span class="hidden md:block">Manage Users</span>
            </a>
            @endif

            <!-- Reports -->
            <a href="{{ route('dashboard.reports') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard.reports') ? 'bg-[#ebd9c8]/50 text-[#8c5319] border-r-4 border-[#8c5319]' : 'text-[#5c4a3b] hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] border-r-4 border-transparent' }}">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
              </svg>
              <span class="hidden md:block">Reports</span>
            </a>
            @endif
            
        </nav>

        <!-- User Profile Area (Logout) -->
        <div class="p-4 md:p-6 border-t border-[#dcc5ae]">
             <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full hover:bg-[#ebd9c8]/30 p-2 rounded-xl transition-colors">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="User Avatar" class="w-8 h-8 rounded-full border border-[#dcc5ae] object-cover">
                    <div class="hidden md:block text-left truncate flex-1">
                        <p class="text-[0.7rem] font-bold text-[#2a241f] truncate">{{ Auth::user()->name ?? 'Demo User' }}</p>
                        <p class="text-[0.6rem] text-[#8c5319]">Logout</p>
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT INJECTED HERE -->
    {{ $slot }}

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>

