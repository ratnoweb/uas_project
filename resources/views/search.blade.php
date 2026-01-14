@extends('layouts.app')

@section('title', 'Pencarian: ' . $query)

@section('content')
<main class="max-w-7xl mx-auto px-4 py-8">
    
    {{-- Header Pencarian --}}
    <div class="mb-8 border-b border-gray-200 pb-4">
        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
            <i class="ri-search-line mr-3 text-primary"></i>
            Hasil Pencarian: "{{ $query }}"
        </h1>
        <p class="text-gray-500 mt-2 ml-9">
            Ditemukan {{ $posts->total() }} berita yang cocok dengan kata kunci tersebut.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        {{-- LIST HASIL PENCARIAN --}}
        <div class="lg:col-span-3 space-y-6">
            @forelse($posts as $post)
            <article class="flex flex-col md:flex-row bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition border border-gray-100 h-full md:h-48">
                {{-- Gambar --}}
                <div class="md:w-1/3 h-48 md:h-full relative overflow-hidden group">
                     <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                
                {{-- Konten --}}
                <div class="md:w-2/3 p-5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center text-xs text-gray-500 mb-2">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded font-medium">{{ $post->category->name }}</span>
                            <span class="mx-2">•</span>
                            <i class="ri-time-line mr-1"></i> {{ $post->published_at->diffForHumans() }}
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-primary transition">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ $post->excerpt }}
                        </p>
                    </div>
                </div>
            </article>
            @empty
            <div class="bg-yellow-50 text-yellow-800 p-10 rounded-lg text-center border border-yellow-200">
                <i class="ri-file-search-line text-6xl mb-4 block opacity-50 mx-auto"></i>
                <h3 class="font-bold text-xl mb-2">Maaf, tidak ditemukan.</h3>
                <p>Coba gunakan kata kunci lain yang lebih umum.</p>
            </div>
            @endforelse

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $posts->appends(['q' => $query])->links() }}
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="lg:col-span-1">
             @include('sections.sidebar')
        </div>
    </div>
</main>
@endsection