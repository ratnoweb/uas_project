<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Wajib ada
use App\Models\Post; // Wajib ada

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // LOGIC SIDEBAR POPULER
        // Mengirimkan 5 berita dengan views tertinggi ke file sidebar
        View::composer('sections.sidebar', function ($view) {
            $popularPosts = Post::whereNotNull('published_at')
                                ->orderBy('views', 'desc') // Urutkan dari yang paling banyak dilihat
                                ->take(5) // Ambil 5 besar
                                ->get();
                                
            $view->with('popularPosts', $popularPosts);
        });
    }
}