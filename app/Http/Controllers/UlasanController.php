<?php
namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Masakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request, $idMasakan)
{
    $request->validate([
        'isi_Ulasan' => 'required|string|max:1000',
    ]);

    // Pastikan pengguna sudah login sebelum menambahkan ulasan
    if (!auth()->check()) {
        return back()->with('error', 'Anda harus login terlebih dahulu!');
    }

    Ulasan::create([
        'id_Masakan' => $idMasakan, // Pastikan idMasakan diteruskan ke sini
        'id_User' => auth()->user()->id_User, // Ambil id_User dari pengguna yang login
        'isi_Ulasan' => $request->isi_Ulasan,
    ]);
    
    return back()->with('success', 'Ulasan berhasil ditambahkan!');
}
public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $user = auth()->user();

        // Cek apakah pengguna yang login adalah pemilik ulasan atau admin
        if ($user->id_User == $ulasan->id_User || $user->role == 'admin') {
            $ulasan->delete();
            return back()->with('success', 'Ulasan berhasil dihapus!');
        }

        return back()->with('error', 'Anda tidak memiliki izin untuk menghapus ulasan ini!');
    }
}
