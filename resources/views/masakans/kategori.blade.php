<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyResep Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans">
    
    <!-- Navbar -->
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
        <a href="{{ route('favorites.index') }}" class="hover:underline">Favorit</a>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('masakans.tambah') }}" class="hover:underline">Tambah Resep</a>
        @endif
        
            @auth
                <a href="{{ route('profile') }}" class="hover:underline">Profil</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline font-semibold text-green-800">Sign in</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-green-900 text-white text-center py-12 px-4">
        <h1 class="text-3xl font-bold mb-2">{{ $kategoriLabel }}</h1>
    </section>

    <section class="px-6 py-8">
    <h2 class="text-xl font-bold mb-6">Resep Terbaru</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($masakans as $masakan)
            <div class="relative">
        
                         <!-- Edit button - positioned at top left (admin only) -->
@if(auth()->check() && auth()->user()->role === 'admin')
    <div class="absolute top-2 left-2 z-10">
        <a href="{{ route('masakans.edit', $masakan->id_Masakan) }}" class="bg-white rounded-full p-2 shadow-md hover:bg-gray-100 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </a>
    </div>
@endif
                <!-- Bookmark button - positioned at top right -->
                @auth
                    <div class="absolute top-2 right-2 z-10">
                        @php
                            $isFavorite = App\Models\Simpan::where('id_User', auth()->id())
                                ->where('id_Masakan', $masakan->id_Masakan)
                                ->exists();
                        @endphp
                        
                        @if($isFavorite)
                            <form action="{{ route('favorites.remove', $masakan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-white rounded-full p-2 shadow hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-900">
                                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0111.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 01-1.085.67L12 18.089l-7.165 3.583A.75.75 0 013.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favorites.add', $masakan) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-white rounded-full p-2 shadow hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 hover:text-green-900">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                @endauth
                
                <a href="{{ route('masakans.show', $masakan) }}" class="block border rounded-md shadow-sm overflow-hidden hover:shadow-md transition duration-200">
                    <div class="bg-gray-200 h-40 flex justify-center items-center text-gray-600 text-sm">
                        @if ($masakan->gambar_Masakan)
                            @if (filter_var($masakan->gambar_Masakan, FILTER_VALIDATE_URL))
                                <img src="{{ $masakan->gambar_Masakan }}" alt="{{ $masakan->nama_Masakan }}" class="h-full w-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . $masakan->gambar_Masakan) }}" alt="{{ $masakan->nama_Masakan }}" class="h-full w-full object-cover">
                            @endif
                        @else
                            Gambar tidak tersedia
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-md font-semibold">{{ $masakan->nama_Masakan }}</h3>
                        <p class="text-sm text-gray-600">Masakan {{ ucfirst($masakan->kategori_Masakan) }}</p>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-center text-sm text-gray-500 col-span-3">Belum ada resep tersedia.</p>
        @endforelse
    </div>
</section>









     
    <!-- Footer -->
    <footer class="border-t py-6 mt-10 text-sm text-center text-gray-500">
        <p class="mb-2">© 2025 MyResep</p>
        <div class="space-x-4">
        <a href="{{ route('about.us') }}" class="hover:underline">About us</a>
        <a href="https://linktr.ee/wavetobatis" target="_blank" rel="noopener noreferrer" class="hover:underline">Contact Us</a>
        </div>
    </footer>

</body>
</html>