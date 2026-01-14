<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Berita Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold mb-6">Tambah Berita Baru</h2>
        
        <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block font-medium mb-1">Judul Berita</label>
                <input type="text" name="title" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Kategori</label>
                <select name="category_id" class="w-full border p-2 rounded">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Gambar Utama</label>
                <input type="file" name="image" class="w-full border p-2 rounded" accept="image/*" required>
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">Isi Berita</label>
                <textarea name="body" rows="10" class="w-full border p-2 rounded" placeholder="Tulis isi berita di sini..."></textarea>
            </div>

            <div class="flex gap-6 mb-6">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_headline" class="w-5 h-5 text-blue-600 rounded">
                    <span class="font-medium text-gray-700">Jadikan Headline (Banner Atas)</span>
                </label>
                
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_editor_choice" class="w-5 h-5 text-red-600 rounded">
                    <span class="font-medium text-gray-700">Pilihan Editor</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Berita</button>
                <a href="{{ route('dashboard.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>