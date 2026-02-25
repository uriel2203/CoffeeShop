<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caféra Dashboard | Order Menu</title>

    <!-- Google Fonts: Inter (Sans-serif) and Playfair Display (Serif) to match landing page -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font utility classes mapping -->
    <style>
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
        
        /* Custom Scrollbar for sleek UI */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #d8beaa;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #b79b83;
        }
    </style>
</head>
<!-- Main Application Container -->
<body class="bg-[#ebd9c8] text-[#2c221a] font-sans antialiased h-screen overflow-hidden flex selection:bg-[#9f6a27] selection:text-white">

    <!-- ========================================== -->
    <!-- SIDEBAR (LEFT)                             -->
    <!-- ========================================== -->
    <aside class="w-16 md:w-56 bg-white/60 h-full flex flex-col justify-between border-r border-[#dcc5ae] flex-shrink-0 transition-all duration-300">
        
        <!-- Logo Area -->
        <div class="p-6 md:p-8 flex items-center justify-center md:justify-start">
            <!-- Brand Mark / Name -->
            <div class="font-serif text-xl md:text-2xl font-bold tracking-widest text-[#8c5319]">
                <span class="md:hidden">C</span>
                <span class="hidden md:inline">CAFÉRA</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-1">
            
<!-- Dashboard -->
<a href="#" class="flex items-center gap-3 px-3 py-2 bg-[#ebd9c8]/50 text-[#8c5319] text-sm rounded-xl font-medium border-r-4 border-[#8c5319]">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
  </svg>
  <span class="hidden md:block">Dashboard</span>
</a>

<!-- Menu (fork & knife = POS / food menu) -->
<a href="#" class="flex items-center gap-3 px-3 py-2 text-[#5c4a3b] text-sm hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] rounded-xl font-medium transition-colors">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
  </svg>
  <span class="hidden md:block">Menu</span>
</a>

<!-- Products (tag / box = items for sale) -->
<a href="#" class="flex items-center gap-3 px-3 py-2 text-[#5c4a3b] text-sm hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] rounded-xl font-medium transition-colors">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
  </svg>
  <span class="hidden md:block">Product</span>
</a>

<!-- Ingredients (beaker / flask = raw materials) -->
<a href="#" class="flex items-center gap-3 px-3 py-2 text-[#5c4a3b] text-sm hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] rounded-xl font-medium transition-colors">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15m-6.75-12c.251.023.501.05.75.082M19.8 15a2.25 2.25 0 01.45 1.318c0 1.467-.757 2.747-1.887 3.457L6 21.75a3.375 3.375 0 01-3.75-5.59L5 14.5m14.8.5L19.8 15M5 14.5l-.75.75" />
  </svg>
  <span class="hidden md:block">Ingredients</span>
</a>

<!-- Orders (shopping bag = customer orders) -->
<a href="#" class="flex items-center gap-3 px-3 py-2 text-[#5c4a3b] text-sm hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] rounded-xl font-medium transition-colors">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
  </svg>
  <span class="hidden md:block">Orders</span>
</a>

<!-- Inventory (archive / warehouse = stock storage) -->
<a href="#" class="flex items-center gap-3 px-3 py-2 text-[#5c4a3b] text-sm hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] rounded-xl font-medium transition-colors">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
  </svg>
  <span class="hidden md:block">Inventory</span>
</a>

<!-- Manage Users (group of people = user management) -->
<a href="#" class="flex items-center gap-3 px-3 py-2 text-[#5c4a3b] text-sm hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] rounded-xl font-medium transition-colors">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
  </svg>
  <span class="hidden md:block">Manage Users</span>
</a>

<!-- Reports (chart bar = analytics & reports) -->
<a href="#" class="flex items-center gap-3 px-3 py-2 text-[#5c4a3b] text-sm hover:bg-[#ebd9c8]/30 hover:text-[#8c5319] rounded-xl font-medium transition-colors">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
  </svg>
  <span class="hidden md:block">Reports</span>
</a>
            
            

        <!-- User Profile Area (Logout) -->
        <div class="p-4 md:p-6 border-t border-[#dcc5ae]">
             <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full hover:bg-[#ebd9c8]/30 p-2 rounded-xl transition-colors">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Demo User') }}&background=8c5319&color=fff" alt="User Avatar" class="w-8 h-8 rounded-full border border-[#dcc5ae]">
                    <div class="hidden md:block text-left truncate flex-1">
                        <p class="text-[0.7rem] font-bold text-[#2a241f] truncate">{{ Auth::user()->name ?? 'Demo User' }}</p>
                        <p class="text-[0.6rem] text-[#8c5319]">Logout</p>
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA (CENTER)                 -->
    <!-- ========================================== -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
        <!-- Header -->
        <header class="p-6 md:p-8 pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Welcome Message -->
            <div>
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Welcome, {{ Auth::user()->name ?? 'Demo User' }}</h1>
                <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Discover whatever you need easily</p>
            </div>
            
            <!-- Search Bar -->
            <div class="relative w-full md:w-64 lg:w-80">
                <input type="text" placeholder="Search Product....." class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-4 pr-10 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-[#a08f80] hover:text-[#8c5319]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </div>
        </header>

        <!-- Category Pills -->
        <div class="px-6 md:px-8 py-4 overflow-x-auto whitespace-nowrap hide-scrollbar flex gap-4">
            
            <!-- Active Category: All Menus -->
            <button class="flex flex-col items-center justify-center min-w-[5.5rem] p-3 rounded-2xl bg-white/80 border-2 border-[#8c5319] text-[#8c5319] shadow-sm transition-all">
                <div class="bg-[#ebd9c8] p-2 rounded-xl mb-2">
                    <!-- Menu Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <span class="text-[0.65rem] font-bold">All Menus</span>
            </button>
            
            <!-- Category: Cold Brew -->
            <button class="flex flex-col items-center justify-center min-w-[5.5rem] p-3 rounded-2xl bg-white/50 border border-[#dcc5ae] text-[#5c4a3b] hover:bg-white/80 hover:border-[#8c5319]/50 transition-all">
                <div class="bg-transparent p-2 rounded-xl mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <span class="text-[0.65rem] font-medium">Cold Brew</span>
            </button>

            <!-- Category: Iced Lattes -->
             <button class="flex flex-col items-center justify-center min-w-[5.5rem] p-3 rounded-2xl bg-white/50 border border-[#dcc5ae] text-[#5c4a3b] hover:bg-white/80 hover:border-[#8c5319]/50 transition-all">
                <div class="bg-transparent p-2 rounded-xl mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                    </svg>
                </div>
                <span class="text-[0.65rem] font-medium">Iced Lattes</span>
            </button>

            <!-- Category: Hot Coffee -->
            <button class="flex flex-col items-center justify-center min-w-[5.5rem] p-3 rounded-2xl bg-white/50 border border-[#dcc5ae] text-[#5c4a3b] hover:bg-white/80 hover:border-[#8c5319]/50 transition-all">
                <div class="bg-transparent p-2 rounded-xl mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                    </svg>
                </div>
                <span class="text-[0.65rem] font-medium">Hot Coffee</span>
            </button>

            <!-- Category: Pastries -->
            <button class="flex flex-col items-center justify-center min-w-[5.5rem] p-3 rounded-2xl bg-white/50 border border-[#dcc5ae] text-[#5c4a3b] hover:bg-white/80 hover:border-[#8c5319]/50 transition-all">
                <div class="bg-transparent p-2 rounded-xl mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                    </svg>
                </div>
                <span class="text-[0.65rem] font-medium">Pastries</span>
            </button>
        </div>

        <!-- Product Grid Area -->
        <div class="flex-1 overflow-y-auto px-6 md:px-8 pb-8 pt-2">
            
            <h2 class="font-serif font-bold text-lg text-[#2a241f] mb-4">15 Menus</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                
                <!-- Product Card 1 -->
                <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3">
                        <img src="https://loremflickr.com/400/300/icedcoffee,glass/all" alt="Signature Cold Brew" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <!-- Add Button floating over image -->
                        <button class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <h3 class="font-bold text-sm text-[#2a241f] mb-1">Signature Cold Brew</h3>
                    <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">Slow-steeped over 18 hours for maximum smoothness and bold flavor without acidity.</p>
                    <div class="flex justify-between items-center mt-auto">
                        <span class="font-bold text-[#8c5319] text-sm">$4.50</span>
                        <span class="text-[0.6rem] text-green-600 font-medium tracking-wide">(In Stock)</span>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3">
                        <img src="https://loremflickr.com/400/300/latte,iced/all" alt="Vanilla Iced Latte" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <button class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <h3 class="font-bold text-sm text-[#2a241f] mb-1">Vanilla Iced Latte</h3>
                    <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">Our classic espresso poured over ice and milk, sweetened with pure vanilla bean syrup.</p>
                    <div class="flex justify-between items-center mt-auto">
                        <span class="font-bold text-[#8c5319] text-sm">$5.50</span>
                        <span class="text-[0.6rem] text-green-600 font-medium tracking-wide">(In Stock)</span>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3">
                        <img src="https://loremflickr.com/400/300/mocha,iced/all" alt="Iced Caramel Macchiato" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <button class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <h3 class="font-bold text-sm text-[#2a241f] mb-1">Iced Caramel Macchiato</h3>
                    <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">Cold milk, vanilla syrup, and ice layered with espresso and topped with rich caramel drizzle.</p>
                    <div class="flex justify-between items-center mt-auto">
                        <span class="font-bold text-[#8c5319] text-sm">$5.75</span>
                        <span class="text-[0.6rem] text-green-600 font-medium tracking-wide">(In Stock)</span>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3">
                        <img src="https://loremflickr.com/400/300/coffee,milk/all" alt="Nitro Cold Brew" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <button class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <h3 class="font-bold text-sm text-[#2a241f] mb-1">Nitro Cold Brew</h3>
                    <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">Cold brew infused with nitrogen for a naturally sweet flavor and cascading, velvety crema.</p>
                    <div class="flex justify-between items-center mt-auto">
                        <span class="font-bold text-[#8c5319] text-sm">$5.00</span>
                        <span class="text-[0.6rem] text-red-500 font-medium tracking-wide">(Out of Stock)</span>
                    </div>
                </div>

                 <!-- Product Card 5 -->
                 <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3">
                        <img src="https://loremflickr.com/400/300/matcha,iced/all" alt="Iced Matcha Latte" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <button class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <h3 class="font-bold text-sm text-[#2a241f] mb-1">Iced Matcha Latte</h3>
                    <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">Premium green tea matcha lightly sweetened and served with milk over ice.</p>
                    <div class="flex justify-between items-center mt-auto">
                        <span class="font-bold text-[#8c5319] text-sm">$5.25</span>
                        <span class="text-[0.6rem] text-green-600 font-medium tracking-wide">(In Stock)</span>
                    </div>
                </div>

                <!-- Product Card 6 -->
                <div class="bg-white/70 rounded-2xl p-4 border border-[#dcc5ae] shadow-xs flex flex-col group hover:shadow-md transition-shadow">
                    <div class="relative w-full aspect-video rounded-xl overflow-hidden mb-3">
                        <img src="https://loremflickr.com/400/300/croissant,pastry/all" alt="Butter Croissant" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <button class="absolute bottom-2 right-2 bg-white/90 rounded-lg p-1.5 shadow-sm text-[#8c5319] hover:bg-[#8c5319] hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <h3 class="font-bold text-sm text-[#2a241f] mb-1">Butter Croissant</h3>
                    <p class="text-[0.65rem] text-[#8a7663] leading-relaxed mb-3 flex-1 line-clamp-2">A perfectly flaky, all-butter croissant baked fresh daily. The perfect pairing.</p>
                    <div class="flex justify-between items-center mt-auto">
                        <span class="font-bold text-[#8c5319] text-sm">$3.50</span>
                        <span class="text-[0.6rem] text-green-600 font-medium tracking-wide">(In Stock)</span>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- ========================================== -->
    <!-- CART / ORDER MENU SIDEBAR (RIGHT)          -->
    <!-- ========================================== -->
    <aside class="hidden lg:flex w-72 bg-[#fdfaf6] h-full flex-col shadow-[-10px_0_20px_-10px_rgba(0,0,0,0.05)] border-l border-[#dcc5ae] flex-shrink-0 z-10 transition-all duration-300">
        
        <!-- Header -->
        <header class="p-6 pb-4 flex justify-between items-center border-b border-[#ebd9c8]">
            <h2 class="font-serif font-bold text-lg text-[#2a241f]">Order Menu</h2>
            <button class="text-[#a08f80] hover:text-[#2a241f]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </header>

        <!-- Customer Name Input -->
        <div class="p-6 pb-2">
            <label class="block text-xs font-bold text-[#2a241f] mb-2">Customer Name</label>
            <input type="text" placeholder="Customer Name" class="w-full border border-[#dcc5ae] rounded-lg px-3 py-2.5 text-sm bg-white focus:outline-none focus:border-[#8c5319] placeholder:text-[#dcc5ae]">
        </div>

        <!-- Order Items List -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            
            <!-- Items Added to Cart (Example 1) -->
            <div class="flex items-center gap-3">
                <img src="https://loremflickr.com/100/100/icedcoffee,glass/all" alt="Signature Cold Brew" class="w-12 h-12 rounded-lg object-cover bg-gray-100">
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-xs text-[#2a241f] truncate">Signature Cold Brew</h4>
                    <p class="font-bold text-[#8c5319] text-xs mt-1">$4.50</p>
                </div>
                <!-- Quantity Adjust -->
                <div class="flex items-center bg-white border border-[#dcc5ae] rounded-full px-2 py-1">
                    <button class="text-[#8c5319] hover:text-black font-bold px-1.5 focus:outline-none">−</button>
                    <span class="text-xs font-bold w-4 text-center text-[#2a241f]">1</span>
                    <button class="text-[#8c5319] hover:text-black font-bold px-1.5 focus:outline-none">+</button>
                </div>
            </div>

             <!-- Items Added to Cart (Example 2) -->
             <div class="flex items-center gap-3">
                <img src="https://loremflickr.com/100/100/latte,iced/all" alt="Vanilla Iced Latte" class="w-12 h-12 rounded-lg object-cover bg-gray-100">
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-xs text-[#2a241f] truncate">Vanilla Iced Latte</h4>
                    <p class="font-bold text-[#8c5319] text-xs mt-1">$11.00</p>
                </div>
                <!-- Quantity Adjust -->
                <div class="flex items-center bg-white border border-[#dcc5ae] rounded-full px-2 py-1">
                    <button class="text-[#8c5319] hover:text-black font-bold px-1.5 focus:outline-none">−</button>
                    <span class="text-xs font-bold w-4 text-center text-[#2a241f]">2</span>
                    <button class="text-[#8c5319] hover:text-black font-bold px-1.5 focus:outline-none">+</button>
                </div>
            </div>

        </div>

        <!-- Order Summary & Payment -->
        <div class="p-6 bg-white/50 border-t border-[#ebd9c8]">
            
            <!-- Calculations -->
            <div class="bg-[#fcfaf8] border border-[#ebd9c8] border-dashed rounded-xl p-4 mb-4">
                <div class="flex justify-between text-xs mb-2">
                    <span class="text-[#8a7663]">Subtotal</span>
                    <span class="font-bold text-[#2a241f]">$15.50</span>
                </div>
                <div class="flex justify-between text-xs mb-3">
                    <span class="text-[#8a7663]">Tax 10%</span>
                    <span class="font-bold text-[#2a241f]">$1.55</span>
                </div>
                <div class="border-t border-dashed border-[#dcc5ae] pt-3 flex justify-between items-center">
                    <span class="text-xs font-bold text-[#8a7663]">Total</span>
                    <span class="font-serif font-bold text-lg text-[#8c5319]">$17.05</span>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="mb-4">
                <p class="text-xs font-bold text-[#2a241f] mb-2">Select Payment</p>
                <div class="grid grid-cols-3 gap-2">
                    <button class="flex flex-col items-center justify-center p-2 rounded-xl border border-[#8c5319] bg-white text-[#8c5319] transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mb-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75v-1.5m0 0V12m0 0V10.5m0 0V9m0 0V7.5M2.25 12h.75a.75.75 0 01.75.75v.75m0 0v-1.5A.75.75 0 014.5 12h-.75M2.25 9h.75A.75.75 0 013.75 9h-.75M6 15h12M6 12h12M6 9h12" />
                        </svg>
                        <span class="text-[0.6rem] font-bold">Cash</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-2 rounded-xl border border-[#dcc5ae] bg-white text-[#a08f80] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mb-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        <span class="text-[0.6rem] font-medium">Debit</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-2 rounded-xl border border-[#dcc5ae] bg-white text-[#a08f80] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mb-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                        </svg>
                        <span class="text-[0.6rem] font-medium">QRIS</span>
                    </button>
                </div>
            </div>

            <!-- Checkout Action -->
            <button class="w-full bg-[#8c5319] hover:bg-[#a66a2a] text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-[#8c5319]/20 transition-all">
                Process to Payment
            </button>
        </div>
    </aside>

</body>
</html>
