@extends('layouts.app') {{-- Pastikan ini sesuai dengan lokasi layout kamu --}}

@section('title', $post->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        {{-- KOLOM KIRI: KONTEN BERITA --}}
        <div class="lg:col-span-3 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            
            {{-- Breadcrumb / Kategori --}}
            <div class="mb-4">
                <a href="{{ route('categories.show', $post->category->slug) }}" 
                   class="inline-block bg-blue-100 text-primary px-3 py-1 rounded-full text-sm font-semibold hover:bg-blue-200 transition">
                    {{ $post->category->name }}
                </a>
            </div>

            {{-- Judul Berita --}}
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                {{ $post->title }}
            </h1>
            
            {{-- Info Penulis & Tanggal --}}
            <div class="flex items-center text-gray-500 text-sm mb-6 pb-6 border-b border-gray-100">
                <div class="flex items-center mr-6">
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-2 text-gray-500">
                        <i class="ri-user-fill"></i>
                    </div>
                    <span class="font-medium">{{ $post->author->name ?? 'Tim Redaksi' }}</span>
                </div>
                <div class="flex items-center mr-6">
                    <i class="ri-calendar-line mr-2"></i>
                    <span>{{ $post->published_at->format('d M Y, H:i') }} WITA</span>
                </div>
                <div class="flex items-center">
                    <i class="ri-eye-line mr-2"></i>
                    <span>{{ $post->views }}x dibaca</span>
                </div>
            </div>

            {{-- Gambar Utama --}}
            <div class="relative w-full h-[400px] mb-8 rounded-xl overflow-hidden shadow-md">
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                    alt="{{ $post->title }}" 
                    class="w-full h-full object-cover">
            </div>

            {{-- Isi Berita (Body) --}}
            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                {!! $post->body !!}
            </div>

            {{-- Tag / Footer Berita --}}
            <div class="mt-8 pt-8 border-t border-gray-100">
                <h4 class="text-sm font-bold text-gray-500 mb-2">Bagikan Berita:</h4>
                <div class="flex space-x-2">
                    <button class="bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700"><i class="ri-facebook-fill mr-1"></i> Facebook</button>
                    <button class="bg-sky-500 text-white px-3 py-2 rounded text-sm hover:bg-sky-600"><i class="ri-twitter-x-fill mr-1"></i> Twitter</button>
                    <button class="bg-green-500 text-white px-3 py-2 rounded text-sm hover:bg-green-600"><i class="ri-whatsapp-fill mr-1"></i> WhatsApp</button>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: SIDEBAR --}}
        <div class="lg:col-span-1">
             {{-- PERBAIKAN: Menggunakan sections.sidebar (bukan components.sections) --}}
             @include('sections.sidebar')
        </div>
    </div>
</div>
@endsection