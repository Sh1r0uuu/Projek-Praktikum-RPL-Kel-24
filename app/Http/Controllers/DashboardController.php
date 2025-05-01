<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user()
    {
        $recipes = Recipe::latest()->take(6)->get(); // ambil 6 resep terbaru
        return view('dashboard.user', compact('recipes'));
    }

    public function admin()
    {
        $recipes = Recipe::latest()->take(6)->get(); // tambahkan ini
        return view('dashboard.admin', compact('recipes'));
    }
}
