<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caféra | Manage Users</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Utilities -->
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        .font-sans {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

@extends('dashboard.layout')

@section('content')
    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA (CENTER)                 -->
    <!-- ========================================== -->
    
    <!-- 7.6 Access Control Note -->
    <!-- HTML Comment: This view should technically be guarded by an Admin middleware. If a Cashier/Employee accesses this route, they should be redirected back to the dashboard with an unauthorized message. -->
    
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-transparent">
        
         <!-- Header -->
        <header class="p-6 md:p-8 pb-6 border-b border-[#ebd9c8]">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#2a241f]">Manage Users</h1>
                    <p class="text-xs md:text-sm text-[#5c4a3b] mt-1">Administer system accounts and roles</p>
                </div>
                
                <div class="flex flex-wrap md:flex-nowrap items-center gap-3 md:gap-4">
                    <!-- 7.5 Filter by Status -->
                    <div class="relative w-full md:w-auto">
                        <select class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 px-4 pr-10 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] text-[#5c4a3b] appearance-none cursor-pointer">
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
                        <input type="text" placeholder="Search users..." class="w-full bg-white/70 border border-[#dcc5ae] rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] placeholder:text-[#a08f80]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-[#a08f80]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- 7.2 Adding a New User Button -->
            <!-- Placed below the header text/search in its own right-aligned bar matching the mockup spacing -->
            <div class="flex justify-between items-center mt-4 md:mt-6">
                <!-- Tabs aligned left as secondary filter method per mockup styling conventions -->
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

        <!-- 7.1 User List Grid (based on provided image) -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Admin User Card (Current User) -->
                <div class="bg-white rounded-xl border border-[#dcc5ae] p-4 flex justify-between items-start shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <!-- Avatar -->
                        <div class="w-14 h-14 rounded-full bg-[#4a3b32] text-white flex items-center justify-center font-bold text-xl shrink-0">
                            U
                        </div>
                        
                        <!-- Details -->
                        <div>
                            <h3 class="font-medium text-[#2a241f] text-base">Uriel2203</h3>
                            <p class="text-xs text-[#a08f80] mb-1">uriel2203@example.com</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs font-semibold text-[#5c4a3b]">Admin</span>
                                <!-- 7.4 Active Badge (Blue/Green based on image, the image used blue, I will use a bright vivid blue to match the reference snippet) -->
                                <span class="bg-[#0052ff] text-white text-[0.65rem] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Active</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 7.3 Action Menu Dropdown Trigger -->
                    <button class="text-[#a08f80] hover:text-[#5c4a3b] p-1 rounded-full hover:bg-gray-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button>
                </div>

                <!-- Example Employee User Card (John Smith) -->
                <div class="bg-white rounded-xl border border-[#dcc5ae] p-4 flex justify-between items-start shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-[#4a3b32] text-white flex items-center justify-center font-bold text-xl shrink-0">
                            JS
                        </div>
                        <div>
                            <h3 class="font-medium text-[#2a241f] text-base">John Smith</h3>
                            <p class="text-xs text-[#a08f80] mb-1">john.smith@example.com</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs font-semibold text-[#5c4a3b]">Cashier</span>
                                <span class="bg-[#0052ff] text-white text-[0.65rem] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Active</span>
                            </div>
                        </div>
                    </div>
                    <button class="text-[#a08f80] hover:text-[#5c4a3b] p-1 rounded-full hover:bg-gray-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button>
                </div>

                <!-- Example Inactive User Card (Jane Doe) -->
                <div class="bg-gray-50 opacity-75 rounded-xl border border-[#dcc5ae] p-4 flex justify-between items-start shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold text-xl shrink-0">
                            JD
                        </div>
                        <div>
                            <h3 class="font-medium text-[#2a241f] text-base">Jane Doe</h3>
                            <p class="text-xs text-[#a08f80] mb-1">jane.doe@example.com</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs font-semibold text-[#5c4a3b]">Cashier</span>
                                <!-- 7.4 Inactive Badge (Red) -->
                                <span class="bg-red-500 text-white text-[0.65rem] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Inactive</span>
                            </div>
                        </div>
                    </div>
                    <button class="text-[#a08f80] hover:text-[#5c4a3b] p-1 rounded-full hover:bg-gray-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </main>

@endsection
</html>
