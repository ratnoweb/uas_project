<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // 1. TAMPILKAN LIST BERITA
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.dashboard', compact('posts'));
    }

    // 2. FORM TAMBAH BERITA
    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    // 3. PROSES SIMPAN BERITA BARU
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi Gambar
        ]);

        // Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke folder: storage/app/public/posts
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'excerpt' => Str::limit(strip_tags($request->body), 150),
            'body' => $request->body,
            'image' => $imagePath, // Simpan path gambarnya
            'views' => 0,
            'is_headline' => $request->has('is_headline'),
            'is_editor_choice' => $request->has('is_editor_choice'),
            'published_at' => now(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    // 4. FORM EDIT BERITA
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit', compact('post', 'categories'));
    }

    // 5. PROSES UPDATE BERITA
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Nullable: gak wajib ganti gambar
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'excerpt' => Str::limit(strip_tags($request->body), 150),
            'is_headline' => $request->has('is_headline'),
            'is_editor_choice' => $request->has('is_editor_choice'),
        ];

        // Cek apakah user upload gambar baru?
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika bukan link dari internet (picsum)
            if ($post->image && !Str::startsWith($post->image, 'http')) {
                Storage::disk('public')->delete($post->image);
            }
            
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Berita berhasil diupdate!');
    }

    // 6. HAPUS BERITA
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Hapus gambar dari penyimpanan
        if ($post->image && !Str::startsWith($post->image, 'http')) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('dashboard.index')->with('success', 'Berita berhasil dihapus!');
    }
}