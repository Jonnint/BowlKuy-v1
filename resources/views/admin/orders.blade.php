@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <x-filter-section 
        title="Filter Pesanan"
        :action="route('admin.orders')"
        :categories="[]"
        :currentFilters="request()->all()"
        :showSearch="false"
        :showCategory="false"
        :showPriceRange="false"
        :showSort="false"
    >
        <div class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Customer</label>
                    <select name="customer_id" class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
                        <option value="">Semua Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1 flex items-center gap-2">
                        <i class="fas fa-calendar text-purple-400"></i> Bulan
                    </label>
                    <select name="month" class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 transition">
                        <option value="">Semua Bulan</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1 flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-orange-400"></i> Tahun
                    </label>
                    <select name="year" class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 transition">
                        @for($y = date('Y'); $y >= 2024; $y--)
                            <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-white text-sm font-semibold flex items-center gap-2">
                        <i class="fas fa-flag text-green-400 text-xs"></i> Order Status
                    </label>
                    <div class="bg-black/20 backdrop-blur-sm rounded-2xl p-1.5 border border-white/5 grid grid-cols-2 sm:grid-cols-4 gap-1.5">
                        @php
                            $statuses = [
                                '' => ['label' => 'All', 'color' => 'gray', 'class' => 'status-active-neutral'],
                                'pending_check' => ['label' => 'Pending', 'color' => 'yellow', 'class' => 'status-active-pending'],
                                'paid' => ['label' => 'Paid', 'color' => 'green', 'class' => 'status-active-paid'],
                                'rejected' => ['label' => 'Rejected', 'color' => 'red', 'class' => 'status-active-rejected']
                            ];
                        @endphp
                        @foreach($statuses as $value => $data)
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="status" value="{{ $value }}" {{ request('status') == $value ? 'checked' : '' }} class="sr-only">
                                <div class="status-btn {{ request('status') == $value ? $data['class'] : '' }} bg-transparent hover:bg-white/5 rounded-xl px-3 py-3 text-center transition-all border border-transparent">
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="h-2 w-2 bg-{{ $data['color'] }}-400 rounded-full"></div>
                                        <span class="text-xs font-bold text-{{ $data['color'] }}-400">{{ $data['label'] }}</span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-white text-sm font-semibold flex items-center gap-2">
                        <i class="fas fa-calendar-week text-cyan-400 text-xs"></i> Custom Date Range
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="bg-white/5 border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:border-blue-400 transition">
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="bg-white/5 border-white/10 text-white rounded-xl px-4 py-3 text-sm focus:border-blue-400 transition">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-white/5 flex flex-col sm:flex-row gap-4 justify-between items-center">
                <span class="text-sm text-gray-500 italic">Gunakan filter untuk mempercepat pencarian data.</span>
                <div class="flex gap-3 w-full sm:w-auto">
                    <a href="{{ route('admin.orders') }}" class="flex-1 sm:flex-none text-center px-6 py-3 bg-gray-800 text-gray-300 rounded-xl font-bold text-sm hover:bg-gray-700 transition">
                        CLEAR
                    </a>
                    <button type="submit" class="flex-1 sm:flex-none px-8 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-xl font-bold text-sm shadow-lg shadow-blue-500/20 hover:scale-105 transition">
                        APPLY FILTERS
                    </button>
                </div>
            </div>
        </div>
    </x-filter-section>

    @if(request()->hasAny(['customer_id', 'status', 'month', 'year', 'date_from', 'date_to']))
        <div class="bg-gradient-to-r from-blue-500/10 via-purple-500/10 to-cyan-500/10 border border-blue-500/20 rounded-2xl p-6 backdrop-blur-sm shadow-lg">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="h-12 w-12 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-filter text-blue-400 text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg flex items-center gap-2">
                            Filtered Results <span class="h-2 w-2 bg-green-400 rounded-full animate-pulse"></span>
                        </h4>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-medium border border-blue-500/30">
                                {{ $orders->count() }} orders found
                            </span>
                            </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button onclick="window.print()" class="px-4 py-2 bg-green-500/20 text-green-400 border border-green-500/30 rounded-xl text-sm font-medium hover:bg-green-500/30 transition">
                        <i class="fas fa-print mr-2"></i> Print
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

    <!-- Orders Table -->
    <div class="bg-[#1e1e1e] border border-gray-800 rounded-2xl overflow-hidden print-area">
        <div class="p-6 border-b border-gray-800">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-white">All Orders</h3>
                    <p class="text-sm text-gray-500 mt-1">Manage and verify customer orders</p>
                </div>
                <div class="flex gap-3">
                    <div class="bg-yellow-400/10 border border-yellow-400/20 px-4 py-2 rounded-full">
                        <span class="text-yellow-400 text-xs font-bold">{{ $orders->where('payment_status', 'pending_check')->count() }} Pending</span>
                    </div>
                    <div class="bg-blue-500/10 border border-blue-500/20 px-4 py-2 rounded-full">
                        <span class="text-blue-400 text-xs font-bold">{{ $orders->count() }} Total</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#252525] border-b border-gray-800 text-gray-400 text-[11px] uppercase tracking-[0.2em]">
                        <th class="p-6 font-semibold">Customer</th>
                        <th class="p-6 font-semibold">Order</th>
                        <th class="p-6 font-semibold text-center">Proof</th>
                        <th class="p-6 font-semibold text-center">Status</th>
                        <th class="p-6 font-semibold text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300 divide-y divide-gray-800/50">
                    @forelse($orders as $order)
                        <tr class="hover:bg-yellow-400/[0.02] transition-all">
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-yellow-400 to-yellow-600 flex items-center justify-center text-black font-black text-xs">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">{{ $order->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <p class="font-medium text-white">{{ $order->menu->name }}</p>
                                <p class="text-xs text-gray-500">Qty: {{ $order->quantity }} × Rp {{ number_format($order->menu->price, 0, ',', '.') }}</p>
                                <p class="text-sm font-bold text-yellow-400 mt-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </td>
                            <td class="p-6 text-center">
                                @if ($order->payment_proof)
                                    <button onclick="showProofModal('{{ asset('assets/img/proofs/' . $order->payment_proof) }}')" 
                                        class="group inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-500/20 to-purple-500/20 hover:from-blue-500/30 hover:to-purple-500/30 text-blue-400 hover:text-blue-300 rounded-xl text-sm font-bold border border-blue-500/30 hover:border-blue-400/50 transition-all duration-300 backdrop-blur-sm hover:scale-105 transform shadow-lg shadow-blue-500/10">
                                        <i class="fas fa-image group-hover:scale-110 transition-transform duration-300"></i>
                                        View Proof
                                    </button>
                                @else
                                    <div class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-800/40 text-gray-500 rounded-xl text-sm border border-gray-700/50 backdrop-blur-sm">
                                        <i class="fas fa-image-slash"></i>
                                        No Proof
                                    </div>
                                @endif
                            </td>
                            <td class="p-6 text-center">
                                @php
                                    $statusClasses = [
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
                            <td class="p-6">
                                <div class="flex gap-2 justify-center">
                                    @if ($order->payment_status == 'pending_check')
                                        <form action="{{ route('admin.orders.verify', $order->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="paid">
                                            <button class="group px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white text-xs font-bold rounded-xl transition-all duration-300 shadow-lg shadow-green-500/25 hover:shadow-green-500/40 hover:scale-105 transform">
                                                <i class="fas fa-check mr-1 group-hover:scale-110 transition-transform duration-300"></i>
                                                APPROVE
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.orders.verify', $order->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="group px-4 py-2 bg-transparent border-2 border-red-500/60 text-red-400 hover:bg-gradient-to-r hover:from-red-500 hover:to-red-600 hover:text-white hover:border-red-500 text-xs font-bold rounded-xl transition-all duration-300 hover:scale-105 transform hover:shadow-lg hover:shadow-red-500/25">
                                                <i class="fas fa-times mr-1 group-hover:scale-110 transition-transform duration-300"></i>
                                                REJECT
                                            </button>
                                        </form>
                                    @else
                                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800/50 text-gray-400 rounded-xl text-xs font-bold border border-gray-700/50 backdrop-blur-sm">
                                            <i class="fas fa-check-double text-green-400"></i>
                                            Processed
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 opacity-20"></i>
                                <p>No orders yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk View Bukti Pembayaran -->
<div id="proofModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity duration-300 opacity-0" onclick="closeProofModal()">
    <div class="relative max-w-2xl w-full mx-auto transform transition-all duration-300 scale-95" onclick="event.stopPropagation()">
        <button onclick="closeProofModal()" class="absolute -top-10 right-0 md:-right-10 md:top-0 text-white hover:text-yellow-400 transition-colors bg-black/50 hover:bg-black/70 rounded-full p-2 w-10 h-10 flex items-center justify-center z-10">
            <i class="fas fa-times text-xl"></i>
        </button>
        <div class="absolute top-4 left-4 flex gap-2 z-10">
            <button onclick="zoomIn()" class="bg-black/70 hover:bg-yellow-400/90 text-white hover:text-black transition-colors rounded-full p-2 w-10 h-10 flex items-center justify-center">
                <i class="fas fa-plus"></i>
            </button>
            <button onclick="zoomOut()" class="bg-black/70 hover:bg-yellow-400/90 text-white hover:text-black transition-colors rounded-full p-2 w-10 h-10 flex items-center justify-center">
                <i class="fas fa-minus"></i>
            </button>
            <button onclick="resetZoom()" class="bg-black/70 hover:bg-yellow-400/90 text-white hover:text-black transition-colors rounded-full p-2 w-10 h-10 flex items-center justify-center">
                <i class="fas fa-redo text-sm"></i>
            </button>
        </div>
        <div class="bg-[#1e1e1e] rounded-2xl overflow-hidden shadow-2xl border border-gray-800">
            <div class="p-4 border-b border-gray-800 flex items-center justify-between">
                <h3 class="text-white font-bold text-sm">Bukti Pembayaran</h3>
                <div class="flex items-center gap-3">
                    <span id="zoomLevel" class="text-gray-400 text-xs">100%</span>
                    <button onclick="closeProofModal()" class="text-gray-400 hover:text-white transition md:hidden">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="relative bg-black overflow-auto" id="imageContainer" style="max-height: 70vh;">
                <img id="proofImage" src="" alt="Payment Proof" class="w-full h-auto transition-transform duration-200 cursor-move" style="transform-origin: center center;">
            </div>
            <div class="p-3 bg-[#252525] text-center">
                <p class="text-gray-500 text-xs">
                    <i class="fas fa-mouse-pointer mr-1"></i>Klik mana aja untuk tutup
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    let currentZoom = 1;
    let isDragging = false;
    let startX, startY, scrollLeft, scrollTop;

    function showProofModal(imageUrl) {
        const modal = document.getElementById('proofModal');
        const modalContent = modal.querySelector('.transform');
        
        document.getElementById('proofImage').src = imageUrl;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        currentZoom = 1;
        updateZoom();
        
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeProofModal() {
        const modal = document.getElementById('proofModal');
        const modalContent = modal.querySelector('.transform');
        
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    function zoomIn() {
        currentZoom = Math.min(currentZoom + 0.25, 3);
        updateZoom();
    }

    function zoomOut() {
        currentZoom = Math.max(currentZoom - 0.25, 0.5);
        updateZoom();
    }

    function resetZoom() {
        currentZoom = 1;
        updateZoom();
        const container = document.getElementById('imageContainer');
        container.scrollLeft = 0;
        container.scrollTop = 0;
    }

    function updateZoom() {
        const img = document.getElementById('proofImage');
        const zoomLevel = document.getElementById('zoomLevel');
        img.style.transform = `scale(${currentZoom})`;
        zoomLevel.textContent = Math.round(currentZoom * 100) + '%';
    }

    function clearAllFilters() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('select, input[type="date"]');
        const radioButtons = form.querySelectorAll('input[type="radio"]');
        
        inputs.forEach(input => {
            if (input.tagName === 'SELECT') {
                input.selectedIndex = 0;
            } else {
                input.value = '';
            }
        });
        
        // Reset radio buttons to "All Status"
        radioButtons.forEach(radio => {
            const statusBtn = radio.closest('label').querySelector('.status-btn');
            statusBtn.classList.remove('status-active-neutral', 'status-active-pending', 'status-active-paid', 'status-active-rejected');
            
            if (radio.value === '') {
                radio.checked = true;
                statusBtn.classList.add('status-active-neutral');
            } else {
                radio.checked = false;
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Handle status filter radio button changes with premium animations
        const statusRadios = document.querySelectorAll('input[name="status"]');
        statusRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove all active classes from all status buttons
                statusRadios.forEach(r => {
                    const btn = r.closest('label').querySelector('.status-btn');
                    btn.classList.remove('status-active-neutral', 'status-active-pending', 'status-active-paid', 'status-active-rejected');
                });
                
                // Add appropriate active class to selected button
                if (this.checked) {
                    const btn = this.closest('label').querySelector('.status-btn');
                    const value = this.value;
                    
                    if (value === '') {
                        btn.classList.add('status-active-neutral');
                    } else if (value === 'pending_check') {
                        btn.classList.add('status-active-pending');
                    } else if (value === 'paid') {
                        btn.classList.add('status-active-paid');
                    } else if (value === 'rejected') {
                        btn.classList.add('status-active-rejected');
                    }
                }
            });
        });
        
        const proofImage = document.getElementById('proofImage');
        const imageContainer = document.getElementById('imageContainer');
        
        // Mouse wheel zoom
        proofImage.addEventListener('wheel', function(e) {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        });

        // Drag to pan functionality
        imageContainer.addEventListener('mousedown', function(e) {
            if (currentZoom > 1) {
                isDragging = true;
                imageContainer.style.cursor = 'grabbing';
                startX = e.pageX - imageContainer.offsetLeft;
                startY = e.pageY - imageContainer.offsetTop;
                scrollLeft = imageContainer.scrollLeft;
                scrollTop = imageContainer.scrollTop;
            }
        });

        imageContainer.addEventListener('mouseleave', function() {
            isDragging = false;
            if (currentZoom > 1) imageContainer.style.cursor = 'move';
        });

        imageContainer.addEventListener('mouseup', function() {
            isDragging = false;
            if (currentZoom > 1) imageContainer.style.cursor = 'move';
        });

        imageContainer.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - imageContainer.offsetLeft;
            const y = e.pageY - imageContainer.offsetTop;
            const walkX = (x - startX) * 2;
            const walkY = (y - startY) * 2;
            imageContainer.scrollLeft = scrollLeft - walkX;
            imageContainer.scrollTop = scrollTop - walkY;
        });

        // Touch support
        let touchStartX, touchStartY, touchScrollLeft, touchScrollTop;
        
        imageContainer.addEventListener('touchstart', function(e) {
            if (currentZoom > 1) {
                touchStartX = e.touches[0].pageX - imageContainer.offsetLeft;
                touchStartY = e.touches[0].pageY - imageContainer.offsetTop;
                touchScrollLeft = imageContainer.scrollLeft;
                touchScrollTop = imageContainer.scrollTop;
            }
        });

        imageContainer.addEventListener('touchmove', function(e) {
            if (currentZoom > 1) {
                e.preventDefault();
                const x = e.touches[0].pageX - imageContainer.offsetLeft;
                const y = e.touches[0].pageY - imageContainer.offsetTop;
                const walkX = (x - touchStartX) * 2;
                const walkY = (y - touchStartY) * 2;
                imageContainer.scrollLeft = touchScrollLeft - walkX;
                imageContainer.scrollTop = touchScrollTop - walkY;
            }
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeProofModal();
        }
    });
</script>

<!-- PREMIUM SaaS DASHBOARD STYLES -->
<style>
    @media print {
        body * { visibility: hidden; }
        #sidebar, .no-print { display: none !important; }
        .print-area, .print-area * { visibility: visible; }
        .print-area { 
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        table { page-break-inside: auto; }
        tr { page-break-inside: avoid; page-break-after: auto; }
    }
    
    #proofModal {
        transition: opacity 0.3s ease-in-out;
    }
    
    #proofModal .transform {
        transition: transform 0.3s ease-in-out;
    }
    
    #proofImage {
        transition: transform 0.2s ease-out;
    }
    
    #imageContainer {
        cursor: default;
    }
    
    /* Premium Input Field Styling */
    select, input[type="date"] {
        background-image: none;
        color-scheme: dark;
    }
    
    /* Premium Focus Effects with Electric Blue Glow */
    input:focus, select:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 0 20px rgba(59, 130, 246, 0.05) !important;
        transform: translateY(-1px);
        background: rgba(255, 255, 255, 0.08) !important;
    }
    
    /* Premium Button Hover Effects */
    button:hover, a:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }
    
    /* Premium Status Button System */
    .status-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.25s ease-in-out;
        cursor: pointer;
    }
    
    .status-btn:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    
    /* Active Status States with Glow */
    .status-active-neutral {
        background: rgba(107, 114, 128, 0.2) !important;
        border-color: rgba(107, 114, 128, 0.4) !important;
        box-shadow: 0 0 20px rgba(107, 114, 128, 0.2);
        transform: scale(1.05);
    }
    
    .status-active-pending {
        background
    
    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradient-shift 4s ease infinite;
    }
    
    /* Custom Premium Scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
        border-color: rgba(239, 68, 68, 0.5) !important;
        box-shadow: 0 0 25px rgba(239, 68, 68, 0.3);
        transform: scale(1.05);
    }
    
    /* Premium Gradient Animations */
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    @keyframes glow-pulse {
        0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
        50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.5); }
    }
    
    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradient-shift 4s ease infinite;
    }
    
    /* Premium Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, rgba(59, 130, 246, 0.4), rgba(34, 211, 238, 0.4));
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, rgba(59, 130, 246, 0.6), rgba(34, 211, 238, 0.6));
    }
    
    /* Premium Microinteractions */
    .transition-all {
        transition: all 0.25s ease-in-out;
    }
    
    /* Enhanced Button Animations */
    button[type="submit"] {
        position: relative;
        overflow: hidden;
    }
    
    button[type="submit"]:hover {
        animation: glow-pulse 2s ease-in-out infinite;
    }
    
    button[type="submit"]:active {
        transform: translateY(1px) scale(0.98);
    }
    
    /* Hide radio buttons */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }
    
    /* Premium Hover Shadow Increase */
    .hover\\:shadow-lg:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4) !important;
    }
    
    /* Premium Loading States */
    .loading {
        position: relative;
        overflow: hidden;
    }
    
    .loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    /* Responsive Enhancements */
    @media (max-width: 1024px) {
        .grid.lg\\:grid-cols-2 {
            gap: 1.5rem;
        }
    }
    
    @media (max-width: 768px) {
        #proofModal .max-w-2xl {
            max-width: 95%;
        }
        
        #imageContainer {
            max-height: 60vh !important;
        }
        
        .status-btn {
            padding: 0.75rem !important;
        }
        
        .status-btn span {
            font-size: 0.75rem !important;
        }
    }
    
    @media (max-width: 480px) {
        #proofModal .max-w-2xl {
            max-width: 90%;
        }
        
        #imageContainer {
            max-height: 50vh !important;
        }
        
        .grid.grid-cols-2 {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }
    }
    
    /* Premium Dark Theme for Select Options */
    option {
        background-color: #1e1e2e !important;
        color: white !important;
    }
    
    option:hover {
        background-color: #3b82f6 !important;
    }
    
    /* Enhanced Visual Separator */
    .bg-gradient-to-r.from-transparent {
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    }
</style>
@endsection