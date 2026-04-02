<?php

namespace App\Http\Controllers;

use App\Models\Menu; // <--- WAJIB TAMBAHKAN BARIS INI
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::all(); // Sekarang baris ini gak bakal error lagi
        return view('home', compact('menus'));
    }
}