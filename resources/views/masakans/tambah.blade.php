<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Resep - MyResep</title>
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
    <a href="{{ route('masakans.tambah') }}" class="hover:underline">Tambah Resep</a>
    <a href="{{ route('favorites.index') }}" class="hover:underline">Favorit</a>
        <a href="{{ route('profile') }}" class="hover:underline">Profil</a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="hover:underline">Logout</button>
        </form>
    </div>
</nav>

<!-- Main Content -->
<div class="max-w-6xl mx-auto p-6">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Header & Form Container -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
        <!-- Kiri: Header -->
        <section>
            <div class="flex items-center space-x-2 mb-4">
                <h1 class="text-2xl font-bold mb">Tambahkan Menu Resep Baru</h1>
            </div>
            <p class="text-sm text-gray-700">Isi kolom-kolom berikut untuk menambahkan resep baru</p>
            <div class="flex items-center space-x-2 mt-40">
                <h2 class="text-lg font-bold mb-2">Isi Data Resep</h2>
            </div>
        </section>

        <!-- Kanan: Preview + Form -->
        <section class="bg-gray-50 rounded p-4 flex flex-col gap-6">
            <!-- Preview Gambar -->
            <div class="bg-gray-200 rounded h-44 flex items-center justify-center">
                <div id="image-preview">
                    <p class="text-gray-500 text-sm text-center">Preview gambar akan muncul di sini</p>
                </div>
            </div>

            <!-- Form Start -->
            <form action="{{ route('masakans.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                @csrf

                <!-- Input Gambar -->
                <div>
                    <label for="gambar_Masakan" class="block text-xs font-semibold mb-1">Gambar</label>
                    <input type="text" id="gambar_Masakan" name="gambar_Masakan" value="{{ old('gambar_Masakan') }}" placeholder="URL gambar"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-green-700" />
                    <p class="text-xs text-gray-500 mt-1">Pastikan gambar berukuran 500x500 pixels</p>
                    @error('gambar_Masakan')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Judul -->
                <div>
                    <label for="nama_Masakan" class="block text-xs font-semibold mb-1">Judul</label>
                    <input type="text" id="nama_Masakan" name="nama_Masakan" value="{{ old('nama_Masakan') }}" placeholder="Judul resep" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-green-700" />
                    @error('nama_Masakan')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Kategori -->
                <div class="relative">
                    <label for="kategori_Masakan" class="block text-xs font-semibold mb-1">Kategori</label>
                    <select id="kategori_Masakan" name="kategori_Masakan" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-green-700">
                        <option value="" {{ old('kategori_Masakan') ? '' : 'selected' }}>Pilih kategori resep</option>
                        <option value="pembuka" {{ old('kategori_Masakan') == 'pembuka' ? 'selected' : '' }}>Pembuka</option>
                        <option value="utama" {{ old('kategori_Masakan') == 'utama' ? 'selected' : '' }}>Utama</option>
                        <option value="penutup" {{ old('kategori_Masakan') == 'penutup' ? 'selected' : '' }}>Penutup</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    @error('kategori_Masakan')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi_Resep" class="block text-xs font-semibold mb-1">Deskripsi</label>
                    <textarea id="deskripsi_Resep" name="deskripsi_Resep" rows="3" placeholder="Deskripsi resep" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-green-700">{{ old('deskripsi_Resep') }}</textarea>
                    @error('deskripsi_Resep')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alat dan Bahan -->
                <div>
                    <label for="bahan_Memasak" class="block text-xs font-semibold mb-1">Alat dan Bahan</label>
                    <textarea id="bahan_Memasak" name="bahan_Memasak" rows="6" placeholder="Tuliskan alat dan bahan yang diperlukan" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-green-700">{{ old('bahan_Memasak') }}</textarea>
                    @error('bahan_Memasak')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Langkah-langkah -->
                <div>
                    <label for="detail_Resep" class="block text-xs font-semibold mb-1">Langkah-langkah</label>
                    <textarea id="detail_Resep" name="detail_Resep" rows="8" placeholder="Tuliskan langkah-langkah membuat resep" required 
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-green-700">{{ old('detail_Resep') }}</textarea>
                    @error('detail_Resep')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 mt-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex-1 border border-gray-700 rounded px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-100 text-center">Batal</a>
                    <button type="submit" class="flex-1 bg-green-900 hover:bg-green-800 text-white rounded px-4 py-2 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-green-700">Simpan Resep</button>
                </div>
            </form>
        </section>
    </div>
</div>

<!-- Footer - Sekarang berada di luar container dan terpusat -->
<footer class="border-t py-6 mt-10 text-sm text-center text-gray-500 w-full">
    <p class="mb-2">© 2025 MyResep</p>
    <div class="space-x-4">
        <a href="{{ route('about.us') }}" class="hover:underline">About us</a>
        <a href="https://linktr.ee/wavetobatis" target="_blank" rel="noopener noreferrer" class="hover:underline">Contact Us</a>
    </div>
</footer>

<script>
    document.getElementById('gambar_Masakan').addEventListener('input', function() {
        const imageUrl = this.value;
        const previewArea = document.getElementById('image-preview');
        
        if (imageUrl) {
            previewArea.innerHTML = `<img src="${imageUrl}" alt="Preview" class="max-h-44 max-w-full object-contain" onerror="this.onerror=null;this.src='';this.alt='Gambar tidak dapat dimuat';this.parentNode.innerHTML='<p class=\'text-red-500 text-sm\'>URL gambar tidak valid</p>';">`;
        } else {
            previewArea.innerHTML = `<p class="text-gray-500 text-sm">Preview gambar akan muncul di sini</p>`;
        }
    });
</script>

</body>
</html>