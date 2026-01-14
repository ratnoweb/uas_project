<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <aside class="w-64 bg-blue-900 text-white p-6">
            <h1 class="text-2xl font-bold mb-8 font-[Pacifico]">Lombok Admin</h1>
            <nav class="space-y-4">
                <a href="{{ route('dashboard.index') }}" class="block py-2 px-4 bg-blue-800 rounded">Dashboard Berita</a>
                <a href="{{ route('home') }}" target="_blank" class="block py-2 px-4 hover:bg-blue-800 rounded text-blue-200">Lihat Website</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left py-2 px-4 hover:bg-blue-800 rounded text-red-200">Logout</button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            
            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Kelola Berita ({{ $posts->total() }} Item)</h2>
                
                {{-- TOMBOL TAMBAH BERFUNGSI --}}
                <a href="{{ route('dashboard.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
                    <i class="ri-add-line mr-1"></i> Tambah Berita
                </a>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="p-4">Cover</th>
                            <th class="p-4">Judul</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Views</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                {{-- LOGIC TAMPILAN GAMBAR (Bisa link luar atau upload lokal) --}}
                                @if(\Illuminate\Support\Str::startsWith($post->image, 'http'))
                                    <img src="{{ $post->image }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <img src="{{ asset('storage/' . $post->image) }}" class="w-12 h-12 object-cover rounded">
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="font-medium text-gray-900 line-clamp-1 max-w-md">{{ $post->title }}</div>
                            </td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    {{ $post->category->name }}
                                </span>
                            </td>
                            <td class="p-4 text-sm text-gray-500">
                                {{ $post->views }}
                            </td>
                            <td class="p-4 flex gap-2">
                                {{-- TOMBOL EDIT --}}
                                <a href="{{ route('dashboard.edit', $post->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded">
                                    <i class="ri-edit-line"></i>
                                </a>
                                
                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('dashboard.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>