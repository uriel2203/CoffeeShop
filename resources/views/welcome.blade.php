<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Title -->
    <title>Caféra | Premium Iced Coffee & Cold Brew</title>

    <!-- Google Fonts: Inter (Sans-serif) and Playfair Display (Serif) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles for Scroll Animations -->
    <style>
        /* Base styles for elements before they scroll into view */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        
        /* Styles applied when elements scroll into view */
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger delays for multiple items appearing at once */
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }
        .delay-500 { transition-delay: 500ms; }

        /* Typography utility classes */
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#ebd9c8] text-[#2c221a] font-sans antialiased overflow-x-hidden selection:bg-[#9f6a27] selection:text-white">

    <!-- Navbar -->
    <nav class="absolute top-0 w-full flex justify-between items-center px-8 py-6 z-50 text-white/90 bg-transparent border-b border-white/20">
        <div class="font-serif text-2xl font-bold tracking-widest text-[#e8c6a0]">
            CAFÉRA
        </div>
        <div class="hidden md:flex space-x-12 text-sm tracking-wide items-center">
            <a href="#" class="hover:text-white transition-colors">Home</a>
            <a href="#menu" class="hover:text-white transition-colors">Menu</a>
            <a href="#" class="hover:text-white transition-colors">About Us</a>
            <a href="#" class="hover:text-white transition-colors">Contact</a>
        </div>
        <div class="flex items-center space-x-6">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-white transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block border border-white/20 hover:border-white/60 hover:bg-white/10 text-white text-sm font-semibold px-6 py-2 rounded-full transition-all duration-300">
                        Log in
                    </a>
                @endauth
            @else
                <a href="/login" class="inline-block border border-white/20 hover:border-white/60 hover:bg-white/10 text-white text-sm font-semibold px-6 py-2 rounded-full transition-all duration-300">
                    Log in
                </a>
            @endif
        </div>
    </nav>

    <!-- 1. Hero Section -->
    <header class="relative min-h-screen pt-32 pb-20 px-8 lg:px-24 flex items-center bg-[#291b11] overflow-hidden">
        <!-- Slight gradient overlay for depth -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent pointer-events-none"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Hero Content -->
            <div class="w-full lg:w-1/2 space-y-8 reveal">
                <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl font-bold leading-tight text-white mb-6">
                    Chill With<br>
                    Perfectly Brewed<br>
                    Iced Coffee
                </h1>
                <p class="text-[0.95rem] text-white/70 max-w-lg leading-relaxed mb-10">
                    Refresh your day with our expertly crafted iced coffee — smooth, bold, and perfectly chilled for every moment.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#menu" class="inline-block bg-[#8c5319] hover:bg-[#a66a2a] text-white text-sm font-semibold px-8 py-3.5 rounded transition-all duration-300">
                        Order Iced Coffee
                    </a>
                    <a href="#menu" class="inline-block border border-white/30 hover:border-white/60 text-white text-sm font-semibold px-8 py-3.5 rounded transition-all duration-300">
                        Explore Menu
                    </a>
                </div>

                <!-- Stats -->
                <div class="pt-12 flex items-center gap-12 text-white reveal delay-100">
                    <div>
                        <div class="font-serif text-3xl font-bold mb-1">30+</div>
                        <div class="text-xs text-white/50 tracking-wider uppercase">Iced Coffee Variants</div>
                    </div>
                    <div>
                        <div class="font-serif text-3xl font-bold mb-1">5k+</div>
                        <div class="text-xs text-white/50 tracking-wider uppercase">Happy Customers</div>
                    </div>
                    <div>
                        <div class="font-serif text-3xl font-bold mb-1">100%</div>
                        <div class="text-xs text-white/50 tracking-wider uppercase">Premium Arabica Beans</div>
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="w-full lg:w-1/2 flex justify-end reveal delay-200 relative">
                <!-- Decorative background elements -->
                <div class="absolute inset-0 bg-amber-900/10 rounded-full blur-3xl transform translate-x-1/4 -translate-y-1/4" style="width: 500px; height: 500px;"></div>
                
                <img src="https://loremflickr.com/800/1000/icedcoffee,glass/all" class="w-full max-w-lg drop-shadow-[0_25px_25px_rgba(0,0,0,0.5)] z-10 rounded-xl object-cover mix-blend-lighten" alt="Iced Coffee Drink on Wood">
                
                <!-- If Unsplash is unreliable, using Picsum iced drink placeholder as fallback -->
                 <!-- <img src="https://picsum.photos/id/113/800/1000" class="w-full max-w-lg drop-shadow-[0_25px_25px_rgba(0,0,0,0.5)] z-10 rounded-xl object-cover mix-blend-lighten" alt="Iced Coffee Drink on Wood"> -->

            </div>
        </div>
    </header>

    <!-- 2. Features Section (Brewed to Refresh) -->
    <section class="py-24 px-8 lg:px-24 bg-[#ebd9c8]">
        <div class="max-w-7xl mx-auto flex flex-col items-center text-center">
            <h2 class="font-serif text-4xl mb-4 font-bold text-[#2a241f] reveal">Brewed to Refresh</h2>
            <p class="text-sm text-[#5c4a3b] mb-16 max-w-xl reveal delay-100">Cold-brewed for smooth flavor and a perfectly chilled finish.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 w-full border-t border-[#dcc5ae] pt-16">
                <!-- Feature 1 -->
                <div class="flex flex-col items-center reveal">
                    <div class="text-[#8c5319] mb-4">
                        <!-- Snowflake Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m-4.5-5.5L12 21l4.5-5.5M16.5 8.5L12 3 7.5 8.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75l16.5 10.5M5.25 18.25L21.75 7.75" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#2a241f] mb-3 text-[0.95rem]">18-Hour Cold Brew</h3>
                    <p class="text-xs text-[#5c4a3b] leading-relaxed max-w-[200px]">Slow-brewed to unlock deep flavor and smoothness.</p>
                </div>
                <!-- Feature 2 -->
                <div class="flex flex-col items-center reveal delay-100">
                    <div class="text-[#8c5319] mb-4">
                        <!-- Menu/Lines Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#2a241f] mb-3 text-[0.95rem]">Smooth, Bold & Refreshing</h3>
                    <p class="text-xs text-[#5c4a3b] leading-relaxed max-w-[200px]">Rich coffee taste with a clean, chilled finish.</p>
                </div>
                <!-- Feature 3 -->
                <div class="flex flex-col items-center reveal delay-200">
                    <div class="text-[#8c5319] mb-4">
                        <!-- Leaf Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#2a241f] mb-3 text-[0.95rem]">No Artificial Flavors</h3>
                    <p class="text-xs text-[#5c4a3b] leading-relaxed max-w-[200px]">Only real ingredients, nothing unnecessary.</p>
                </div>
                <!-- Feature 4 -->
                <div class="flex flex-col items-center reveal delay-300">
                    <div class="text-[#8c5319] mb-4">
                        <!-- Ice Cube icon approximated -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#2a241f] mb-3 text-[0.95rem]">Served Ice-Cold</h3>
                    <p class="text-xs text-[#5c4a3b] leading-relaxed max-w-[200px]">Perfectly chilled for instant refreshment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Cold Brew Collection Section -->
    <section id="menu" class="py-24 px-8 lg:px-24 bg-[#e3cdb9]">
        <div class="max-w-7xl mx-auto flex flex-col items-center">
            
            <h2 class="font-serif text-4xl mb-4 text-[#2a241f] font-bold text-center reveal">Our Cold Brew Collection</h2>
            <p class="text-sm text-[#5c4a3b] mb-16 max-w-xl text-center reveal delay-100">Smooth, bold, and perfectly chilled — crafted for true coffee lovers.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full mb-16">
                <!-- Product 1 -->
                <div class="bg-[#f0e4d7] rounded-xl p-6 shadow-sm reveal border border-[#d8beaa] hover:shadow-md transition-shadow">
                    <div class="bg-white rounded-lg aspect-[4/5] flex items-center justify-center mb-6 overflow-hidden p-8 relative">
                         <span class="absolute top-4 left-4 text-[0.65rem] border border-[#d8beaa] text-[#8c5319] px-2 py-1 rounded bg-[#f0e4d7]/50">Pure & Bold</span>
                        <img src="https://loremflickr.com/400/500/coldbrew,coffee/all" class="w-full h-full object-cover rounded mix-blend-multiply" alt="Classic Cold Brew">
                    </div>
                    <h3 class="font-serif font-bold text-lg text-[#2a241f] mb-1">Classic Cold Brew</h3>
                    <p class="text-xs text-[#5c4a3b] mb-6">Strong, smooth, no sugar</p>
                    <div class="flex justify-between items-end border-t border-[#d8beaa] pt-4">
                        <span class="font-bold text-[#2a241f]">$14.00</span>
                        <button class="text-xs font-semibold text-[#8c5319] hover:text-[#5c3710] flex items-center gap-1 group">
                            Add to Cart 
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </button>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-[#f0e4d7] rounded-xl p-6 shadow-sm reveal delay-100 border border-[#d8beaa] hover:shadow-md transition-shadow">
                    <div class="bg-white rounded-lg aspect-[4/5] flex items-center justify-center mb-6 overflow-hidden p-8 relative">
                        <span class="absolute top-4 left-4 text-[0.65rem] border border-[#d8beaa] text-[#8c5319] px-2 py-1 rounded bg-[#f0e4d7]/50">Customer Favorite</span>
                        <img src="https://loremflickr.com/400/500/icedcoffee,cream/all" class="w-full h-full object-cover rounded mix-blend-multiply" alt="Vanilla Cream Iced Coffee">
                    </div>
                    <h3 class="font-serif font-bold text-lg text-[#2a241f] mb-1">Vanilla Cream Iced Coffee</h3>
                    <p class="text-xs text-[#5c4a3b] mb-6">Creamy vanilla finish</p>
                    <div class="flex justify-between items-end border-t border-[#d8beaa] pt-4">
                        <span class="font-bold text-[#2a241f]">$16.00</span>
                        <button class="text-xs font-semibold text-[#8c5319] hover:text-[#5c3710] flex items-center gap-1 group">
                            Add to Cart 
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-[#f0e4d7] rounded-xl p-6 shadow-sm reveal delay-200 border border-[#d8beaa] hover:shadow-md transition-shadow">
                    <div class="bg-white rounded-lg aspect-[4/5] flex items-center justify-center mb-6 overflow-hidden p-8 relative">
                        <span class="absolute top-4 left-4 text-[0.65rem] border border-[#d8beaa] text-[#8c5319] px-2 py-1 rounded bg-[#f0e4d7]/50">New Arrivals</span>
                        <img src="https://loremflickr.com/400/500/mocha,iced/all" class="w-full h-full object-cover rounded mix-blend-multiply" alt="Mocha Chill Coffee">
                    </div>
                    <h3 class="font-serif font-bold text-lg text-[#2a241f] mb-1">Mocha Chill Coffee</h3>
                    <p class="text-xs text-[#5c4a3b] mb-6">Chocolate-infused cold brew</p>
                    <div class="flex justify-between items-end border-t border-[#d8beaa] pt-4">
                        <span class="font-bold text-[#2a241f]">$18.00</span>
                        <button class="text-xs font-semibold text-[#8c5319] hover:text-[#5c3710] flex items-center gap-1 group">
                            Add to Cart 
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <button class="border border-[#b79b83] text-[#5c4a3b] font-semibold text-sm px-8 py-3 rounded-md hover:bg-[#b79b83] hover:text-white transition-colors reveal delay-300">
                View Full Menu
            </button>
        </div>
    </section>

    <!-- 4. Split Process Section (Crafted the Right Way) -->
    <section class="py-24 px-8 lg:px-24 bg-[#ebd9c8]">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16">
            
            <!-- Left Image -->
            <div class="w-full lg:w-1/2 reveal">
                <img src="https://loremflickr.com/800/800/barista,pouring/all" class="w-full rounded-2xl shadow-xl aspect-square object-cover" alt="Lineup of iced coffees covered in caramel and cream">
            </div>

            <!-- Right Content -->
            <div class="w-full lg:w-1/2 space-y-12">
                <div class="reveal delay-100">
                    <h2 class="font-serif text-4xl mb-4 font-bold text-[#2a241f]">Crafted the Right Way</h2>
                    <p class="text-sm text-[#5c4a3b] max-w-md leading-relaxed">Quality you can taste in every sip — thoughtfully brewed with care, consistency, and a deep respect for real coffee craftsmanship.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-10">
                    <!-- Point 1 -->
                    <div class="reveal delay-200">
                        <div class="w-12 h-12 rounded-full border border-[#b79b83] flex items-center justify-center text-[#8c5319] mb-4">
                            <!-- Coffee Bean Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.974 0-5.699-.54-8.118-1.472" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#2a241f] text-sm mb-2">Premium Arabica Beans</h4>
                        <p class="text-xs text-[#5c4a3b] leading-relaxed">Carefully selected beans for rich flavor and smooth aroma.</p>
                    </div>
                    <!-- Point 2 -->
                    <div class="reveal delay-300">
                        <div class="w-12 h-12 rounded-full border border-[#b79b83] flex items-center justify-center text-[#8c5319] mb-4">
                            <!-- Beaker/Brew Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#2a241f] text-sm mb-2">Small Batch Brewing</h4>
                        <p class="text-xs text-[#5c4a3b] leading-relaxed">Brewed in small batches to maintain consistency and quality.</p>
                    </div>
                    <!-- Point 3 -->
                    <div class="reveal delay-400">
                        <div class="w-12 h-12 rounded-full border border-[#b79b83] flex items-center justify-center text-[#8c5319] mb-4">
                            <!-- Refresh Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#2a241f] text-sm mb-2">Freshly Brewed Daily</h4>
                        <p class="text-xs text-[#5c4a3b] leading-relaxed">Prepared fresh every day for peak taste and freshness.</p>
                    </div>
                    <!-- Point 4 -->
                    <div class="reveal delay-500">
                        <div class="w-12 h-12 rounded-full border border-[#b79b83] flex items-center justify-center text-[#8c5319] mb-4">
                            <!-- Hand / Ethic Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#2a241f] text-sm mb-2">Ethically Sourced</h4>
                        <p class="text-xs text-[#5c4a3b] leading-relaxed">Responsibly sourced to support farmers and sustainability.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Comparison Section (Why Cold Brew Is Better) -->
    <section class="py-24 px-8 lg:px-24 bg-[#e2cdb9]">
        <div class="max-w-4xl mx-auto flex flex-col items-center">
            <h2 class="font-serif text-4xl mb-4 text-[#2a241f] font-bold text-center reveal">Why Cold Brew Is Better</h2>
            <p class="text-sm text-[#5c4a3b] mb-16 text-center reveal delay-100">A smoother, gentler way to enjoy coffee.</p>

            <div class="w-full bg-[#eee0cf] rounded-xl border border-[#d8beaa] overflow-hidden reveal delay-200">
                <!-- Headers -->
                <div class="grid grid-cols-2 border-b border-[#d8beaa] bg-[#ead5c0]">
                    <div class="p-4 sm:p-6 text-center border-r border-[#d8beaa] flex items-center justify-center gap-2 font-bold text-[#2a241f] text-sm sm:text-base">
                        <span class="text-green-600">✓</span> Cold Brew
                    </div>
                    <div class="p-4 sm:p-6 text-center flex items-center justify-center gap-2 font-bold text-[#2a241f] text-sm sm:text-base">
                        <span class="text-red-500">✕</span> Regular Coffee
                    </div>
                </div>
                
                <!-- Rows -->
                <div class="grid grid-cols-2 border-b border-[#d8beaa]">
                    <div class="p-4 sm:p-6 border-r border-[#d8beaa] text-center">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-green-600">✓</span> Less Acidic</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">Gentle On The Stomach</div>
                    </div>
                    <div class="p-4 sm:p-6 text-center">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-red-500">✕</span> More Acidic</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">Can Feel Harsh Or Sharp</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 border-b border-[#d8beaa]">
                    <div class="p-4 sm:p-6 border-r border-[#d8beaa] text-center">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-green-600">✓</span> Smoother Taste</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">No Bitterness</div>
                    </div>
                    <div class="p-4 sm:p-6 text-center">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-red-500">✕</span> Bitter Taste</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">Strong Roast Bitterness</div>
                    </div>
                </div>

                <div class="grid grid-cols-2 border-b border-[#d8beaa]">
                    <div class="p-4 sm:p-6 border-r border-[#d8beaa] text-center">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-green-600">✓</span> Naturally Sweeter</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">Subtle Natural Notes</div>
                    </div>
                    <div class="p-4 sm:p-6 text-center">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-red-500">✕</span> Needs Added Sugar</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">Often Requires Sugar</div>
                    </div>
                </div>

                <div class="grid grid-cols-2">
                    <div class="p-4 sm:p-6 border-r border-[#d8beaa] text-center bg-[#f0e8de]">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-green-600">✓</span> Slow Brewed (18 Hours)</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">Time-Crafted Balance</div>
                    </div>
                    <div class="p-4 sm:p-6 text-center bg-[#f0e8de]">
                        <div class="font-semibold text-sm text-[#2a241f] flex items-center justify-center gap-2"><span class="text-red-500">✕</span> Quick Brewed</div>
                        <div class="text-[0.65rem] text-[#5c4a3b] mt-1">Less Flavor Depth</div>
                    </div>
                </div>
            </div>

            <!-- Call to action below chart -->
            <div class="mt-12 text-center reveal delay-300">
                <p class="font-semibold text-sm text-[#2a241f] mb-6">Ready for a smoother coffee experience?</p>
                <a href="#menu" class="inline-block bg-[#8c5319] hover:bg-[#a66a2a] text-white text-xs font-semibold px-8 py-3 rounded transition-all duration-300">
                    Order Cold Brew
                </a>
            </div>
        </div>
    </section>

    <!-- 6. Lifestyle Section (Perfect for Every Moment) -->
    <section class="py-24 px-8 lg:px-24 bg-[#ebd9c8]">
        <div class="max-w-7xl mx-auto flex flex-col items-center">
            <h2 class="font-serif text-4xl mb-4 text-[#2a241f] font-bold text-center reveal">Perfect for Every Moment</h2>
            <p class="text-sm text-[#5c4a3b] mb-16 text-center reveal delay-100">From your first sip in the morning to your last break of the day.</p>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 w-full mb-12">
                <!-- Moment 1 -->
                <div class="flex flex-col text-center reveal delay-100 group">
                    <div class="overflow-hidden rounded-xl aspect-[4/5] sm:aspect-square mb-4 bg-[#e3cdb9]">
                        <img src="https://loremflickr.com/400/500/morningcoffee,person/all" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Morning Boost">
                    </div>
                    <h4 class="font-bold text-sm text-[#2a241f] mb-2">Morning Boost</h4>
                    <p class="text-xs text-[#5c4a3b]">Start your day feeling fresh and energized.</p>
                </div>
                <!-- Moment 2 -->
                <div class="flex flex-col text-center reveal delay-200 group">
                    <div class="overflow-hidden rounded-xl aspect-[4/5] sm:aspect-square mb-4 bg-[#e3cdb9]">
                        <img src="https://loremflickr.com/400/500/coffeebreak,laptop/all" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Work Break">
                    </div>
                    <h4 class="font-bold text-sm text-[#2a241f] mb-2">Work Break</h4>
                    <p class="text-xs text-[#5c4a3b]">A smooth pause to reset your focus.</p>
                </div>
                <!-- Moment 3 -->
                <div class="flex flex-col text-center reveal delay-300 group">
                    <div class="overflow-hidden rounded-xl aspect-[4/5] sm:aspect-square mb-4 bg-[#e3cdb9]">
                        <img src="https://loremflickr.com/400/500/coffeemug,evening/all" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Evening Chill">
                    </div>
                    <h4 class="font-bold text-sm text-[#2a241f] mb-2">Evening Chill</h4>
                    <p class="text-xs text-[#5c4a3b]">Unwind with a calm, refreshing sip.</p>
                </div>
                <!-- Moment 4 -->
                <div class="flex flex-col text-center reveal delay-400 group">
                    <div class="overflow-hidden rounded-xl aspect-[4/5] sm:aspect-square mb-4 bg-[#e3cdb9]">
                        <img src="https://loremflickr.com/400/500/coffeetogo,walking/all" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="On-the-Go">
                    </div>
                    <h4 class="font-bold text-sm text-[#2a241f] mb-2">On-the-Go</h4>
                    <p class="text-xs text-[#5c4a3b]">Refreshment that moves with you.</p>
                </div>
            </div>

            <!-- View More Button -->
             <button class="border border-[#b79b83] text-[#5c4a3b] font-semibold text-xs px-8 py-2.5 rounded-md hover:bg-[#b79b83] hover:text-white transition-colors reveal delay-500">
                View More
            </button>
        </div>
    </section>

    <!-- 7. Testimonials Section -->
    <section class="py-24 px-8 lg:px-24 bg-[#e8d5c4]">
        <div class="max-w-7xl mx-auto flex flex-col items-center">
            <h2 class="font-serif text-4xl mb-4 text-[#2a241f] font-bold text-center reveal">Loved by Coffee Lovers</h2>
            <p class="text-sm text-[#5c4a3b] mb-20 text-center reveal delay-100">Crafted with care. Rated highly by real coffee drinkers.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 w-full mb-16">
                <!-- Review 1 -->
                <div class="bg-[#f0e4d7] p-8 pt-12 rounded-xl text-center relative shadow-sm reveal border border-[#d8beaa]">
                    <!-- Avatar overflow top -->
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 w-16 h-16 rounded-full border-4 border-[#e8d5c4] overflow-hidden bg-[#e3cdb9]">
                        <img src="https://loremflickr.com/200/200/woman,smiling,face/all?random=1" class="w-full h-full object-cover" alt="Sara">
                    </div>
                    <h4 class="font-bold text-sm text-[#2a241f] mb-4">Sara Jones</h4>
                    <p class="text-[#5c4a3b] text-sm italic mb-6">"The smoothest cold brew I've had — rich, bold flavor without any bitterness. Perfect for everyday sipping."</p>
                    <div class="flex justify-center text-[#d4af37] mb-2 text-lg">★★★★★</div>
                    <p class="text-[0.65rem] uppercase tracking-wider text-[#5c4a3b]">Verified Customer</p>
                </div>

                <!-- Review 2 -->
                <div class="bg-[#f0e4d7] p-8 pt-12 rounded-xl text-center relative shadow-sm reveal delay-100 border border-[#d8beaa]">
                    <!-- Avatar overflow top -->
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 w-16 h-16 rounded-full border-4 border-[#e8d5c4] overflow-hidden bg-[#e3cdb9]">
                        <img src="https://loremflickr.com/200/200/man,smiling,face/all?random=2" class="w-full h-full object-cover" alt="Michael">
                    </div>
                    <h4 class="font-bold text-sm text-[#2a241f] mb-4">Michael Lee</h4>
                    <p class="text-[#5c4a3b] text-sm italic mb-6">"Clean, refreshing, and incredibly balanced. You can really taste the quality of the beans in every sip."</p>
                    <div class="flex justify-center text-[#d4af37] mb-2 text-lg">★★★★★</div>
                    <p class="text-[0.65rem] uppercase tracking-wider text-[#5c4a3b]">Verified Customer</p>
                </div>

                <!-- Review 3 -->
                <div class="bg-[#f0e4d7] p-8 pt-12 rounded-xl text-center relative shadow-sm reveal delay-200 border border-[#d8beaa]">
                    <!-- Avatar overflow top -->
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 w-16 h-16 rounded-full border-4 border-[#e8d5c4] overflow-hidden bg-[#e3cdb9]">
                        <img src="https://loremflickr.com/200/200/woman,smiling,face/all?random=3" class="w-full h-full object-cover" alt="Emily">
                    </div>
                    <h4 class="font-bold text-sm text-[#2a241f] mb-4">Emily Carter</h4>
                    <p class="text-[#5c4a3b] text-sm italic mb-6">"Absolutely love it. Smooth, strong, and not acidic at all. This has become my go-to cold brew."</p>
                    <div class="flex justify-center text-[#d4af37] mb-2 text-lg">★★★★★</div>
                    <p class="text-[0.65rem] uppercase tracking-wider text-[#5c4a3b]">Verified Customer</p>
                </div>
            </div>

            <!-- Read More Reviews Button -->
            <button class="border border-[#b79b83] text-[#5c4a3b] font-semibold text-xs px-8 py-2.5 rounded-md hover:bg-[#b79b83] hover:text-white transition-colors reveal delay-300">
                Read More Reviews
            </button>
        </div>
    </section>

    <!-- 8. Newsletter & Features Banner -->
    <section class="py-24 px-8 lg:px-24 bg-[#ebd9c8]">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="font-serif text-4xl mb-4 text-[#2a241f] font-bold reveal">Subscribe & Chill</h2>
            <p class="text-sm text-[#5c4a3b] mb-8 reveal delay-100">Get closer to our brew — perks, flavors, and offers made just for you.</p>

            <form class="flex flex-col sm:flex-row justify-center max-w-lg mx-auto gap-4 mb-6 reveal delay-200">
                <input type="email" placeholder="Enter Your Email" class="flex-grow px-6 py-3 rounded-md border border-[#d8beaa] bg-transparent focus:outline-none focus:border-[#8c5319] text-sm text-[#2a241f] placeholder:text-[#8a7663]">
                <button type="button" class="bg-[#8c5319] hover:bg-[#a66a2a] text-white font-semibold text-sm px-8 py-3 rounded-md transition-all duration-300 whitespace-nowrap">
                    Join The Brew Club
                </button>
            </form>
            <p class="text-xs text-[#8a7663] mb-20 reveal delay-300">Already loved by <span class="font-bold text-[#2a241f]">5,000+</span> coffee lovers</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 border-t border-[#d8beaa] pt-16 reveal delay-400">
                <!-- Mini Perk 1 -->
                <div class="text-center">
                    <!-- Sparkle Icon -->
                    <div class="flex justify-center text-[#8c5319] mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09l2.846.813-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                        </svg>
                    </div>
                    <h5 class="text-xs font-bold text-[#2a241f] mb-2 uppercase">Exclusive Flavors</h5>
                    <p class="text-[0.65rem] text-[#5c4a3b]">Members-only cold brew drops you won't find anywhere else.</p>
                </div>
                <!-- Mini Perk 2 -->
                <div class="text-center">
                    <!-- Bolt Icon -->
                    <div class="flex justify-center text-[#8c5319] mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <h5 class="text-xs font-bold text-[#2a241f] mb-2 uppercase">Early Access</h5>
                    <p class="text-[0.65rem] text-[#5c4a3b]">Be first to try new blends before anyone else.</p>
                </div>
                <!-- Mini Perk 3 -->
                 <div class="text-center">
                    <!-- Tag Icon -->
                    <div class="flex justify-center text-[#8c5319] mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <h5 class="text-xs font-bold text-[#2a241f] mb-2 uppercase">Special Discounts</h5>
                    <p class="text-[0.65rem] text-[#5c4a3b]">Subscriber-only deals crafted to save you more.</p>
                </div>
                <!-- Mini Perk 4 -->
                <div class="text-center">
                    <!-- Gift Icon -->
                    <div class="flex justify-center text-[#8c5319] mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <h5 class="text-xs font-bold text-[#2a241f] mb-2 uppercase">Member Rewards</h5>
                    <p class="text-[0.65rem] text-[#5c4a3b]">Surprises, seasonal perks, and special treats just for our brew club.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. Minimal Footer -->
    <footer class="bg-[#37261a] text-white/70 py-12 px-8 lg:px-24">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            
            <!-- Links -->
            <div class="flex space-x-6 text-xs">
                <a href="#" class="hover:text-white transition-colors">Home</a>
                <a href="#menu" class="hover:text-white transition-colors">Menu</a>
                <a href="#" class="hover:text-white transition-colors">About Us</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
            </div>

            <!-- Logo -->
            <div class="font-serif text-2xl font-bold tracking-widest text-[#e8c6a0]">
                CAFÉRA
            </div>

            <!-- Socials (Placeholders) -->
            <div class="flex space-x-4">
                <a href="#" class="hover:text-white transition-colors">Fb</a>
                <a href="#" class="hover:text-white transition-colors">Ig</a>
                <a href="#" class="hover:text-white transition-colors">Tw</a>
            </div>
        </div>
        
        <div class="text-center text-[0.65rem] text-white/40 mt-12">
            © 2026 Caféra. All rights reserved.
        </div>
    </footer>

    <!-- Script for Scroll Animations (Intersection Observer) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Options for the observer
            const options = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 // Trigger when 15% visible
            };

            // Observer callback
            const callback = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add '.active' to trigger CSS transition
                        entry.target.classList.add('active');
                        // Unobserve after animating
                        observer.unobserve(entry.target);
                    }
                });
            };

            // Create and attach observer
            const observer = new IntersectionObserver(callback, options);
            const items = document.querySelectorAll('.reveal');
            items.forEach((item) => {
                observer.observe(item);
            });
        });
    </script>
</body>
</html>
