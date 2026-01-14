<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained(); // Relasi ke Kategori
        $table->foreignId('user_id')->constrained();     // Relasi ke Penulis (User)
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('excerpt');       // Untuk deskripsi singkat di card
        $table->longText('body');      // Isi berita full
        $table->string('image')->nullable();
        
        // Logic untuk Tampilan
        $table->boolean('is_headline')->default(false);      // Untuk Hero Slider
        $table->boolean('is_editor_choice')->default(false); // Untuk Berita Pilihan
        $table->integer('views')->default(0);                // Untuk Sidebar "Terpopuler"
        
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
