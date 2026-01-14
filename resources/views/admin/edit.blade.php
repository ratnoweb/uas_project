<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold mb-6">Edit Berita</h2>
        
        {{-- Form mengarah ke route update dengan method PUT --}}
        <form action="{{ route('dashboard.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block font-medium mb-1">Judul Berita</label>
                <input type="text" name="title" value="{{ $post->title }}" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Kategori</label>
                <select name="category_id" class="w-full border p-2 rounded">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Ganti Gambar (Opsional)</label>
                <input type="file" name="image" class="w-full border p-2 rounded" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                
                {{-- Preview Gambar Lama --}}
                <div class="mt-2">
                    <p class="text-sm font-medium">Gambar Saat Ini:</p>
                    @if(\Illuminate\Support\Str::startsWith($post->image, 'http'))
                        <img src="{{ $post->image }}" class="h-32 rounded object-cover">
                    @else
                        <img src="{{ asset('storage/' . $post->image) }}" class="h-32 rounded object-cover">
                    @endif
                </div>
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">Isi Berita</label>
                {{-- Textarea menampilkan body lama --}}
                <textarea name="body" rows="15" class="w-full border p-2 rounded">{{ $post->body }}</textarea>
            </div>

            <div class="flex gap-6 mb-6">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_headline" class="w-5 h-5 text-blue-600 rounded" {{ $post->is_headline ? 'checked' : '' }}>
                    <span class="font-medium text-gray-700">Jadikan Headline</span>
                </label>
                
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_editor_choice" class="w-5 h-5 text-red-600 rounded" {{ $post->is_editor_choice ? 'checked' : '' }}>
                    <span class="font-medium text-gray-700">Pilihan Editor</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Berita</button>
                <a href="{{ route('dashboard.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>