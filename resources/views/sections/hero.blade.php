<section class="relative h-96 md:h-[500px] overflow-hidden group">
    @if(isset($post))
        {{-- LOGIKA PINTAR: Cek apakah gambar dari Internet (http) atau Upload Sendiri (Storage) --}}
        @php
            $bgImage = \Illuminate\Support\Str::startsWith($post->image, 'http') 
                        ? $post->image 
                        : asset('storage/' . $post->image);
        @endphp

        {{-- Background Image --}}
        <div class="relative w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105" 
             style="background-image: url('{{ $bgImage }}');">
            
            {{-- Overlay Gelap (Supaya tulisan terbaca) --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/10"></div>
            
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-4 w-full">
                    <div class="max-w-3xl animate-fade-in-up mt-20">
                        
                        {{-- Kategori --}}
                        <span class="inline-block bg-secondary text-white px-3 py-1 rounded-button text-sm font-medium mb-3 uppercase tracking-wider shadow-lg">
                            {{ $post->category->name ?? 'News' }}
                        </span>
                        
                        {{-- Judul Besar --}}
                        <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-md">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-blue-200 transition">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        {{-- Cuplikan --}}
                        <p class="text-gray-200 text-lg mb-6 line-clamp-2 md:w-3/4 drop-shadow-sm">
                            {{ $post->excerpt }}
                        </p>
                        
                        {{-- Info Meta --}}
                        <div class="flex items-center space-x-4 text-gray-300 text-sm font-medium">
                            <span class="flex items-center bg-black/30 px-2 py-1 rounded">
                                <i class="ri-calendar-line mr-2 text-yellow-400"></i>
                                {{ $post->published_at->format('d M Y') }}
                            </span>
                            <span class="flex items-center bg-black/30 px-2 py-1 rounded">
                                <i class="ri-user-line mr-2 text-blue-400"></i>
                                {{ $post->author->name ?? 'Redaksi' }}
                            </span>
                        </div>
                        
                        {{-- Tombol Baca --}}
                        <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center mt-8 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-bold transition shadow-lg hover:shadow-blue-500/50 transform hover:-translate-y-1">
                            Baca Selengkapnya <i class="ri-arrow-right-line ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Tampilan Darurat jika data post tidak terbaca --}}
        <div class="flex items-center justify-center h-full bg-gray-900 text-white">
            <div class="text-center">
                <i class="ri-error-warning-line text-4xl mb-2 text-yellow-500"></i>
                <p>Sedang memuat berita utama...</p>
            </div>
        </div>
    @endif
</section>