<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Tampilkan semua resep di halaman dashboard.
     */
    public function index()
    {
        $recipes = Recipe::latest()->get(); // Ambil semua resep terbaru
        return view('dashboard', compact('recipes'));
    }

    /**
     * Tampilkan form untuk menambah resep (opsional).
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Simpan resep baru ke database (opsional).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'origin' => 'required',
            'image' => 'nullable|image',
            'time' => 'required',
            'type' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
        }

        Recipe::create([
            'title' => $request->title,
            'category' => $request->category,
            'origin' => $request->origin,
            'image' => $imagePath,
            'time' => $request->time,
            'type' => $request->type,
        ]);

        return redirect()->route('dashboard')->with('success', 'Resep berhasil ditambahkan!');
    }
}
