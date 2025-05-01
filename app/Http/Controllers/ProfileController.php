<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio'   => 'nullable|string|max:500',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->bio   = $request->bio;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
