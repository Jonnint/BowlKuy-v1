@extends('layouts.admin')

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.customers') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-yellow-400 transition">
        <i class="fas fa-arrow-left"></i>
        <span class="text-sm font-semibold">Back to Customers</span>
    </a>
</div>

<!-- Customer Profile Card -->
<div class="bg-[#1e1e1e] border border-gray-800 rounded-2xl p-8 mb-6">
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-6">
            <!-- Avatar -->
            <div class="h-24 w-24 rounded-full bg-gradient-to-tr from-yellow-400 to-yellow-600 flex items-center justify-center text-black font-black text-4xl">
                {{ substr($customer->name, 0, 1) }}
            </div>
            
            <!-- Info -->
            <div>
                <h2 class="text-3xl font-black text-white mb-2">{{ $customer->name }}</h2>
                <p class="text-gray-400 mb-3">{{ $customer->email }}</p>
                
                <div class="flex items-center gap-3">
                    <!-- Tier Badge -->
                    @if($tier == 'VIP')
                        <span class="px-4 py-1.5 rounded-full bg-yellow-400/10 text-yellow-400 border border-yellow-400/20 text-xs font-black uppercase">
                            <i class="fas fa-crown mr-1"></i>{{ $tier }}
                        </span>
                    @elseif($tier == 'Active')
                        <span class="px-4 py-1.5 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 text-xs font-black uppercase">
                            <i class="fas fa-check-circle mr-1"></i>{{ $tier }}
                        </span>
                    @else
                        <span class="px-4 py-1.5 rounded-full bg-gray-500/10 text-gray-400 border border-gray-500/20 text-xs font-black uppercase">
                            {{ $tier }}
                        </span>
                    @endif

                    <!-- Google Badge -->
                    @if($customer->google_id)
                        <span class="px-4 py-1.5 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-black uppercase">
                            <i class="fab fa-google mr-1"></i>Google
                        </span>
                    @endif

                    <!-- Join Date -->
                    <span class="text-gray-500 text-xs">
                        <i class="fas fa-calendar mr-1"></i>Joined {{ $customer->created_at->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="flex gap-2">
            <a href="{{ route('admin.orders') }}?customer_id={{ $customer->id }}" 
                class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg text-xs font-bold border border-blue-500/20 hover:bg-blue-500/20 transition">
                <i class="fas fa-shopping-bag mr-2"></i>View Orders
            </a>
            <button onclick="alert('fiturnya belom bikin')" 
                class="px-4 py-2 bg-green-500/10 text-green-400 rounded-lg text-xs font-bold border border-green-500/20 hover:bg-green-500/20 transition">
                <i class="fas fa-envelope mr-2"></i>Send Email
            </button>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Orders -->
    <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Total Orders</p>
                <h3 class="text-3xl font-black text-white mt-2">{{ $totalOrders }}</h3>
            </div>
            <div class="bg-blue-500/10 p-4 rounded-xl">
                <i class="fas fa-shopping-bag text-2xl text-blue-400"></i>
            </div>
        </div>
    </div>

    <!-- Total Spent -->
    <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Total Spent</p>
                <h3 class="text-2xl font-black text-green-400 mt-2">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-green-500/10 p-4 rounded-xl">
                <i class="fas fa-dollar-sign text-2xl text-green-400"></i>
            </div>
        </div>
    </div>

    <!-- Avg Order Value -->
    <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Avg Order</p>
                <h3 class="text-2xl font-black text-yellow-400 mt-2">Rp {{ number_format($avgOrderValue, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-yellow-500/10 p-4 rounded-xl">
                <i class="fas fa-chart-line text-2xl text-yellow-400"></i>
            </div>
        </div>
    </div>

    <!-- Pending Orders -->
    <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Pending</p>
                <h3 class="text-3xl font-black text-orange-400 mt-2">{{ $pendingOrders }}</h3>
            </div>
            <div class="bg-orange-500/10 p-4 rounded-xl">
                <i class="fas fa-clock text-2xl text-orange-400"></i>
            </div>
        </div>
    </div>
</div>

<!-- Favorite Menu & Last Order -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Favorite Menu -->
    <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
        <h3 class="text-lg font-bold text-white mb-4">
            <i class="fas fa-heart text-red-400 mr-2"></i>Favorite Menu
        </h3>
        @if($favoriteMenu)
            <div class="flex items-center gap-4">
                <div class="bg-yellow-500/10 p-4 rounded-xl">
                    <i class="fas fa-utensils text-3xl text-yellow-400"></i>
                </div>
                <div>
                    <p class="text-white font-bold text-lg">{{ $favoriteMenu->menu->name }}</p>
                    <p class="text-gray-500 text-sm">Ordered {{ $favoriteMenu->total_qty }} times</p>
                    <p class="text-yellow-400 font-bold mt-1">Rp {{ number_format($favoriteMenu->menu->price, 0, ',', '.') }}</p>
                </div>
            </div>
        @else
            <p class="text-gray-500 text-sm">No orders yet</p>
        @endif
    </div>

    <!-- Last Order -->
    <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
        <h3 class="text-lg font-bold text-white mb-4">
            <i class="fas fa-clock text-blue-400 mr-2"></i>Last Order
        </h3>
        @if($lastOrder)
            <div class="flex items-center gap-4">
                <div class="bg-blue-500/10 p-4 rounded-xl">
                    <i class="fas fa-receipt text-3xl text-blue-400"></i>
                </div>
                <div>
                    <p class="text-white font-bold text-lg">{{ $lastOrder->menu->name }}</p>
                    <p class="text-gray-500 text-sm">{{ $lastOrder->created_at->diffForHumans() }}</p>
                    <p class="text-blue-400 font-bold mt-1">Rp {{ number_format($lastOrder->total_price, 0, ',', '.') }}</p>
                </div>
            </div>
        @else
            <p class="text-gray-500 text-sm">No orders yet</p>
        @endif
    </div>
</div>

<!-- Order History -->
<div class="bg-[#1e1e1e] border border-gray-800 rounded-2xl overflow-hidden">
    <div class="p-6 border-b border-gray-800">
        <h3 class="text-xl font-bold text-white">Order History</h3>
        <p class="text-sm text-gray-500 mt-1">All orders from this customer</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#252525] border-b border-gray-800 text-gray-400 text-[11px] uppercase tracking-[0.2em]">
                    <th class="p-6 font-semibold">Order ID</th>
                    <th class="p-6 font-semibold">Menu</th>
                    <th class="p-6 font-semibold text-center">Quantity</th>
                    <th class="p-6 font-semibold text-center">Total</th>
                    <th class="p-6 font-semibold text-center">Status</th>
                    <th class="p-6 font-semibold text-center">Date</th>
                </tr>
            </thead>
            <tbody class="text-gray-300 divide-y divide-gray-800/50">
                @forelse($orders as $order)
                    <tr class="hover:bg-yellow-400/[0.02] transition-all">
                        <td class="p-6">
                            <span class="text-yellow-400 font-bold">#{{ $order->id }}</span>
                        </td>
                        <td class="p-6">
                            <p class="font-medium text-white">{{ $order->menu->name }}</p>
                        </td>
                        <td class="p-6 text-center">
                            <span class="text-white font-bold">{{ $order->quantity }}</span>
                        </td>
                        <td class="p-6 text-center">
                            <span class="text-green-400 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td class="p-6 text-center">
                            @php
                                $statusClasses = [
                                    'unpaid' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                                    'pending_check' => 'bg-yellow-400/10 text-yellow-500 border-yellow-500/20',
                                    'paid' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                ];
                                $currentClass = $statusClasses[$order->payment_status] ?? 'bg-gray-500/10 text-gray-400 border-gray-500/20';
                            @endphp
                            <span class="px-3 py-1 rounded-full border text-[10px] font-black uppercase {{ $currentClass }}">
                                {{ str_replace('_', ' ', $order->payment_status) }}
                            </span>
                        </td>
                        <td class="p-6 text-center">
                            <p class="text-gray-400 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-600 text-xs">{{ $order->created_at->format('H:i') }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3 opacity-20"></i>
                            <p>No orders yet</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
