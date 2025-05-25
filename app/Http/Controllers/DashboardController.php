<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masakan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user()
    {
        $masakans = Masakan::latest()->take(6)->get(); // ambil 6 resep terbaru
        return view('dashboard.user', compact('masakans'));
    }

    public function admin()
    {
        $masakans = Masakan::latest()->take(6)->get(); // tambahkan ini
        return view('dashboard.admin', compact('masakans'));
    }

// About us

public function aboutUs()
{
    $masakans = Masakan::latest()->take(6)->get(); // Consistent data availability
    return view('dashboard.about', compact('masakans'));
}
}