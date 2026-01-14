<div class="mb-8">
    <div class="flex justify-between items-end mb-6">
        <h2 class="text-2xl font-bold border-l-4 border-primary pl-4 text-gray-800">
            Berita Terbaru
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($posts as $post)
        <article class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 group hover:shadow-md transition duration-300">
            <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden">
                {{-- Label Kategori --}}
                <span class="absolute top-4 left-4 z-10 bg-secondary text-white text-xs px-3 py-1 rounded-full shadow-sm">
                    {{ $post->category->name ?? 'News' }}
                </span>
                
                {{-- Gambar --}}
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-48 object-cover object-center group-hover:scale-105 transition duration-500">
            </a>

            <div class="p-5">
                <div class="flex items-center text-xs text-gray-500 mb-3 space-x-2">
                    <span class="flex items-center"><i class="ri-calendar-line mr-1"></i> {{ $post->published_at->diffForHumans() }}</span>
                    <span>•</span>
                    <span class="flex items-center"><i class="ri-eye-line mr-1"></i> {{ $post->views }}</span>
                </div>

                <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug group-hover:text-primary transition">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </h3>

                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                    {{ $post->excerpt }}
                </p>

                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    <div class="flex items-center text-xs font-medium text-gray-900">
                        <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2 text-gray-500">
                            <i class="ri-user-fill text-[10px]"></i>
                        </div>
                        {{ $post->author->name ?? 'Redaksi' }}
                    </div>
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 flex items-center">
                        Baca <i class="ri-arrow-right-line ml-1"></i>
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-2 text-center py-10 text-gray-500">
            Belum ada berita terbaru.
        </div>
        @endforelse
    </div>

    {{-- PERBAIKAN: Tombol Pagination Wajib Ada --}}
    <div class="mt-10">
        {{ $posts->links() }}
    </div>
</div>