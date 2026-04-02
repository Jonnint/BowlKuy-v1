<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('menu')
                        ->get();
        
        $total = $cartItems->sum(function($item) {
            return $item->menu->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        $quantity = $request->quantity ?? 1;

        // Cek apakah item sudah ada di cart
        $existingCart = Cart::where('user_id', Auth::id())
                           ->where('menu_id', $menu->id)
                           ->first();

        if ($existingCart) {
            // Jika sudah ada, tambah quantity
            $existingCart->update([
                'quantity' => $existingCart->quantity + $quantity
            ]);
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $menu->id,
                'quantity' => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)
                   ->where('user_id', Auth::id())
                   ->firstOrFail();

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Quantity berhasil diupdate!');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', $id)
                   ->where('user_id', Auth::id())
                   ->firstOrFail();

        $cart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari cart!');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('menu')
                        ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart kosong!');
        }

        // Buat order untuk setiap item di cart
        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => Auth::id(),
                'menu_id' => $item->menu_id,
                'quantity' => $item->quantity,
                'total_price' => $item->menu->price * $item->quantity,
                'status' => 'pending',
                'payment_status' => 'unpaid', // ✅ FIX: Tambahkan ini!
            ]);
        }

        // Hapus semua item dari cart setelah checkout
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }
}
