<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BowlKuy</title>
    
    <!-- Fonts -->
    @if ($isOnlineMode)
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @else
        <link rel="stylesheet" href="{{ asset('assets/fonts/poppins.css') }}">
    @endif
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/tailwind/tailwind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-offline.css') }}">
    
    <style>
        body { 
            font-family: {{ $isOnlineMode ? "'Inter', sans-serif" : "'Poppins', sans-serif" }}; 
        }
        .sidebar-link:hover { 
            background-color: rgba(255, 190, 51, 0.1); 
        }
        .sidebar-link.active { 
            background-color: rgba(255, 190, 51, 0.15); 
            border-left: 3px solid #ffbe33; 
        }
        @media (max-width: 768px) {
            .sidebar { 
                transform: translateX(-100%); 
                transition: transform 0.3s; 
            }
            .sidebar.open { 
                transform: translateX(0); 
            }
        }
        
        @media (min-width: 769px) {
            .sidebar {
                transform: translateX(0);
            }
        }
        
        /* Ensure proper styling even if Tailwind doesn't load */
        .bg-\[#121212\] { background-color: #121212 !important; }
        .bg-\[#1e1e1e\] { background-color: #1e1e1e !important; }
        .text-gray-300 { color: #d1d5db !important; }
        .border-gray-800 { border-color: #1f2937 !important; }
        .text-white { color: #ffffff !important; }
        .text-yellow-400 { color: #facc15 !important; }
        .text-gray-400 { color: #9ca3af !important; }
        .text-gray-500 { color: #6b7280 !important; }
        
        /* Layout fallbacks */
        .fixed { position: fixed !important; }
        .left-0 { left: 0 !important; }
        .top-0 { top: 0 !important; }
        .h-screen { height: 100vh !important; }
        .w-64 { width: 16rem !important; }
        .z-40 { z-index: 40 !important; }
        .overflow-y-auto { overflow-y: auto !important; }
        .min-h-screen { min-height: 100vh !important; }
        
        /* Responsive layout */
        @media (min-width: 768px) {
            .md\:ml-64 { margin-left: 16rem !important; }
            .md\:block { display: block !important; }
        }
        
        /* Additional fallbacks for grid and spacing */
        .space-y-6 > * + * { margin-top: 1.5rem !important; }
        .gap-6 { gap: 1.5rem !important; }
        .grid { display: grid !important; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)) !important; }
        .p-6 { padding: 1.5rem !important; }
        .rounded-2xl { border-radius: 1rem !important; }
        .text-3xl { font-size: 1.875rem !important; line-height: 2.25rem !important; }
        .font-black { font-weight: 900 !important; }
        
        @media (min-width: 768px) {
            .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
        }
        
        @media (min-width: 1024px) {
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        }
    </style>
</head>
<body class="bg-[#121212] text-gray-300">
    
    <!-- Mobile Menu Button -->
    <div class="md:hidden fixed top-4 left-4 z-50">
        <button id="mobile-menu-btn" class="bg-[#1e1e1e] p-3 rounded-lg border border-gray-800 text-yellow-400">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 h-screen w-64 bg-[#1e1e1e] border-r border-gray-800 z-40 overflow-y-auto md:block sidebar">
        <div class="p-6 border-b border-gray-800">
            <h1 class="text-2xl font-black text-white">Bowl<span class="text-yellow-400">Kuy</span></h1>
            <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Admin Panel</p>
            
            <!-- Connection Status Indicator -->
            <div class="mt-3 flex items-center gap-2" data-connection-status>
                @if ($isOnlineMode)
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse status-dot"></div>
                    <span class="text-green-400 text-xs status-text">Online Mode</span>
                @else
                    <div class="w-2 h-2 bg-yellow-400 rounded-full status-dot"></div>
                    <span class="text-yellow-400 text-xs status-text">Offline Mode</span>
                @endif
            </div>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'active text-yellow-400' : 'text-gray-400' }}">
                <i class="fas fa-chart-line w-5"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.orders') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('admin.orders') ? 'active text-yellow-400' : 'text-gray-400' }}">
                <i class="fas fa-shopping-bag w-5"></i>
                <span>Orders</span>
            </a>

            <a href="{{ route('admin.customers') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('admin.customers') ? 'active text-yellow-400' : 'text-gray-400' }}">
                <i class="fas fa-users w-5"></i>
                <span>Customers</span>
            </a>

            <a href="{{ route('admin.menus.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold {{ request()->routeIs('admin.menus.*') ? 'active text-yellow-400' : 'text-gray-400' }}">
                <i class="fas fa-utensils w-5"></i>
                <span>Manage Menu</span>
            </a>

            <div class="border-t border-gray-800 my-4"></div>

            <a href="{{ route('home') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-gray-400">
                <i class="fas fa-home w-5"></i>
                <span>Back to Home</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-red-400 hover:bg-red-500/10">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 min-h-screen">
        <!-- Top Bar -->
        <div class="bg-[#1e1e1e] border-b border-gray-800 px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white">{{ $title ?? 'Dashboard' }}</h2>
                <p class="text-xs text-gray-500 mt-1">{{ $subtitle ?? 'Welcome back, Admin!' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-yellow-400/10 border border-yellow-400/20 px-4 py-2 rounded-full">
                    <span class="text-yellow-400 text-xs font-bold uppercase">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-6">
            @if (session('success'))
                <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"></div>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
        });
    </script>
    
    <!-- Connection Monitor -->
    <script src="{{ asset('assets/js/connection-monitor.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="{{ asset('assets/vendor/chartjs/chart.min.js') }}"></script>
</body>
</html>
