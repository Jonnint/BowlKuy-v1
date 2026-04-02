@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Filter Section -->
    <x-filter-section 
        title="Filter Menu"
        :action="route('admin.menus.index')"
        :categories="['best-seller', 'hemat']"
        :currentFilters="request()->all()"
        :showSearch="true"
        :showCategory="true"
        :showPriceRange="true"
        :showSort="true"
    />

    <!-- Add Menu Form -->
    <div class="bg-[#1e1e1e] p-8 rounded-3xl border border-gray-800 shadow-2xl">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-8 w-1 bg-yellow-400 rounded-full"></div>
            <h3 class="text-white font-bold text-lg uppercase tracking-wider">Tambah Menu Baru</h3>
        </div>

        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Nama Menu</label>
                    <input type="text" name="name" placeholder="Contoh: Ayam Geprek" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Harga (Rp)</label>
                    <input type="number" name="price" placeholder="25000" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Kategori</label>
                    <select name="category" class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>
                        <option value="" class="bg-[#1e1e1e]">Pilih...</option>
                        <option value="best-seller" class="bg-[#1e1e1e]">Best Seller</option>
                        <option value="hemat" class="bg-[#1e1e1e]">Hemat</option>
                    </select>
                </div>

                <div class="space-y-2 lg:col-span-1">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Deskripsi Singkat</label>
                    <input type="text" name="description" placeholder="Pedas Mantap..." 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Foto Menu</label>
                    <input type="file" name="image" 
                        class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-yellow-400 file:text-black hover:file:bg-yellow-500 cursor-pointer">
                </div>
            </div>
            
            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-yellow-400 text-black px-8 py-3 rounded-xl font-black text-sm hover:bg-yellow-500 transition shadow-lg shadow-yellow-400/10">
                    SIMPAN MENU KE DATABASE
                </button>
            </div>
        </form>
    </div>

    <!-- Menu List -->
    <div class="bg-[#1e1e1e] border border-gray-800 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#252525] text-gray-400 text-[11px] uppercase tracking-[0.2em] border-b border-gray-800">
                        <th class="p-6">Produk</th>
                        <th class="p-6">Kategori</th>
                        <th class="p-6">Harga Satuan</th>
                        <th class="p-6 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    @foreach ($menus as $menu)
                        <tr class="hover:bg-white/[0.02] transition-all group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-16 w-16 overflow-hidden rounded-2xl border border-gray-700 group-hover:border-yellow-400/50 transition">
                                        <img src="{{ $menu->image ? asset('assets/img/menu/' . $menu->image) : asset('assets/img/placeholders/150x150.svg') }}"
                                            alt="{{ $menu->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <span class="text-white font-bold block">{{ $menu->name }}</span>
                                        <span class="text-gray-500 text-xs italic">{{ Str::limit($menu->description, 30) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <span class="bg-blue-500/10 text-blue-400 text-[10px] font-black uppercase px-3 py-1 rounded-full border border-blue-500/20">
                                    {{ $menu->category ?? 'REGULAR' }}
                                </span>
                            </td>
                            <td class="p-6">
                                <span class="text-yellow-400 font-black tracking-tight">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            </td>
                            <td class="p-6">
                                <div class="flex justify-center items-center gap-4">
                                    <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                        class="text-gray-400 hover:text-blue-400 transition" title="Edit Menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu {{ $menu->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Hapus Menu">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection