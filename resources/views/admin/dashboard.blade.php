@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Quick Actions Bar -->
    <div class="bg-[#1e1e1e] border border-gray-800 p-4 rounded-2xl">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-white">Quick Actions</h3>
                <div class="h-4 w-px bg-gray-700"></div>
                <span class="text-xs text-gray-500">Manage your restaurant efficiently</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.orders') }}" class="bg-yellow-400/10 hover:bg-yellow-400/20 border border-yellow-400/30 text-yellow-400 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-shopping-bag text-xs"></i>
                    <span>View Orders</span>
                </a>
                <a href="{{ route('admin.menus.index') }}" class="bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/30 text-blue-400 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-utensils text-xs"></i>
                    <span>Manage Menu</span>
                </a>
                <a href="{{ route('admin.customers') }}" class="bg-purple-500/10 hover:bg-purple-500/20 border border-purple-500/30 text-purple-400 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-users text-xs"></i>
                    <span>Customers</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Orders -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl hover:border-blue-500/30 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Total Orders</p>
                    <h3 class="text-2xl font-black text-white mt-2">{{ $totalOrders }}</h3>
                    <p class="text-xs text-gray-600 mt-1">All time</p>
                </div>
                <div class="bg-blue-500/10 p-3 rounded-lg">
                    <i class="fas fa-shopping-bag text-xl text-blue-400"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl hover:border-green-500/30 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Total Revenue</p>
                    <h3 class="text-2xl font-black text-white mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    <p class="text-xs text-gray-600 mt-1">Paid orders</p>
                </div>
                <div class="bg-green-500/10 p-3 rounded-lg">
                    <i class="fas fa-dollar-sign text-xl text-green-400"></i>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl hover:border-purple-500/30 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Total Customers</p>
                    <h3 class="text-2xl font-black text-white mt-2">{{ $totalCustomers }}</h3>
                    <p class="text-xs text-gray-600 mt-1">Registered users</p>
                </div>
                <div class="bg-purple-500/10 p-3 rounded-lg">
                    <i class="fas fa-users text-xl text-purple-400"></i>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl hover:border-yellow-500/30 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Pending Orders</p>
                    <h3 class="text-2xl font-black text-yellow-400 mt-2">{{ $pendingOrders }}</h3>
                    <p class="text-xs text-gray-600 mt-1">Need verification</p>
                </div>
                <div class="bg-yellow-500/10 p-3 rounded-lg">
                    <i class="fas fa-clock text-xl text-yellow-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Data Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Orders Chart - Smaller -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-white">Orders Trend</h3>
                <span class="text-xs text-gray-500 bg-gray-800/50 px-2 py-1 rounded">Last 30 Days</span>
            </div>
            <div style="height: 160px;">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        <!-- Revenue Chart - Smaller -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-white">Revenue Trend</h3>
                <span class="text-xs text-gray-500 bg-gray-800/50 px-2 py-1 rounded">Last 30 Days</span>
            </div>
            <div style="height: 160px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Top Selling Menus - Compact -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-white">Top Menus</h3>
                <a href="{{ route('admin.menus.index') }}" class="text-xs text-yellow-400 hover:text-yellow-300 font-semibold">View All</a>
            </div>
            <div class="space-y-3 max-h-40 overflow-y-auto">
                @forelse($topMenus->take(3) as $item)
                    <div class="flex items-center justify-between p-3 bg-[#252525] rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="bg-yellow-400/10 p-2 rounded-lg">
                                <i class="fas fa-utensils text-yellow-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">{{ Str::limit($item->menu->name, 15) }}</p>
                                <p class="text-gray-500 text-xs">{{ $item->total_sold }} sold</p>
                            </div>
                        </div>
                        <span class="text-yellow-400 font-bold text-xs">Rp {{ number_format($item->menu->price * $item->total_sold / 1000, 0) }}k</span>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm text-center py-4">No data available</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-white">Recent Orders</h3>
                <a href="{{ route('admin.orders') }}" class="text-xs text-yellow-400 hover:text-yellow-300 font-semibold">View All</a>
            </div>
            <div class="space-y-3 max-h-64 overflow-y-auto">
                @forelse($recentOrders->take(4) as $order)
                    <div class="flex items-center justify-between p-3 bg-[#252525] rounded-lg hover:bg-[#2a2a2a] transition-colors duration-200">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-yellow-400 to-yellow-600 flex items-center justify-center text-black font-black text-xs flex-shrink-0">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-white font-semibold text-sm truncate">{{ $order->user->name }}</p>
                                <p class="text-gray-500 text-xs truncate">{{ $order->menu->name }}</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-white font-bold text-sm">Rp {{ number_format($order->total_price / 1000, 0) }}k</p>
                            @php
                                $statusClasses = [
                                    'pending_check' => 'bg-yellow-400/10 text-yellow-500',
                                    'paid' => 'bg-green-500/10 text-green-400',
                                    'rejected' => 'bg-red-500/10 text-red-400',
                                ];
                                $currentClass = $statusClasses[$order->payment_status] ?? 'bg-gray-500/10 text-gray-400';
                            @endphp
                            <span class="text-[9px] px-2 py-1 rounded-full {{ $currentClass }} font-bold uppercase">
                                {{ str_replace('_', ' ', $order->payment_status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="h-16 w-16 bg-gray-800/50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-inbox text-2xl text-gray-600"></i>
                        </div>
                        <p class="text-gray-500 text-sm">No orders yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- System Status & Quick Stats -->
        <div class="bg-[#1e1e1e] border border-gray-800 p-5 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-white">System Overview</h3>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-xs text-green-400">System Online</span>
                </div>
            </div>
            <div class="space-y-4">
                <!-- Today's Stats -->
                <div class="bg-[#252525] p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-white mb-3">Today's Performance</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500">Orders Today</p>
                            <p class="text-lg font-bold text-yellow-400">{{ $ordersPerDay->first()->count ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Revenue Today</p>
                            <p class="text-lg font-bold text-green-400">Rp {{ number_format(($revenuePerDay->first()->total ?? 0) / 1000, 0) }}k</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-[#252525] p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-white mb-3">Quick Actions</h4>
                    <div class="space-y-2">
                        <button onclick="window.location.href='{{ route('admin.orders') }}'" class="w-full bg-yellow-400/10 hover:bg-yellow-400/20 border border-yellow-400/30 text-yellow-400 px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-eye text-xs"></i>
                            <span>Check Pending Orders</span>
                        </button>
                        <button onclick="window.location.href='{{ route('admin.menus.index') }}'" class="w-full bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/30 text-blue-400 px-3 py-2 rounded-lg text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-plus text-xs"></i>
                            <span>Add New Menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debug: Check if Chart.js is loaded
    console.log('Chart.js loaded:', typeof Chart !== 'undefined');
    console.log('Orders data:', {!! json_encode($ordersPerDay) !!});
    console.log('Revenue data:', {!! json_encode($revenuePerDay) !!});
    
    // Check if Chart.js is available
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded!');
        document.getElementById('ordersChart').parentElement.innerHTML = '<p style="color: #ef4444; text-align: center; padding: 20px;">Chart.js tidak berhasil dimuat</p>';
        document.getElementById('revenueChart').parentElement.innerHTML = '<p style="color: #ef4444; text-align: center; padding: 20px;">Chart.js tidak berhasil dimuat</p>';
    } else {
        // Orders Chart - Optimized for smaller size
        const ordersCtx = document.getElementById('ordersChart');
        if (ordersCtx) {
            const ordersData = {!! json_encode($ordersPerDay->pluck('count')) !!};
            const ordersLabels = {!! json_encode($ordersPerDay->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))) !!};
            
            if (ordersData.length === 0) {
                ordersCtx.parentElement.innerHTML = '<p style="color: #9ca3af; text-align: center; padding: 20px; font-size: 12px;">No data available</p>';
            } else {
                new Chart(ordersCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ordersLabels,
                        datasets: [{
                            label: 'Orders',
                            data: ordersData,
                            borderColor: '#ffbe33',
                            backgroundColor: 'rgba(255, 190, 51, 0.1)',
                            tension: 0.4,
                            fill: true,
                            borderWidth: 2,
                            pointRadius: 3,
                            pointHoverRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#1e1e1e',
                                titleColor: '#ffbe33',
                                bodyColor: '#fff',
                                borderColor: '#374151',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { 
                                    color: '#9ca3af',
                                    font: { size: 10 },
                                    maxTicksLimit: 5
                                },
                                grid: { 
                                    color: '#374151',
                                    drawBorder: false
                                }
                            },
                            x: {
                                ticks: { 
                                    color: '#9ca3af',
                                    font: { size: 10 },
                                    maxTicksLimit: 5
                                },
                                grid: { display: false }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            }
        }

        // Revenue Chart - Optimized for smaller size
        const revenueCtx = document.getElementById('revenueChart');
        if (revenueCtx) {
            const revenueData = {!! json_encode($revenuePerDay->pluck('total')) !!};
            const revenueLabels = {!! json_encode($revenuePerDay->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))) !!};
            
            if (revenueData.length === 0) {
                revenueCtx.parentElement.innerHTML = '<p style="color: #9ca3af; text-align: center; padding: 20px; font-size: 12px;">No data available</p>';
            } else {
                new Chart(revenueCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: revenueLabels,
                        datasets: [{
                            label: 'Revenue (Rp)',
                            data: revenueData,
                            backgroundColor: 'rgba(34, 197, 94, 0.6)',
                            borderColor: '#22c55e',
                            borderWidth: 1,
                            borderRadius: 4,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#1e1e1e',
                                titleColor: '#22c55e',
                                bodyColor: '#fff',
                                borderColor: '#374151',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return 'Rp ' + (context.parsed.y / 1000).toFixed(0) + 'k';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { 
                                    color: '#9ca3af',
                                    font: { size: 10 },
                                    maxTicksLimit: 5,
                                    callback: function(value) {
                                        return 'Rp ' + (value / 1000) + 'k';
                                    }
                                },
                                grid: { 
                                    color: '#374151',
                                    drawBorder: false
                                }
                            },
                            x: {
                                ticks: { 
                                    color: '#9ca3af',
                                    font: { size: 10 },
                                    maxTicksLimit: 5
                                },
                                grid: { display: false }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            }
        }

        // Add smooth animations
        Chart.defaults.animation.duration = 1000;
        Chart.defaults.animation.easing = 'easeInOutQuart';
    }
});
</script>
@endsection
