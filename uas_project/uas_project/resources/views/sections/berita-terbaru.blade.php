<section class="mb-12">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-900 border-l-4 border-primary pl-3">Berita Terbaru</h3>
        <a href="#" class="text-primary font-medium hover:text-secondary text-sm">Lihat Semua</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- LOOPING DATA DARI DATABASE --}}
        @foreach($posts as $post)
        <article class="news-card bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
            <div class="relative group">
                {{-- Gambar --}}
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                alt="{{ $post->title }}" 
                class="w-full h-48 object-cover object-center group-hover:scale-105 transition duration-500">
                
                {{-- Label Kategori --}}
                <span class="absolute top-3 left-3 bg-primary/90 backdrop-blur-sm text-white px-2 py-1 rounded text-xs font-medium">
                    {{ $post->category->name }}
                </span>
            </div>
            
            <div class="p-4">
                {{-- Judul --}}
                <h4 class="font-bold text-gray-900 mb-2 line-clamp-2 hover:text-primary h-14">
                <a href="{{ route('posts.show', $post->slug) }}">
                </h4>
                
                {{-- Cuplikan Isi --}}
                <p class="text-gray-600 text-sm mb-4 line-clamp-3 h-16">
                    {{ $post->excerpt }}
                </p>
                
                <div class="flex items-center justify-between text-xs text-gray-500 border-t pt-3">
                    <span class="flex items-center">
                        <i class="ri-time-line mr-1"></i>
                        {{ $post->published_at->diffForHumans() }}
                    </span>
                    <span class="flex items-center">
                        <i class="ri-quill-pen-line mr-1"></i>
                        {{ $post->author->name ?? 'Admin' }}
                    </span>
                </div>
            </div>
        </article>
        @endforeach

    </div>

    {{-- PAGINATION LINK (Nomor Halaman) --}}
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</section>