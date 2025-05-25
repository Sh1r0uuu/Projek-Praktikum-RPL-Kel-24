<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masakan;
use App\Models\Simpan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class FavoritesController extends Controller
{
    /**
     * Hanya user yang login yang bisa akses semua method di controller ini
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan daftar resep favorit user yang sedang login
     */
    public function index()
    {
        $userId = auth()->id();

        // Ambil semua masakan yang difavoritkan user
        $favoriteRecipes = Masakan::whereHas('simpans', function ($query) use ($userId) {
            $query->where('id_User', $userId);
        })->latest()->paginate(6);

        return view('masakans.favorites', compact('favoriteRecipes'));
    }

    /**
     * Tambahkan resep ke favorit user
     */
    public function addToFavorites(Masakan $masakan)
    {
        $userId = auth()->id();

        $alreadyFavorite = Simpan::where('id_User', $userId)
                                 ->where('id_Masakan', $masakan->id_Masakan)
                                 ->exists();

        if ($alreadyFavorite) {
            return back()->with('info', 'Resep ini sudah ada di daftar favorit Anda.');
        }

        Simpan::create([
            'id_User' => $userId,
            'id_Masakan' => $masakan->id_Masakan
        ]);

        return back()->with('success', 'Resep berhasil ditambahkan ke favorit!');
    }

    /**
     * Hapus resep dari daftar favorit user
     */
    public function removeFromFavorites(Masakan $masakan)
    {
        $userId = auth()->id();

        $deleted = Simpan::where('id_User', $userId)
                         ->where('id_Masakan', $masakan->id_Masakan)
                         ->delete();

        if ($deleted) {
            return back()->with('success', 'Resep berhasil dihapus dari favorit.');
        }

        return back()->with('error', 'Resep tidak ditemukan di daftar favorit Anda.');
    }

    /**
     * Cek apakah suatu resep sudah menjadi favorit user
     */
    public function checkFavorite(Request $request, Masakan $masakan)
    {
        $isFavorite = Simpan::where('id_User', auth()->id())
                            ->where('id_Masakan', $masakan->id_Masakan)
                            ->exists();

        return response()->json(['isFavorite' => $isFavorite]);
    }
}
