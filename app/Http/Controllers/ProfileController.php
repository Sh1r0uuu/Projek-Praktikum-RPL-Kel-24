<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan profil user
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // Menampilkan form edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Menyimpan perubahan profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255',
            // Gunakan id_User sebagai primary key untuk validasi unique
            'email' => 'required|email|max:255|unique:users,email,' . $user->id_User . ',id_User',
            'bio' => 'nullable|string|max:500',
            'foto_Profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menangani upload foto profil
        if ($request->hasFile('foto_Profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_Profil) {
                Storage::delete('public/' . $user->foto_Profil);
            }
            
            // Simpan foto baru
            $path = $request->file('foto_Profil')->store('profile-images', 'public');
            $user->foto_Profil = $path;
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}