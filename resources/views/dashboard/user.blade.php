<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover delicious food recipes, including main dishes and desserts. Explore a variety of recipes, perfect for every occasion.">
    <title>MyResep Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-4 border-b bg-white shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="/images/myresep-logo.png" alt="MyResep Logo" class="h-8">
            <span class="font-bold text-lg">MyResep</span>
        </div>
        <div class="flex items-center space-x-6 text-sm">
            <a href="{{ route('user.dashboard') }}" class="hover:underline">Beranda</a>
            <a href="#" class="hover:underline">Favorit</a>
            <a href="{{ route('profile') }}" class="hover:underline">User</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-green-900 text-white text-center py-12 px-4">
        <h1 class="text-3xl font-bold mb-2">Discover Delicious Recipes</h1>
        <p class="text-sm mb-4">Explore a wide range of amazing dishes or search for medicine-related recipes</p>
        <form action="{{ route('search.recipes') }}" method="GET">
            <input type="text" name="query" placeholder="Cari Resep" class="px-4 py-2 rounded-md text-black w-64">
            <button type="submit" class="bg-green-800 hover:bg-green-700 px-4 py-2 ml-2 rounded-md">Cari</button>
        </form>
    </section>

    <!-- Kategori -->
    <section class="text-center py-10">
    <h2 class="text-2xl font-semibold mb-6">Kategori</h2>
    <div class="flex flex-wrap justify-center gap-12">
        <div>
            <a href="{{ route('recipes.category', ['category' => 'Makanan Pembuka']) }}">
                <img src="/images/kategori-pembuka.png" alt="" class="h-16 mx-auto mb-2">
                <p class="text-xl font-medium">Makanan Pembuka</p>
            </a>
        </div>
        <div>
            <a href="{{ route('recipes.category', ['category' => 'Makanan Utama']) }}">
                <img src="/images/kategori-utama.png" alt="" class="h-16 mx-auto mb-2">
                <p class="text-xl font-medium">Makanan Utama</p>
            </a>
        </div>
        <div>
            <a href="{{ route('recipes.category', ['category' => 'Makanan Penutup']) }}">
                <img src="/images/kategori-penutup.png" alt="" class="h-16 mx-auto mb-2">
                <p class="text-xl font-medium">Makanan Penutup</p>
            </a>
        </div>
    </div>
</section>


    <!-- Resep Terbaru -->
    <section class="px-6 py-8">
        <h2 class="text-xl font-bold mb-6">Resep Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($recipes as $recipe)
            <div class="border rounded-md shadow-sm overflow-hidden">
                <div class="bg-gray-200 h-40 flex justify-center items-center text-gray-600 text-sm">
                    @if ($recipe->image)
                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->title }}" class="h-full w-full object-cover">
                    @else
                    Gambar tidak tersedia
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-xs text-gray-500 font-medium mb-1">{{ $recipe->origin }}</p>
                    <h3 class="text-md font-semibold">
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="hover:underline">
                            {{ $recipe->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600">{{ $recipe->type }}</p>
                </div>
            </div>
            @empty
            <p class="text-center text-sm text-gray-500 col-span-3">Tidak ada resep yang ditemukan.</p>
            @endforelse
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t py-6 mt-10 text-sm text-center text-gray-500">
        <p class="mb-2">© 2025 MyResep</p>
        <div class="space-x-4">
            <a href="#" class="hover:underline">About us</a>
            <a href="#" class="hover:underline">Contact Us</a>
        </div>
    </footer>

</body>

</html>
