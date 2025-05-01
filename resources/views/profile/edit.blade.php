<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil - MyResep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-4 border-b bg-white shadow-sm">
        <div class="flex items-center space-x-2">
            <img src="/images/logo.png" alt="MyResep Logo" class="h-8">
            <span class="font-bold text-lg">MyResep</span>
        </div>
    </nav>

    <section class="max-w-xl mx-auto py-12 px-4">
        <h1 class="text-2xl font-bold mb-6">Edit Profil</h1>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Username</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-2 border rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium">MyResep ID</label>
                <input type="text" value="MR-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}" class="w-full px-4 py-2 border rounded-md bg-gray-100" disabled>
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 border rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium">Bio</label>
                <textarea name="bio" class="w-full px-4 py-2 border rounded-md" rows="4">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('profile') }}" class="px-4 py-2 border rounded-md">Batal</a>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-600">
                    Simpan
                </button>
            </div>
        </form>
    </section>

</body>
</html>
