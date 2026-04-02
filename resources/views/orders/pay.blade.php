<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Pembayaran Pesanan #{{ $order->id }}</h2>
                <p class="text-gray-600 mb-6">Total Tagihan: <span class="font-bold text-black">Rp {{ number_format($order->total_price) }}</span></p>

                <div class="mb-6 border-2 border-dashed border-gray-200 p-4 inline-block">
                    <p class="text-sm text-gray-500 mb-2">Scan QRIS di bawah ini:</p>
                    <img src="{{ asset('assets/img/qris.png') }}" alt="QRIS" class="w-64 h-auto mx-auto">
                </div>

                <form action="{{ route('orders.process_pay', $order->id) }}" method="POST" enctype="multipart/form-data" class="text-left">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Upload Bukti Transfer</label>
                        <input type="file" name="payment_proof" class="w-full border p-2 rounded" required>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded shadow">
                            Kirim Bukti Pembayaran
                        </button>
                        <a href="{{ route('dashboard') }}" class="w-1/3 bg-gray-200 text-center py-2 rounded font-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>