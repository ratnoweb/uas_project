<footer class="bg-primary text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            {{-- KOLOM 1: Info Singkat --}}
            <div>
                <h3 class="logo-font text-xl font-bold mb-4">Lombok News</h3>
                <p class="text-blue-100 mb-4">Portal berita terpercaya yang menyajikan informasi terkini seputar Pulau Lombok dan Nusa Tenggara Barat.</p>
                <div class="space-y-2 text-sm text-blue-100">
                    <p><i class="ri-map-pin-line mr-1"></i> Jl. Pejanggik No. 123</p>
                    <p class="pl-5">Mataram, NTB 83115</p>
                    <p><i class="ri-phone-line mr-1"></i> (0370) 123-4567</p>
                    <p><i class="ri-mail-line mr-1"></i> redaksi@lomboknews.id</p>
                </div>
            </div>

            {{-- KOLOM 2: Kategori Dinamis --}}
            <div>
                <h4 class="font-semibold mb-4 text-lg">Kategori Berita</h4>
                <ul class="space-y-2 text-blue-100">
                    {{-- Loop Kategori dari Database --}}
                    @foreach(App\Models\Category::all() as $cat)
                    <li>
                        <a href="{{ route('categories.show', $cat->slug) }}" class="hover:text-white hover:translate-x-1 transition-transform inline-block">
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- KOLOM 3: Informasi / Halaman Statis --}}
            <div>
                <h4 class="font-semibold mb-4 text-lg">Informasi</h4>
                <ul class="space-y-2 text-blue-100">
                    <li><a href="{{ route('pages.show', 'tentang-kami') }}" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="{{ route('pages.show', 'tim-redaksi') }}" class="hover:text-white">Tim Redaksi</a></li>
                    <li><a href="{{ route('pages.show', 'kontak') }}" class="hover:text-white">Kontak</a></li>
                    <li><a href="{{ route('pages.show', 'karir') }}" class="hover:text-white">Karir</a></li>
                    <li><a href="{{ route('pages.show', 'kebijakan-privasi') }}" class="hover:text-white">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('pages.show', 'syarat-ketentuan') }}" class="hover:text-white">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            {{-- KOLOM 4: Newsletter & Sosmed --}}
            <div>
                <h4 class="font-semibold mb-4 text-lg">Newsletter</h4>
                <p class="text-blue-100 mb-4 text-sm">Dapatkan berita terbaru langsung di email Anda.</p>
                
                {{-- Form Newsletter --}}
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-2 mb-6">
                    @csrf
                    <input type="email" name="email" placeholder="Email Anda" required 
                           class="w-full px-3 py-2 rounded text-gray-900 text-sm border-none focus:outline-none focus:ring-2 focus:ring-secondary">
                    <button type="submit" class="bg-secondary text-white px-4 py-2 rounded text-sm font-medium hover:bg-red-700 transition">
                        Daftar Sekarang
                    </button>
                </form>

                {{-- Sosmed (Link Statis) --}}
                <div class="flex space-x-3">
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-blue-700 rounded hover:bg-white hover:text-blue-700 transition">
                        <i class="ri-facebook-fill"></i>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-blue-700 rounded hover:bg-white hover:text-blue-400 transition">
                        <i class="ri-twitter-x-fill"></i>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-blue-700 rounded hover:bg-white hover:text-pink-600 transition">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-blue-700 rounded hover:bg-white hover:text-red-600 transition">
                        <i class="ri-youtube-fill"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-blue-700 mt-8 pt-8 text-center text-blue-200 text-sm">
            <p>&copy; {{ date('Y') }} Lombok News. Portal Berita Kebanggaan NTB.</p>
        </div>
    </div>
</footer>