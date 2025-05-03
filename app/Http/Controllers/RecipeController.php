<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Tampilkan semua resep di halaman user dashboard.
     */
    public function index()
    {
        $recipes = Recipe::latest()->get(); // Ambil semua resep terbaru
        return view('user', compact('recipes')); // Mengarah ke user.blade.php
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

        return redirect()->route('user.dashboard')->with('success', 'Resep berhasil ditambahkan!');
    }

    /**
     * Pencarian resep berdasarkan kata kunci.
     */
    public function searchRecipes(Request $request)
    {
        $query = $request->input('query');
        $recipes = Recipe::where('title', 'LIKE', "%{$query}%")
                         ->orWhere('type', 'LIKE', "%{$query}%")
                         ->orWhere('origin', 'LIKE', "%{$query}%")
                         ->get();

        return view('dashboard.user', compact('recipes'));

    }
    public function filterByCategory($category)
{
    $recipes = Recipe::where('category', $category)->get();
    return view('dashboard.user', compact('recipes'));
}

public function show($id)
{
    // Ambil data resep berdasarkan ID
    $recipe = Recipe::findOrFail($id);

    // Kirim data ke view
    return view('recipes.resep_detail', compact('recipe'));
}






public function up()
{
    Schema::table('recipes', function (Blueprint $table) {
        $table->text('ingredients')->nullable();
        $table->text('steps')->nullable();
        $table->string('difficulty')->nullable();
    });
}

public function showRecipes()
{
    $recipes = DB::table('recipes')->get(); // Mengambil data dari tabel 'recipes'
    return view('recipes.index', compact('recipes')); // Menyampaikan data ke view
}


}
