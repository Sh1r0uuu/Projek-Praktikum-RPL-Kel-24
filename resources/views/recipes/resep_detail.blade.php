<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans">

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

    <section class="bg-green-900 text-white text-center py-16 px-4">
        <h1 class="text-3xl font-bold mb-2">{{ $recipe->title }}</h1>
        <p class="text-sm mb-4">{{ $recipe->origin }} | {{ $recipe->category }}</p>
    </section>

    <section class="px-8 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4">Bahan-bahan</h2>
                @php
                    $ingredients = explode(',', $recipe->ingredients ?? '');
                @endphp

                @if (!empty($ingredients) && count(array_filter($ingredients)))
                    <ul class="list-disc pl-6">
                        @foreach ($ingredients as $ingredient)
                            <li>{{ trim($ingredient) }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Tidak ada bahan yang tersedia.</p>
                @endif

                <h2 class="text-xl font-semibold mt-6 mb-4">Langkah-langkah Memasak</h2>
                @php
                    $steps = preg_split('/\d+\.\s*/', $recipe->steps ?? '', -1, PREG_SPLIT_NO_EMPTY);
                @endphp

                @if (!empty($steps))
                    <ol class="list-decimal pl-6">
                        @foreach ($steps as $step)
                            <li>{{ trim($step) }}</li>
                        @endforeach
                    </ol>
                @else
                    <p class="text-gray-500 text-sm">Langkah memasak belum tersedia.</p>
                @endif
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4">Informasi</h2>
                <ul>
                    <li><strong>Waktu Masak:</strong> {{ $recipe->time ?? 'Tidak tersedia' }} menit</li>
                    <li><strong>Tingkat Kesulitan:</strong> {{ $recipe->difficulty ?? 'Tidak diketahui' }}</li>
                    <li><strong>Jenis Makanan:</strong> {{ $recipe->type ?? 'Tidak diketahui' }}</li>
                </ul>

                @if ($recipe->image)
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold mb-4">Gambar Resep</h2>
                        <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->title }}" class="h-full w-full object-cover">
                    </div>
                @else
                    <p class="text-gray-500 text-sm mt-4">Gambar tidak tersedia.</p>
                @endif
            </div>
        </div>
    </section>

    <footer class="border-t py-6 mt-10 text-sm text-center text-gray-500">
        <p class="mb-2">© 2025 MyResep</p>
        <div class="space-x-4">
            <a href="#" class="hover:underline">About Us</a>
            <a href="#" class="hover:underline">Contact</a>
        </div>
    </footer>

</body>
</html>
