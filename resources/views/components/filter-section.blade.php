@props([
    'title' => 'Filter Menu',
    'action' => '',
    'method' => 'GET',
    'showSearch' => true,
    'showCategory' => true,
    'showPriceRange' => true,
    'showSort' => true,
    'categories' => [],
    'currentFilters' => []
])

<div class="bg-[#1e1e1e] p-8 rounded-3xl border border-gray-800 shadow-2xl mb-6">
    <div class="flex items-center gap-3 mb-6">
        <div class="h-8 w-1 bg-yellow-400 rounded-full"></div>
        <h3 class="text-white font-bold text-lg uppercase tracking-wider">{{ $title }}</h3>
    </div>

    <form action="{{ $action }}" method="{{ $method }}" class="space-y-6">
        @if($method !== 'GET')
            @csrf
        @endif
        
        @if($slot->isEmpty())
        <!-- Default Filter Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            @if($showSearch)
            <!-- Search Field -->
            <div class="space-y-2">
                <label class="text-gray-400 text-xs font-bold uppercase ml-1">Nama Menu</label>
                <input type="text" 
                       name="search" 
                       value="{{ $currentFilters['search'] ?? '' }}"
                       placeholder="Cari menu..." 
                       class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>
            @endif

            @if($showPriceRange)
            <!-- Price Range -->
            <div class="space-y-2">
                <label class="text-gray-400 text-xs font-bold uppercase ml-1">Harga (Rp)</label>
                <input type="number" 
                       name="price_filter" 
                       value="{{ $currentFilters['price_filter'] ?? '' }}"
                       placeholder="Max harga..." 
                       class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
            </div>
            @endif

            @if($showCategory && count($categories) > 0)
            <!-- Category Filter -->
            <div class="space-y-2">
                <label class="text-gray-400 text-xs font-bold uppercase ml-1">Kategori</label>
                <select name="category" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
                    <option value="" class="bg-[#1e1e1e]">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" 
                                {{ ($currentFilters['category'] ?? '') == $category ? 'selected' : '' }}
                                class="bg-[#1e1e1e]">
                            {{ ucwords(str_replace('-', ' ', $category)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            @if($showSort)
            <!-- Sort Options -->
            <div class="space-y-2">
                <label class="text-gray-400 text-xs font-bold uppercase ml-1">Urutkan</label>
                <select name="sort" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition">
                    <option value="" class="bg-[#1e1e1e]">Default</option>
                    <option value="name_asc" {{ ($currentFilters['sort'] ?? '') == 'name_asc' ? 'selected' : '' }} class="bg-[#1e1e1e]">Nama A-Z</option>
                    <option value="name_desc" {{ ($currentFilters['sort'] ?? '') == 'name_desc' ? 'selected' : '' }} class="bg-[#1e1e1e]">Nama Z-A</option>
                    <option value="price_asc" {{ ($currentFilters['sort'] ?? '') == 'price_asc' ? 'selected' : '' }} class="bg-[#1e1e1e]">Harga Rendah-Tinggi</option>
                    <option value="price_desc" {{ ($currentFilters['sort'] ?? '') == 'price_desc' ? 'selected' : '' }} class="bg-[#1e1e1e]">Harga Tinggi-Rendah</option>
                </select>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="space-y-2 flex flex-col justify-end">
                <div class="flex gap-2">
                    <button type="submit"
                            class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-black text-sm hover:bg-yellow-500 transition shadow-lg shadow-yellow-400/10 flex-1">
                        FILTER
                    </button>
                    <a href="{{ $action }}"
                       class="bg-gray-700 text-white px-4 py-3 rounded-xl font-bold text-sm hover:bg-gray-600 transition flex items-center justify-center">
                        <i class="fas fa-redo text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
        @else
        <!-- Custom Filter Layout -->
        {{ $slot }}
        @endif
    </form>
</div>

<style>
/* Enhanced form styling */
input:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(255, 190, 51, 0.1) !important;
    transform: translateY(-1px);
}

select, input[type="text"], input[type="number"], input[type="date"] {
    background-image: none;
    color-scheme: dark;
}

option {
    background-color: #1e1e1e !important;
    color: white !important;
}

button:hover, a:hover {
    transform: translateY(-1px);
}

.transition {
    transition: all 0.2s ease-in-out;
}
</style>