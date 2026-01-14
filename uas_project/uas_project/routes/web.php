<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Bisa diakses siapa saja) ---

// 1. Halaman Depan (Home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Baca Berita (Detail Post)
Route::get('/read/{post:slug}', [HomeController::class, 'show'])->name('posts.show');

// 3. Filter Kategori (News, Politik, Olahraga, dll)
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('categories.show');

// 4. Halaman Informasi Footer (Tentang Kami, Kontak, dll) - BARU
Route::get('/page/{slug}', [HomeController::class, 'page'])->name('pages.show');

// 5. Subscribe Newsletter - BARU
Route::post('/newsletter', [HomeController::class, 'subscribe'])->name('newsletter.subscribe');


// --- AUTH ROUTES (Login/Logout) ---

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- ADMIN ROUTES (Hanya bisa diakses jika sudah Login) ---

Route::middleware('auth')->prefix('admin')->group(function () {
    
    // 7. Dashboard Resource (Otomatis handle: Index, Create, Store, Edit, Update, Destroy)
    Route::resource('dashboard', DashboardController::class);

    // 8. Tool Rahasia: Reset Views jadi 0 (Untuk demo "Berita Terpopuler")
    Route::get('/reset-views', function () {
        \App\Models\Post::query()->update(['views' => 0]);
        return redirect()->route('home')->with('success', 'Semua views berhasil di-reset jadi 0!');
    });
});