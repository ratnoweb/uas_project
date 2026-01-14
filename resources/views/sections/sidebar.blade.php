<aside class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-fire-line text-secondary"></i>
                        </div>
                        Berita Terpopuler
                    </h4>
                    
                    <div class="space-y-4">
                        {{-- LOOPING DATA POPULER OTOMATIS --}}
                        @if(isset($popularPosts))
                            @foreach($popularPosts as $post)
                            <article class="flex space-x-3 group">
                                {{-- Nomor Urut Besar (1, 2, 3...) --}}
                                <span class="text-2xl font-bold text-secondary/80 group-hover:text-secondary transition">
                                    {{ $loop->iteration }}
                                </span>
                                
                                <div>
                                    {{-- Judul Berita --}}
                                    <h5 class="font-medium text-gray-900 text-sm line-clamp-2 leading-snug">
                                        <a href="{{ route('posts.show', $post->slug) }}" class="group-hover:text-primary transition">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    
                                    {{-- Info Tanggal & Jumlah Views --}}
                                    <p class="text-xs text-gray-500 mt-1 flex items-center">
                                        <span>{{ $post->published_at->format('d M Y') }}</span>
                                        <span class="mx-1">•</span>
                                        <span class="flex items-center text-secondary">
                                            <i class="ri-eye-fill mr-1"></i> {{ $post->views }}
                                        </span>
                                    </p>
                                </div>
                            </article>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500">Belum ada data populer.</p>
                        @endif
                    </div>
                </div>


                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-hashtag text-primary"></i>
                            </div>
                            Trending Topics
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">#LombokSmart</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">#FestivalSenggigi</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">#WisataLombok</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">#UMKMLombok</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">#BeasiswaUnram</span>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg p-6 text-white shadow-lg relative overflow-hidden">
                        <i class="ri-sun-cloudy-line absolute -right-4 -top-4 text-9xl text-white/10"></i>

                        <h4 class="font-semibold mb-4 flex items-center relative z-10">
                            <div class="w-6 h-6 flex items-center justify-center mr-2 bg-white/20 rounded-full">
                                <i class="ri-map-pin-line text-xs"></i>
                            </div>
                            Mataram, Lombok
                        </h4>
                        
                        <div class="text-center relative z-10" id="weather-widget">
                            <div class="animate-pulse">
                                <div class="h-10 bg-white/20 rounded w-1/2 mx-auto mb-2"></div>
                                <div class="h-4 bg-white/20 rounded w-1/3 mx-auto"></div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const latitude = -8.5833; // Koordinat Mataram
                                const longitude = 116.1167;
                                
                                fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current=temperature_2m,weather_code&timezone=Asia%2FMakassar`)
                                    .then(response => response.json())
                                    .then(data => {
                                        const temp = Math.round(data.current.temperature_2m);
                                        const code = data.current.weather_code;
                                        let condition = 'Cerah';
                                        let icon = 'ri-sun-line';

                                        // Mapping Kode Cuaca WMO ke Teks Indonesia
                                        if (code >= 1 && code <= 3) { condition = 'Berawan'; icon = 'ri-cloudy-line'; }
                                        else if (code >= 45 && code <= 48) { condition = 'Kabut'; icon = 'ri-mist-line'; }
                                        else if (code >= 51 && code <= 67) { condition = 'Hujan Ringan'; icon = 'ri-drizzle-line'; }
                                        else if (code >= 80 && code <= 99) { condition = 'Hujan Petir'; icon = 'ri-thunderstorms-line'; }
                                        else if (code >= 71) { condition = 'Salju (Aneh?)'; icon = 'ri-snowy-line'; }

                                        const html = `
                                            <div class="flex justify-center items-center mb-1">
                                                <i class="${icon} text-4xl mr-3 text-yellow-300"></i>
                                                <div class="text-5xl font-bold tracking-tighter">${temp}°C</div>
                                            </div>
                                            <p class="text-blue-100 text-lg font-medium">${condition}</p>
                                            <div class="mt-4 text-xs text-blue-200 border-t border-white/20 pt-2">
                                                Update: ${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})} WITA
                                            </div>
                                        `;
                                        document.getElementById('weather-widget').innerHTML = html;
                                    })
                                    .catch(err => {
                                        document.getElementById('weather-widget').innerHTML = '<p class="text-sm">Gagal memuat cuaca.</p>';
                                    });
                            });
                        </script>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-share-line text-primary"></i>
                            </div>
                            Ikuti Kami
                        </h4>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-primary">
                                <div class="w-8 h-8 flex items-center justify-center bg-blue-100 rounded">
                                    <i class="ri-facebook-fill text-blue-600"></i>
                                </div>
                                <span class="font-medium">Facebook</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-primary">
                                <div class="w-8 h-8 flex items-center justify-center bg-blue-100 rounded">
                                    <i class="ri-twitter-fill text-blue-500"></i>
                                </div>
                                <span class="font-medium">Twitter</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-primary">
                                <div class="w-8 h-8 flex items-center justify-center bg-pink-100 rounded">
                                    <i class="ri-instagram-fill text-pink-600"></i>
                                </div>
                                <span class="font-medium">Instagram</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-primary">
                                <div class="w-8 h-8 flex items-center justify-center bg-red-100 rounded">
                                    <i class="ri-youtube-fill text-red-600"></i>
                                </div>
                                <span class="font-medium">YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>