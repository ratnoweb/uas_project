<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition()
    {
        // PENTING: Kita pakai Faker Bahasa Indonesia ('id_ID')
        $faker = \Faker\Factory::create('id_ID'); 
        
        $title = $faker->realText(60); // Judul terlihat asli (max 60 karakter)
        
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => mt_rand(1, 8), 
            'title' => rtrim($title, '.'), // Hapus titik di akhir judul
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'excerpt' => $faker->realText(150), // Cuplikan pendek
            // Body sangat panjang (15 paragraf) untuk simulasi "banyak bacaan"
            'body' => collect($faker->paragraphs(15))
                        ->map(fn($p) => "<p class='mb-4'>$p</p>")
                        ->implode(''), 
            'image' => 'https://picsum.photos/seed/' . Str::random(5) . '/800/600',
            'views' => mt_rand(100, 15000),
            'is_headline' => false,
            'is_editor_choice' => false,
            'published_at' => now(), // Pastikan ter-publish
        ];
    }
}