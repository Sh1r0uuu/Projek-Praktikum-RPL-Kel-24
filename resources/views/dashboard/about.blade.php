<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - MyResep</title>
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
            <a href="{{ route('user.dashboard') }}" class="hover:underline">Beranda</a>
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

    <!-- About Us Content Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0 pr-0 md:pr-8">
                    <h1 class="text-3xl font-bold mb-6">Tentang MyResep</h1>
                    <p class="mb-4">
                        MyResep adalah platform online yang menyediakan resep makanan yang lezat dan bermanfaat untuk semua orang. Kami hadir untuk memperluas keterampilan memasak Anda dan memberikan inspirasi dalam dunia kuliner.
                    </p>
                    <p class="mb-4">
                        Temukan berbagai resep, tips praktis, dan panduan langkah demi langkah di sini. Bergabunglah dengan komunitas kami yang aktif dan nikmati perjalanan memasak yang menyenangkan. Selamat memasak dan menciptakan hidangan lezat!
                    </p>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="text-center">
                    <img src="{{ asset('images/myresep-logo.png') }}" alt="MyResep Logo">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t py-6 mt-10 text-sm text-center text-gray-500">
        <p class="mb-2">© 2025 MyResep</p>
        <div class="space-x-4">
            <a href="{{ route('about.us') }}" class="hover:underline font-semibold text-green-800">About us</a>
            <a href="https://linktr.ee/wavetobatis" target="_blank" rel="noopener noreferrer" class="hover:underline">Contact Us</a>
        </div>
    </footer>

</body>
</html>