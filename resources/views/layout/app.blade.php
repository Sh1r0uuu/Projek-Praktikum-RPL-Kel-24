<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyResep</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-black">
    <nav class="flex justify-between items-center px-8 py-4 border-b">
        <div class="text-xl font-bold">MyResep</div>
        <div class="space-x-4">
            <a href="#" class="hover:underline">Beranda</a>
            <a href="#" class="hover:underline">Favorit</a>
            <a href="#" class="hover:underline">Sign In</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
