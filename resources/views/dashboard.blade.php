<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-yellow-400 leading-tight">
            {{ __('Dashboard Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#121212] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-gray-800 shadow-xl">
                    <p class="text-gray-400 text-sm font-medium">Total Pesanan</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $orders->count() }}</h3>
                </div>
                <div class="bg-[#1e1e1e] p-6 rounded-2xl border border-gray-800 shadow-xl">
                    <p class="text-gray-400 text-sm font-medium">Status Akun</p>
                    <h3 class="text-xl font-bold text-green-400 mt-2">Active Member</h3>
                </div>
            </div>

            <div class="bg-[#1e1e1e] overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-800">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-white">Riwayat <span class="text-yellow-400">Pesanan Saya</span></h3>
                            <p class="text-gray-400 text-sm mt-1">Pantau status masak dan pembayaran di sini.</p>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ url('/') }}"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm transition all duration-200 border border-gray-700">
                                ← Menu Utama
                            </a>

                            <a href="{{ url('/#menu') }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-black font-extrabold py-2.5 px-5 rounded-xl text-sm transition all duration-200 shadow-lg shadow-yellow-400/20">
                                + Pesan Lagi
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-3">
                            <thead>
                                <tr class="text-gray-500 text-sm uppercase tracking-wider">
                                    <th class="px-4 py-3 font-medium">Menu</th>
                                    <th class="px-4 py-3 font-medium">Harga</th>
                                    <th class="px-4 py-3 font-medium text-center">Status Masak</th>
                                    <th class="px-4 py-3 font-medium text-center">Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody class="text-white">
                                @foreach ($orders as $order)
                                    <tr class="bg-[#252525] hover:bg-[#2d2d2d] transition-all duration-200 shadow-sm">
                                        <td class="px-4 py-4 rounded-l-xl font-bold text-gray-200">
                                            {{ $order->menu->name }}
                                        </td>
                                        <td class="px-4 py-4 font-semibold text-yellow-400/90">
                                            Rp {{ number_format($order->total_price) }}
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if($order->status == 'pending')
                                                <span class="bg-orange-500/10 text-orange-400 px-3 py-1 rounded-lg text-xs font-bold border border-orange-500/20">
                                                    Diterima
                                                </span>
                                            @else
                                                <span class="bg-green-500/10 text-green-400 px-3 py-1 rounded-lg text-xs font-bold border border-green-500/20">
                                                    Selesai
                                                </span>
                                            @endif  
                                        </td>
                                        <td class="px-4 py-4 rounded-r-xl text-center">
                                            <div class="flex justify-center items-center gap-3">
                                                @if ($order->payment_status == 'unpaid' || $order->payment_status == 'rejected')
                                                    <!-- Midtrans Payment Button -->
                                                    @if($order->snap_token)
                                                        <a href="{{ route('order.payment', $order->id) }}"
                                                            class="bg-emerald-600 hover:bg-emerald-400 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition shadow-lg shadow-emerald-600/20">
                                                            Bayar Online
                                                        </a>
                                                    @endif
                                                    
                                                    <!-- Manual Payment Button -->
                                                    <a href="{{ route('orders.pay_page', $order->id) }}"
                                                        class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition shadow-lg shadow-blue-600/20">
                                                        Upload Bukti
                                                    </a>

                                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin membatalkan pesanan?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @elseif($order->payment_status == 'pending')
                                                    <span class="text-yellow-500 text-xs font-bold flex items-center gap-1">
                                                        <span class="relative flex h-2 w-2">
                                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                                                        </span>
                                                        Menunggu Pembayaran
                                                    </span>
                                                @elseif($order->payment_status == 'pending_check')
                                                    <span class="text-yellow-500 text-xs font-bold flex items-center gap-1">
                                                        <span class="relative flex h-2 w-2">
                                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                                                        </span>
                                                        Verifikasi Admin
                                                    </span>
                                                @else
                                                    <span class="text-green-400 text-xs font-bold bg-green-400/10 px-3 py-1 rounded-lg">Lunas ✨</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>