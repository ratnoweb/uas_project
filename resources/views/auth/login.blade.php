<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin - Lombok News</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-900">Admin Login</h2>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="admin@lomboknews.com" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" value="password" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded hover:bg-blue-800">Masuk Dashboard</button>
        </form>
        <a href="{{ route('home') }}" class="block text-center mt-4 text-sm text-gray-500">Kembali ke Beranda</a>
    </div>
</body>
</html>