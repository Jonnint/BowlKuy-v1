@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-[#1e1e1e] border border-gray-800 p-8 rounded-3xl shadow-2xl">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-8 w-1 bg-yellow-400 rounded-full"></div>
            <h3 class="text-white font-bold text-lg uppercase tracking-wider">Edit Menu: {{ $menu->name }}</h3>
        </div>

        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Nama Menu</label>
                    <input type="text" name="name" value="{{ $menu->name }}" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ $menu->price }}" 
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Kategori</label>
                    <select name="category" class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>
                        <option value="best-seller" {{ $menu->category == 'best-seller' ? 'selected' : '' }} class="bg-[#1e1e1e]">Best Seller</option>
                        <option value="hemat" {{ $menu->category == 'hemat' ? 'selected' : '' }} class="bg-[#1e1e1e]">Hemat</option>
                        <option value="rice-bowl" {{ $menu->category == 'rice-bowl' ? 'selected' : '' }} class="bg-[#1e1e1e]">Rice Bowl</option>
                        <option value="minuman" {{ $menu->category == 'minuman' ? 'selected' : '' }} class="bg-[#1e1e1e]">Minuman</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full bg-[#252525] border-gray-700 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400 transition" required>{{ $menu->description }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-gray-400 text-xs font-bold uppercase ml-1">Foto Menu (Kosongkan jika tidak ganti)</label>
                    <input type="file" name="image" 
                        class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-yellow-400 file:text-black hover:file:bg-yellow-500 cursor-pointer">
                    @if($menu->image)
                        <div class="mt-3 flex items-center gap-3">
                            <img src="{{ asset('assets/img/menu/' . $menu->image) }}" alt="{{ $menu->name }}" class="h-20 w-20 object-cover rounded-lg border border-gray-700">
                            <p class="text-xs text-gray-500">Current image: {{ $menu->image }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button type="submit"
                    class="bg-yellow-400 text-black px-8 py-3 rounded-xl font-black text-sm hover:bg-yellow-500 transition shadow-lg shadow-yellow-400/10">
                    UPDATE MENU
                </button>
                <a href="{{ route('admin.menus.index') }}"
                    class="bg-gray-700 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-gray-600 transition">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</div>
@endsection