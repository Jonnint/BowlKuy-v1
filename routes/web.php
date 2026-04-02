<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ConnectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Connection status API
Route::get('/api/connection/status', [ConnectionController::class, 'status'])->name('connection.status');
Route::post('/api/connection/refresh', [ConnectionController::class, 'refresh'])->name('connection.refresh');

// google OAuth
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/dashboard', function () {
    // ngecek apakah yang login ini admin
    if (Auth::user() && Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    // jika user biasa, tampilkan riwayat Pesanan Saya
    $orders = \App\Models\Order::where('user_id', Auth::id())->latest()->get();
    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::delete('/dashboard/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    
    // route untuk halaman pembayaran & proses upload
    Route::get('/dashboard/orders/{id}/pay', [OrderController::class, 'payPage'])->name('orders.pay_page');
    Route::post('/dashboard/orders/{id}/pay', [OrderController::class, 'processPay'])->name('orders.process_pay');
    
    // page cart
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/admin/customers/{id}', [AdminController::class, 'customerDetail'])->name('admin.customer.detail');
    Route::delete('/admin/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.customer.delete');
    Route::patch('/admin/order/{id}', [AdminController::class, 'updateStatus'])->name('admin.order.update');
    
    // untuk kelola menu
    Route::get('/admin/menus', [MenuController::class, 'index'])->name('admin.menus.index');
    Route::post('/admin/menus', [MenuController::class, 'store'])->name('admin.menus.store');
    Route::delete('/admin/menus/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
    Route::resource('admin/menus', MenuController::class)->names('admin.menus');
    Route::post('/admin/orders/{id}/verify', [AdminController::class, 'updatePaymentStatus'])->name('admin.orders.verify');
});

require __DIR__.'/auth.php';