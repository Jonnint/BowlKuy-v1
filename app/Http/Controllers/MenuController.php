<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Tampilkan semua menu di dashboard admin dengan filter
    public function index(Request $request)
    {
        $query = Menu::query();

        // Filter by search (name or description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort options
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $menus = $query->get();

        return view('admin.menus.index', compact('menus'))->with([
            'title' => 'Menu Management',
            'subtitle' => 'Manage restaurant menu items'
        ]);
    }

    // Simpan menu baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/img/menu'), $imageName); // Simpan ke folder public
            $data['image'] = $imageName;
        }

        Menu::create($data);

        return redirect()->back()->with('success', 'Menu dan foto berhasil ditambah!');
    }

    // Hapus menu
    public function destroy($id)
    {
        $menu = \App\Models\Menu::findOrFail($id);

        // Cek apakah file fotonya ada di folder, jika ada hapus permanen
        if ($menu->image && file_exists(public_path('assets/img/menu/'.$menu->image))) {
            unlink(public_path('assets/img/menu/'.$menu->image));
        }

        $menu->delete();

        return redirect()->back()->with('success', 'Menu dan fotonya berhasil dihapus!');
    }

    // Munculin halaman edit
public function edit($id)
{
    $menu = \App\Models\Menu::findOrFail($id);
    return view('admin.menus.edit', compact('menu'))->with([
        'title' => 'Edit Menu',
        'subtitle' => 'Update menu item details'
    ]);
}

// Proses simpan perubahan
public function update(Request $request, $id)
{
    $menu = \App\Models\Menu::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        // 1. Hapus foto lama dari folder biar gak nyampah
        if ($menu->image && file_exists(public_path('assets/img/menu/' . $menu->image))) {
            unlink(public_path('assets/img/menu/' . $menu->image));
        }

        // 2. Upload foto baru
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/img/menu'), $imageName);
        $data['image'] = $imageName;
    }

    $menu->update($data);

    return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diupdate!');
}
}
