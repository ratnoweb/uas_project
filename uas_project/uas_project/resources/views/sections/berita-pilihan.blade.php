<section class="mb-12">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-900 border-l-4 border-secondary pl-3">Berita Pilihan Editor</h3>
    </div>
    
    <div class="space-y-4">
        {{-- LOOPING DATA DARI DATABASE --}}
        @foreach($posts as $post)
        <article class="news-card bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    <img src="{{ $post->image }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-48 md:h-full object-cover object-center">
                </div>
                <div class="md:w-2/3 p-6">
                    <span class="inline-block bg-secondary text-white px-2 py-1 rounded text-xs font-medium mb-2">
                        {{ $post->category->name }}
                    </span>
                    
                    <h4 class="font-bold text-gray-900 mb-3 text-xl line-clamp-2">
                        <a href="#" class="hover:text-secondary">{{ $post->title }}</a>
                    </h4>
                    
                    <p class="text-gray-600 mb-4 line-clamp-2 text-sm">
                        {{ $post->excerpt }}
                    </p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="ri-calendar-line mr-1"></i>
                            {{ $post->published_at->format('d M Y') }}
                        </span>
                        <span class="flex items-center">
                            <i class="ri-user-line mr-1"></i>
                            {{ $post->author->name ?? 'Redaksi' }}
                        </span>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>