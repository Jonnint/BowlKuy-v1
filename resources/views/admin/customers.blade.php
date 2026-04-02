@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Filter Section -->
    <x-filter-section 
        title="Filter Customer"
        :action="route('admin.customers')"
        :categories="[]"
        :currentFilters="request()->all()"
        :showSearch="false"
        :showCategory="false"
        :showPriceRange="false"
        :showSort="false"
    >
        <!-- Custom filter fields for customers -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Search Customer -->
            <div class="space-y-2">
                <label class="text-gray-400 text-xs font-bold uppercase ml-1">Nama Customer</label>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari nama customer..." 
                       class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>

            <!-- Customer Type Filter -->
            <div class="space-y-2">
                <label class="text-gray-400 text-xs font-bold uppercase ml-1">Tipe Customer</label>
                <select name="customer_type" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
                    <option value="" class="bg-[#1e1e1e]">Semua Tipe</option>
                    <option value="vip" {{ request('customer_type') == 'vip' ? 'selected' : '' }} class="bg-[#1e1e1e]">VIP (>10 orders)</option>
                    <option value="active" {{ request('customer_type') == 'active' ? 'selected' : '' }} class="bg-[#1e1e1e]">Active (5-10 orders)</option>
                    <option value="new" {{ request('customer_type') == 'new' ? 'selected' : '' }} class="bg-[#1e1e1e]">New (<5 orders)</option>
                    <option value="google" {{ request('customer_type') == 'google' ? 'selected' : '' }} class="bg-[#1e1e1e]">Google Users</option>
                </select>
            </div>

            <!-- Sort Options -->
            <div class="space-y-2">
                <label class="text-gray-400 text-xs font-bold uppercase ml-1">Urutkan</label>
                <select name="sort" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
                    <option value="" class="bg-[#1e1e1e]">Default</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }} class="bg-[#1e1e1e]">Nama A-Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }} class="bg-[#1e1e1e]">Nama Z-A</option>
                    <option value="orders_desc" {{ request('sort') == 'orders_desc' ? 'selected' : '' }} class="bg-[#1e1e1e]">Paling Banyak Order</option>
                    <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }} class="bg-[#1e1e1e]">Terbaru Daftar</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-2 flex flex-col justify-end">
                <div class="flex gap-2">
                    <button type="submit"
                            class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-black text-sm hover:bg-yellow-500 transition shadow-lg shadow-yellow-400/10 flex-1">
                        FILTER
                    </button>
                    <a href="{{ route('admin.customers') }}"
                       class="bg-gray-700 text-white px-4 py-3 rounded-xl font-bold text-sm hover:bg-gray-600 transition flex items-center justify-center">
                        <i class="fas fa-redo text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-filter-section>

    <!-- Customer Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-yellow-500/10 p-3 rounded-xl">
                    <i class="fas fa-users text-yellow-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase">Total Customers</p>
                    <h4 class="text-2xl font-black text-white">{{ $customers->count() }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-purple-500/10 p-3 rounded-xl">
                    <i class="fas fa-crown text-purple-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase">VIP Customers</p>
                    <h4 class="text-2xl font-black text-white">{{ $customers->where('orders_count', '>', 10)->count() }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-green-500/10 p-3 rounded-xl">
                    <i class="fas fa-user-check text-green-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase">Active Customers</p>
                    <h4 class="text-2xl font-black text-white">{{ $customers->whereBetween('orders_count', [5, 10])->count() }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-[#1e1e1e] border border-gray-800 p-6 rounded-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-blue-500/10 p-3 rounded-xl">
                    <i class="fab fa-google text-blue-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase">Google Users</p>
                    <h4 class="text-2xl font-black text-white">{{ $customers->whereNotNull('google_id')->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="bg-[#1e1e1e] border border-gray-800 rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-gray-800">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-white">Customer Data</h3>
                    <p class="text-sm text-gray-500 mt-1">All registered customers and their statistics</p>
                </div>
                <div class="bg-purple-500/10 border border-purple-500/20 px-4 py-2 rounded-full">
                    <span class="text-purple-400 text-xs font-bold">{{ $customers->count() }} Customers</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#252525] border-b border-gray-800 text-gray-400 text-[11px] uppercase tracking-[0.2em]">
                        <th class="p-6 font-semibold">Customer</th>
                        <th class="p-6 font-semibold text-center">Total Orders</th>
                        <th class="p-6 font-semibold text-center">Total Spent</th>
                        <th class="p-6 font-semibold text-center">Joined Date</th>
                        <th class="p-6 font-semibold text-center">Status</th>
                        <th class="p-6 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300 divide-y divide-gray-800/50">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-yellow-400/[0.02] transition-all">
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-yellow-400 to-yellow-600 flex items-center justify-center text-black font-black text-sm">
                                        {{ substr($customer->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">{{ $customer->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $customer->email }}</p>
                                        @if($customer->google_id)
                                            <span class="text-[9px] bg-blue-500/10 text-blue-400 px-2 py-0.5 rounded-full mt-1 inline-block">
                                                <i class="fab fa-google mr-1"></i>Google
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-center">
                                <div class="inline-flex items-center gap-2 bg-blue-500/10 px-3 py-1.5 rounded-lg">
                                    <i class="fas fa-shopping-bag text-blue-400 text-xs"></i>
                                    <span class="text-white font-bold text-sm">{{ $customer->orders_count }}</span>
                                </div>
                            </td>
                            <td class="p-6 text-center">
                                <p class="text-green-400 font-bold text-sm">
                                    Rp {{ number_format($customer->orders_sum_total_price ?? 0, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="p-6 text-center">
                                <p class="text-gray-400 text-sm">{{ $customer->created_at->format('d M Y') }}</p>
                                <p class="text-gray-600 text-xs">{{ $customer->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="p-6 text-center">
                                @if($customer->orders_count > 10)
                                    <span class="px-3 py-1 rounded-full bg-yellow-400/10 text-yellow-400 border border-yellow-400/20 text-[10px] font-black uppercase">
                                        <i class="fas fa-star mr-1"></i>VIP
                                    </span>
                                @elseif($customer->orders_count > 5)
                                    <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 text-[10px] font-black uppercase">
                                        Active
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-gray-500/10 text-gray-400 border border-gray-500/20 text-[10px] font-black uppercase">
                                        Regular
                                    </span>
                                @endif
                            </td>
                            <td class="p-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.customer.detail', $customer->id) }}" 
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg text-xs font-bold border border-blue-500/20 hover:bg-blue-500/20 transition">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </a>
                                    <form action="{{ route('admin.customer.delete', $customer->id) }}" method="POST" 
                                        onsubmit="return confirm('Yakin mau hapus {{ $customer->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/10 text-red-400 rounded-lg text-xs font-bold border border-red-500/20 hover:bg-red-500/20 transition">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-3 opacity-20"></i>
                                <p>No customers yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
