<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'menu_id' => $menu->id,
            'quantity' => 1,
            'total_price' => $menu->price,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('orders.pay_page', $order->id)->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function destroy($id)
    {
        // Cari pesanan berdasarkan ID dan pastikan itu milik user yang sedang login
        $order = Order::where('id', $id)
                      ->where('user_id', auth()->id())
                      ->firstOrFail();

        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus!');
    }

    public function payPage($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('orders.pay', compact('order'));
    }

    public function processPay(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            $fileName = time() . '_proof_' . $id . '.' . $request->payment_proof->extension();
            $request->payment_proof->move(public_path('assets/img/proofs'), $fileName);
            
            $order->update([
                'payment_proof' => $fileName,
                'payment_status' => 'pending_check' 
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Bukti berhasil dikirim!');
    }
}