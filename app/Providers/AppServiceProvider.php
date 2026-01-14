<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator; // <--- WAJIB ADA
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 1. PERBAIKAN: Gunakan Style Tailwind untuk Pagination
        Paginator::useTailwind(); 

        // 2. Logic Sidebar Populer
        View::composer('sections.sidebar', function ($view) {
            $popularPosts = Post::whereNotNull('published_at')
                                ->orderBy('views', 'desc')
                                ->take(5)
                                ->get();         
            $view->with('popularPosts', $popularPosts);
        });
    }
}