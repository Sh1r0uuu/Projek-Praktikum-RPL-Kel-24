<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil - MyResep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar - Tetap sama -->
    <nav class="flex justify-between items-center px-8 py-4 border-b bg-white shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/myresep-logo.png') }}" alt="MyResep Logo" class="h-8">
            <span class="font-bold text-lg">MyResep</span>
        </div>
        <div class="flex items-center space-x-6 text-sm">
        @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Beranda</a>
        @else
            <a href="{{ route('user.dashboard') }}" class="hover:underline">Beranda</a>
        @endif

        @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('masakans.tambah') }}" class="hover:underline">Tambah Resep</a>
        @endif

        <a href="{{ route('favorites.index') }}" class="hover:underline">Favorit</a>
            <a href="/profile" class="hover:underline font-semibold text-green-800">{{ $user->username }}</a>
            
        </div>
    </nav>

    <!-- Profile Section - Hijau seperti di mockup -->
    <section class="bg-green-800 text-white py-6 px-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Profile Information</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-green-900 hover:bg-green-700 px-6 py-2 rounded-md">Logout</button>
        </form>
    </section>

    <!-- Form content -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="max-w-4xl mx-auto py-12 px-4">
        @csrf
        <div class="flex flex-col md:flex-row gap-12 items-start">
            <!-- Profile Image - Clickable untuk edit -->
            <div class="text-center">
                <div class="relative inline-block group">
                    <input type="file" name="foto_Profil" id="foto_Profil" class="hidden" onchange="showPreview(this)">
                    <label for="foto_Profil" class="cursor-pointer block">
                        <div class="w-64 h-64 rounded-full overflow-hidden bg-gradient-to-br from-green-400 to-blue-500 relative">
                            <img 
                                id="profilePreview"
                                src="{{ $user->foto_Profil ? asset('storage/' . $user->foto_Profil) : asset('images/user-icon.png') }}" 
                                alt="User Icon" 
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                <span class="text-white text-4xl">📷</span>
                            </div>
                        </div>
                    </label>
                    @error('foto_Profil')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Profile Details -->
            <div class="flex-1 space-y-6">
                <!-- Username -->
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        👤
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-1">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                            class="w-full px-4 py-3 border rounded-md bg-gray-100">
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- MyResep ID -->
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        ID
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-1">MyResep ID</label>
                        <input type="text" value="MR-{{ str_pad($user->id_User, 3, '0', STR_PAD_LEFT) }}" 
                            class="w-full px-4 py-3 border rounded-md bg-gray-100" disabled>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        ✉️
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 border rounded-md bg-gray-100">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Bio -->
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        ✒️
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-1">Bio</label>
                        <textarea name="bio" class="w-full px-4 py-3 border rounded-md bg-gray-100" rows="3">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4 mt-8">
                    <button type="submit" class="px-8 py-3 bg-green-800 text-white rounded-md hover:bg-green-700 w-40">
                        Simpan
                    </button>
                    <a href="{{ route('profile') }}" class="px-8 py-3 bg-green-900 text-white rounded-md hover:bg-green-800 text-center w-40">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <footer class="border-t py-6 mt-10 text-sm text-center text-gray-500">
        <p class="mb-2">© 2025 MyResep</p>
        <div class="space-x-4 mt-2">
        <a href="{{ route('about.us') }}" class="hover:underline">About us</a>
        <a href="https://linktr.ee/wavetobatis" target="_blank" rel="noopener noreferrer" class="hover:underline">Contact Us</a>
        </div>
    </footer>

    <script>
        function showPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>