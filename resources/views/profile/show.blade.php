<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyResep Profile</title>
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
            <a href="/profile" class="hover:underline font-semibold text-green-800">{{ $user->username }}</a>
        </div>
    </nav>

    <!-- Profile Section -->
    <section class="bg-green-800 text-white py-6 px-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Profile Information</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-green-900 hover:bg-green-700 px-6 py-2 rounded-md">Logout</button>
        </form>
    </section>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="max-w-2xl mx-auto mt-6">
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Profile Content -->
    <section class="flex justify-center items-start px-6 py-12">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-12">
            <!-- Profile Image -->
            <div class="w-64 h-64 rounded-full overflow-hidden bg-gradient-to-br from-green-400 to-blue-500">
                <img 
                    src="{{ $user->foto_Profil ? asset('storage/' . $user->foto_Profil) : asset('images/user-icon.png') }}" 
                    alt="User Icon" 
                    class="w-full h-full object-cover"
                    onerror="this.src='/images/user-icon.png'; this.onerror='';"
                >
            </div>

            <!-- Profile Details -->
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        👤
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Username</p>
                        <p class="font-semibold">{{ $user->username }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        ID
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">MyResep ID</p>
                        <p class="font-semibold">MR-{{ str_pad($user->id_User, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        ✉️
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-semibold">{{ $user->email }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="bg-lime-300 p-3 rounded-full w-12 h-12 flex items-center justify-center text-xl">
                    ✒️
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bio</p>
                        <p class="font-semibold">{{ $user->bio ?? 'Belum diisi' }}</p>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="bg-green-800 text-white px-6 py-2 rounded-md mt-4 inline-block text-center">Edit</a>
            </div>
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