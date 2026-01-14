@extends('layouts.app') {{-- Sesuaikan path layout --}}

@section('title', 'Kategori: ' . $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    
    {{-- Header Kategori --}}
    <div class="mb-8 border-b border-gray-200 pb-4">
        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
            <span class="w-2 h-8 bg-primary mr-3 rounded-full"></span>
            Kategori: {{ $category->name }}
        </h1>
        <p class="text-gray-500 mt-2 ml-5">Menampilkan berita terbaru seputar {{ $category->name }} di Lombok.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        {{-- LIST BERITA --}}
        <div class="lg:col-span-3 space-y-6">
            @forelse($posts as $post)
            <article class="flex flex-col md:flex-row bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition border border-gray-100">
                {{-- Gambar Thumbnail --}}
                <div class="md:w-1/3 h-48 md:h-auto">
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                alt="{{ $post->title }}" 
                class="w-full h-full object-cover">
                </div>
                
                {{-- Konten --}}
                <div class="md:w-2/3 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="bg-gray-100 px-2 py-1 rounded text-gray-600 font-medium">{{ $post->category->name }}</span>
                            <span class="mx-2">•</span>
                            <i class="ri-time-line mr-1"></i> {{ $post->published_at->diffForHumans() }}
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-primary transition">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                            {{ $post->excerpt }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center text-xs text-gray-500">
                            <i class="ri-user-line mr-1"></i> {{ $post->author->name ?? 'Redaksi' }}
                        </div>
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-primary text-sm font-semibold hover:underline">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="bg-yellow-50 text-yellow-800 p-6 rounded-lg text-center">
                <i class="ri-file-warning-line text-4xl mb-2 block"></i>
                <p class="font-medium">Belum ada berita di kategori ini.</p>
            </div>
            @endforelse

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="lg:col-span-1">
             {{-- PERBAIKAN: Menggunakan sections.sidebar --}}
             @include('sections.sidebar')
        </div>
    </div>
</div>
@endsection