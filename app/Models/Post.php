<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // --- INI SOLUSINYA ---
    // Kita paksa 'published_at' agar dibaca sebagai Tanggal, bukan Teks.
    protected $casts = [
        'published_at' => 'datetime',
        'is_headline' => 'boolean',
        'is_editor_choice' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Scope Helper
    public function scopeActive($query)
    {
        return $query->whereNotNull('published_at');
    }
}