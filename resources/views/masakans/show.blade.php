<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $masakan->nama_Masakan }} - MyResep</title>
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

        @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('masakans.tambah') }}" class="hover:underline">Tambah Resep</a>
        @endif
        <a href="{{ route('favorites.index') }}" class="hover:underline">Favorit</a>
            
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

    <!--Edit Button(Admin Onlu)-->
    <div class="max-w-5xl mx-auto pt-4 px-6">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="flex space-x-2">
                <a href="{{ route('masakans.edit', $masakan->id_Masakan) }}" 
                   class="inline-block bg-green-300 text-black font-medium px-4 py-2 rounded hover:bg-green-500 transition">
                    Edit Resep
                </a>
                <form action="{{ route('masakans.destroy', $masakan->id_Masakan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus resep ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-300 text-black font-medium px-4 py-2 rounded hover:bg-red-500 transition">
                        Hapus Resep
                    </button>
                </form>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="max-w-5xl mx-auto py-10 px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:space-x-10 mb-10">
            <div class="md:w-1/2 mt-6 md:mt-0">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-3xl font-bold">{{ $masakan->nama_Masakan }}</h1>
                    
                    <!-- Save Button -->
                    @auth
                        @php
                            $isFavorite = App\Models\Simpan::where('id_User', auth()->id())
                                ->where('id_Masakan', $masakan->id_Masakan)
                                ->exists();
                        @endphp
                        
                        @if($isFavorite)
                            <form action="{{ route('favorites.remove', $masakan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-white rounded p-2 shadow hover:bg-gray-100 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-900 mr-1">
                                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0111.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 01-1.085.67L12 18.089l-7.165 3.583A.75.75 0 013.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favorites.add', $masakan) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-white rounded p-2 shadow hover:bg-gray-100 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 hover:text-green-900 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
                <span class="text-sm inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full mb-4 capitalize">{{ $masakan->kategori_Masakan }}</span>
                <p class="text-gray-700 text-sm mb-4">{{ $masakan->deskripsi_Resep }}</p>
            </div>  
            <div class="md:w-1/2">
                <img src="{{ $masakan->gambar_Masakan }}" alt="Gambar {{ $masakan->nama_Masakan }}" class="rounded-lg shadow max-h-[350px] w-full object-cover">
            </div>
        </div>

        <!-- Detail Resep -->
        <div class="flex flex-col md:flex-row gap-6 mb-10">
            <div class="w-full md:w-1/2 mb-5">
                <h2 class="text-xl font-semibold mb-2">Bahan-Bahan</h2>
                <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-left leading-loose whitespace-pre-line">
                    {{ $masakan->bahan_Memasak }}
                </div>
            </div>  

            <div class="w-full md:w-1/2 mb-5">
                <h2 class="text-xl font-semibold mb-2">Cara Membuat</h2>
                <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-left leading-loose whitespace-pre-line">
                    {{ ($masakan->detail_Resep) }}
                </div>
            </div>
        </div>

       <!-- Ulasan / Reviews -->         
<div class="mt-10">             
    <h2 class="text-2xl font-semibold mb-4">Ulasan</h2>                          
    @foreach($masakan->ulasans as $ulasan)                 
        <div class="bg-gray-100 p-4 mb-6 rounded-lg shadow-sm">                     
            <div class="flex items-center justify-between mb-3">                         
                <div class="flex items-center">
                    <img src="{{ asset('storage/'.$ulasan->user->foto_Profil) }}" alt="{{ $ulasan->user->username }}" class="w-12 h-12 rounded-full mr-4">                         
                    <span class="font-semibold text-lg">{{ $ulasan->user->username }}</span>
                </div>
                <!-- Tombol hapus - hanya ditampilkan untuk pemilik ulasan atau admin -->
                @if(Auth::check() && (Auth::user()->id_User == $ulasan->id_User || Auth::user()->role == 'admin'))
                <form action="{{ route('ulasans.destroy', $ulasan->id_Ulasan) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
                @endif
            </div>                     
            <p class="text-gray-700 text-sm">{{ $ulasan->isi_Ulasan }}</p>                 
        </div>             
    @endforeach

            <!-- Add a new review -->
            @auth
                <div class="mt-6">
                    <form action="{{ route('ulasans.store', $masakan->id_Masakan) }}" method="POST">
                        @csrf
                        <div class="flex items-start">
                            <img src="{{ asset('storage/'.Auth::user()->foto_Profil) }}" alt="{{ Auth::user()->username }}" class="w-12 h-12 rounded-full mr-4">
                            
                            <div class="relative flex-1">
                                <textarea name="isi_Ulasan" rows="4" class="w-full border border-gray-300 rounded p-3" placeholder="Tulis ulasan Anda..."></textarea>
                                <button type="submit" class="absolute right-3 bottom-3 text-black hover:text-gray-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <p class="text-sm text-gray-500 mt-4">Silakan <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> untuk menulis ulasan.</p>
            @endauth
        </div>
    </div>

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