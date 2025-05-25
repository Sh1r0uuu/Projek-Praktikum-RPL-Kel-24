<?php

namespace App\Http\Controllers;

use App\Models\Masakan;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Simpan;

class MasakanController extends Controller
{
    /**
     * Tampilkan semua resep di halaman dashboard.
     */
    public function index()
    {
        $masakans = Masakan::latest()->get(); // Ambil semua resep terbaru
        return view('dashboard', compact('masakans'));
    }

    /**
     * Tampilkan form untuk menambah resep (opsional).
     */
    public function create() {
        Log::info('Masuk fungsi create di MasakanController');
        // atau kamu bisa log data variable, misal:
        Log::debug('User ID: ' . auth()->id());
    
        return view('masakans.tambah');
    }
    

public function kategori($kategori)
{
    // Validasi kategori
    if (!in_array($kategori, ['pembuka', 'utama', 'penutup'])) {
        abort(404);
    }
    
    // Ambil semua resep dengan kategori yang dipilih
    $masakans = Masakan::where('kategori_Masakan', $kategori)
        ->latest()
        ->paginate(6); // Tampilkan 6 item per halaman
    
    // Ubah label kategori menjadi format yang lebih baik
    $kategoriLabel = match($kategori) {
        'pembuka' => 'Makanan Pembuka',
        'utama' => 'Makanan Utama',
        'penutup' => 'Makanan Penutup',
        default => $kategori
    };
    
    return view('masakans.kategori', compact('masakans', 'kategori', 'kategoriLabel'));
}

    /**
     * Simpan resep baru ke database (opsional).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_Masakan' => 'required|string|max:255',
            'gambar_Masakan' => 'required|string',
            'deskripsi_Resep' => 'required|string',
            'bahan_Memasak' => 'required|string',
            'detail_Resep' => 'required|string',
            'kategori_Masakan' => ['required', Rule::in(['pembuka', 'utama', 'penutup'])],
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar_Masakan')) {
            $imagePath = $request->file('image')->store('gambar_Masakan', 'public');
        }

        Masakan::create([
            'nama_Masakan' => $request->nama_Masakan,
            'gambar_Masakan' => $request->gambar_Masakan,
            'deskripsi_Resep' => $request->deskripsi_Resep,
            'bahan_Memasak' => $request->bahan_Memasak,
            'detail_Resep' => $request->detail_Resep,
            'kategori_Masakan' => $request->kategori_Masakan,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Resep berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail resep.
     */
    public function show(Masakan $masakan)
{
    // Ambil ulasan yang terkait dengan resep ini
    $ulasans = $masakan->ulasans()->latest()->get();
    
    // Cek apakah masakan sudah ada di favorit user
    $isFavorite = auth()->check() ? 
        Simpan::where('id_User', auth()->id())
            ->where('id_Masakan', $masakan->id_Masakan)
            ->exists() : 
        false;
    
    return view('masakans.show', compact('masakan', 'ulasans', 'isFavorite'));
}

public function storeUlasan(Request $request, Masakan $masakan)
{
    $request->validate([
        'isi_Ulasan' => 'required|string',
    ]);

    // Simpan ulasan terkait resep
    $masakan->ulasans()->create([
        'id_User' => auth()->id(), // Menggunakan ID user yang sedang login
        'isi_Ulasan' => $request->isi_Ulasan,
    ]);

    return back()->with('success', 'Ulasan berhasil ditambahkan!');
}


    /**
     * Tampilkan form untuk mengedit resep.
     */
    public function edit(Masakan $masakan)
    {
        return view('masakans.edit', compact('masakan'));
    }

    /**
     * Update resep di database.
     */
    public function update(Request $request, Masakan $masakan)
    {
        $request->validate([
            'nama_Masakan' => 'required|string|max:255',
            'gambar_Masakan' => 'required|string',
            'deskripsi_Resep' => 'required|string',
            'bahan_Memasak' => 'required|string',
            'detail_Resep' => 'required|string',
            'kategori_Masakan' => ['required', Rule::in(['pembuka', 'utama', 'penutup'])],
        ]);

        $masakan->update([
            'nama_Masakan' => $request->nama_Masakan,
            'gambar_Masakan' => $request->gambar_Masakan,
            'deskripsi_Resep' => $request->deskripsi_Resep,
            'bahan_Memasak' => $request->bahan_Memasak,
            'detail_Resep' => $request->detail_Resep,
            'kategori_Masakan' => $request->kategori_Masakan,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Resep berhasil diperbarui!');
    }

    /**
     * Hapus resep dari database.
     */
    public function destroy(Masakan $masakan)
    {
        $masakan->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Resep berhasil dihapus!');
    }

    /**
     * Tampilkan hasil pencarian resep.
     */
    public function search(Request $request)
    {
        $searchQuery = $request->query('query');
        
        $masakans = Masakan::where('nama_Masakan', 'like', "%{$searchQuery}%")
                    ->orWhere('deskripsi_Resep', 'like', "%{$searchQuery}%")
                    ->latest()
                    ->get();
        
        return view('masakans.search-results', compact('masakans', 'searchQuery'));
    }
    
    
    /**
     * Tampilkan resep favorit.
     */
    public function favorites()
    {
        // Logic to display favorite recipes
        // This is a placeholder and would need to be implemented based on your application's requirements
        return view('masakans.favorites');
    }
}