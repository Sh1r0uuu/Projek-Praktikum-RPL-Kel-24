<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - MyResep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <nav class="bg-white px-6 py-4 shadow flex justify-between items-center">
        <div class="font-bold text-lg">Admin Panel - MyResep</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-600 hover:underline text-sm">Logout</button>
        </form>
    </nav>

    <main class="p-6">
        <h1 class="text-2xl font-bold mb-4">Selamat datang, Admin!</h1>
        <p class="text-gray-600 mb-6">Kelola data resep, pengguna, dan konten lainnya di sini.</p>

        <!-- Tambahkan konten admin seperti manajemen user/resep -->
        <div class="bg-white p-4 rounded shadow">
            <p>Statistik, data resep, tombol aksi, dsb bisa diletakkan di sini.</p>
        </div>
    </main>

</body>
</html>
