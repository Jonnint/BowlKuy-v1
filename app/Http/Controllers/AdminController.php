<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_price');
        
        $allUsers = User::all();
        $totalCustomers = $allUsers->filter(function($user) {
            return !$user->isAdmin();
        })->count();
        
        $pendingOrders = Order::where('payment_status', 'pending_check')->count();

        $ordersPerDay = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $revenuePerDay = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
        ->where('payment_status', 'paid')
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $topMenus = Order::select('menu_id', DB::raw('SUM(quantity) as total_sold'))
            ->where('payment_status', 'paid')
            ->groupBy('menu_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->with('menu')
            ->get();

        $recentOrders = Order::with('menu', 'user')->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalCustomers',
            'pendingOrders',
            'ordersPerDay',
            'revenuePerDay',
            'topMenus',
            'recentOrders'
        ))->with([
            'title' => 'Dashboard',
            'subtitle' => 'Welcome back, Admin!'
        ]);
    }

    public function orders(Request $request)
    {
        $query = Order::with('menu', 'user');

        if ($request->filled('customer_id')) {
            $query->where('user_id', $request->customer_id);
        }

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('month') && $request->filled('year')) {
            $query->whereMonth('created_at', $request->month)
                  ->whereYear('created_at', $request->year);
        } elseif ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $orders = $query->latest()->get();
        
        $allUsers = User::orderBy('name')->get();
        $customers = $allUsers->filter(function($user) {
            return !$user->isAdmin();
        });

        return view('admin.orders', compact('orders', 'customers'))->with([
            'title' => 'Orders Management',
            'subtitle' => 'Manage all customer orders'
        ]);
    }

    public function customers()
    {
        $customers = User::withCount('orders')
            ->withSum('orders', 'total_price')
            ->latest()
            ->get()
            ->filter(function($user) {
                return !$user->isAdmin();
            });
        
        return view('admin.customers', compact('customers'))->with([
            'title' => 'Customers Management',
            'subtitle' => 'Manage all registered customers'
        ]);
    }

    public function customerDetail($id)
    {
        $customer = User::findOrFail($id);
        
        if ($customer->isAdmin()) {
            return redirect()->route('admin.customers')->with('error', 'Cannot view admin details');
        }

        $orders = Order::where('user_id', $id)
            ->with('menu')
            ->latest()
            ->get();

        $totalOrders = $orders->count();
        $totalSpent = $orders->where('payment_status', 'paid')->sum('total_price');
        $pendingOrders = $orders->where('payment_status', 'pending_check')->count();
        $avgOrderValue = $totalOrders > 0 ? $totalSpent / $totalOrders : 0;

        // Get favorite menu (most ordered)
        $favoriteMenu = Order::where('user_id', $id)
            ->where('payment_status', 'paid')
            ->select('menu_id', \DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('menu_id')
            ->orderBy('total_qty', 'desc')
            ->with('menu')
            ->first();

        // Last order date
        $lastOrder = $orders->first();

        // Customer tier
        $tier = 'Regular';
        if ($totalOrders > 10) {
            $tier = 'VIP';
        } elseif ($totalOrders >= 5) {
            $tier = 'Active';
        }

        return view('admin.customer-detail', compact(
            'customer',
            'orders',
            'totalOrders',
            'totalSpent',
            'pendingOrders',
            'avgOrderValue',
            'favoriteMenu',
            'lastOrder',
            'tier'
        ));
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $order->update([
            'payment_status' => $request->status,
            'status' => ($request->status == 'paid') ? 'In Process' : 'Pending'
        ]);

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function deleteCustomer($id)
    {
        $customer = User::findOrFail($id);
        
        if ($customer->isAdmin()) {
            return redirect()->route('admin.customers')->with('error', 'gabisa hapus admin user');
        }

        Order::where('user_id', $id)->delete();
        $customer->delete();

        return redirect()->route('admin.customers')->with('success', 'customernya di apus');
    }
}