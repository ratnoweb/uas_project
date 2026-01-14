<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; // Jangan lupa use ini
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Coba cari berita yang KHUSUS diset sebagai Headline
        $heroPost = Post::active()->where('is_headline', true)->latest()->first();

        // 2. [LOGIC BARU] Jika tidak ada Headline, AMBIL SAJA berita terbaru apapun
        // Supaya Banner tidak pernah hilang
        if (!$heroPost) {
            $heroPost = Post::active()->latest()->first();
        }

        // 3. Ambil Editor Choice (kecuali yang sedang jadi hero)
        $editorChoices = Post::active()
                            ->where('is_editor_choice', true)
                            ->when($heroPost, function($query) use ($heroPost) {
                                $query->where('id', '!=', $heroPost->id);
                            })
                            ->take(5)
                            ->get();

        // 4. Berita Terbaru (kecuali yang sedang jadi hero)
        $latestPosts = Post::active()
                            ->when($heroPost, function($query) use ($heroPost) {
                                $query->where('id', '!=', $heroPost->id);
                            })
                            ->latest()
                            ->paginate(12);

        return view('home', compact('heroPost', 'editorChoices', 'latestPosts'));
    }

    // METHOD BARU: Untuk Baca Berita
    public function show(Post $post)
    {
        // 1. Tambah jumlah views +1 setiap kali halaman dibuka
        $post->increment('views'); 
        
        // 2. Tampilkan halaman
        return view('posts.show', compact('post'));
    }

    // METHOD BARU: Untuk Halaman Kategori
    // Method untuk Halaman Kategori
    public function category(Category $category)
    {
        // 1. Ambil Headline KHUSUS untuk kategori ini sebagai Banner
        $heroPost = $category->posts()
                             ->active()
                             ->where('is_headline', true)
                             ->latest()
                             ->first();

        // Fallback: Jika kategori ini tidak punya headline, ambil berita terbarunya saja sebagai banner
        if (!$heroPost) {
            $heroPost = $category->posts()
                                 ->active()
                                 ->latest()
                                 ->first();
        }

        // 2. Ambil list berita sisanya (Kecuali yang sudah dipajang di banner)
        $posts = $category->posts()
                          ->active()
                          ->latest()
                          ->paginate(12);

        // 3. Kirim data ke View (jangan lupa kirim $heroPost)
        return view('categories.show', compact('category', 'posts', 'heroPost'));
    }

    // 1. Logika Newsletter
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        // Disini bisa ditambah logika simpan ke database jika mau
        // Untuk sekarang, kita kembalikan pesan sukses saja
        return back()->with('success', 'Terima kasih! Email ' . $request->email . ' berhasil didaftarkan ke Newsletter.');
    }

    // 2. Logika Halaman Statis (Tentang Kami, Kontak, dll)
    // GANTI METHOD page() DENGAN INI:
    public function page($slug)
    {
        $pages = [
            'tentang-kami' => [
                'title' => 'Tentang Kami',
                'content' => 'Lombok News adalah portal berita terdepan yang didedikasikan untuk menyajikan informasi terkini, akurat, dan terpercaya seputar Nusa Tenggara Barat. Berdiri sejak 2024, kami berkomitmen mengangkat potensi lokal ke kancah nasional.'
            ],
            // --- BAGIAN YANG DIEDIT ---
            'tim-redaksi' => [
                'title' => 'Tim Redaksi',
                'content' => '
                    <strong>Pemimpin Redaksi:</strong><br> Ratno Juliono<br><br>
                    <strong>Redaktur Pelaksana:</strong><br> Edwin Adriansyah<br><br>
                    <strong>Editor Senior:</strong><br> Hayaza Warizkan<br><br>
                    <strong>Reporter:</strong><br> Abrar Duya Ratu Loli
                '
            ],
            // ---------------------------
            'kontak' => [
                'title' => 'Hubungi Kami',
                'content' => 'Alamat: Jl. Pejanggik No. 123, Mataram.<br>Email: redaksi@lomboknews.id<br>Telepon: (0370) 123-4567'
            ],
            'karir' => [
                'title' => 'Karir',
                'content' => 'Belum ada lowongan dibuka saat ini. Silakan cek kembali nanti.'
            ],
            'kebijakan-privasi' => [
                'title' => 'Kebijakan Privasi',
                'content' => 'Kami menghargai privasi Anda. Data yang dikumpulkan hanya digunakan untuk keperluan peningkatan layanan website.'
            ],
            'syarat-ketentuan' => [
                'title' => 'Syarat & Ketentuan',
                'content' => 'Dengan mengakses website ini, Anda menyetujui seluruh aturan yang berlaku dalam penggunaan konten digital.'
            ],
        ];

        if (!array_key_exists($slug, $pages)) {
            return redirect()->route('home');
        }

        $data = $pages[$slug];
        return view('pages.generic', compact('data'));
    }
    // --- FITUR PENCARIAN ---
    public function search(Request $request)
    {
        // Ambil kata kunci dari input 'q' (query)
        $query = $request->input('q');

        // Jika kosong, kembalikan ke home
        if (!$query) {
            return redirect()->route('home');
        }

        // Cari berita yang Judulnya ATAU Isinya mengandung kata kunci
        $posts = Post::active()
                    ->where(function($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('body', 'like', "%{$query}%");
                    })
                    ->latest()
                    ->paginate(12); // Tampilkan 12 hasil per halaman

        // Kirim hasil ke view baru (search.blade.php)
        return view('search', compact('posts', 'query'));
    }
}