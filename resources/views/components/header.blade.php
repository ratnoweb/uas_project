<header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between py-4">

            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <h1 class="logo-font text-2xl font-bold text-primary">Lombok News</h1>
                <span class="text-secondary text-sm font-medium">Portal Berita Terpercaya</span>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                <div class="hidden md:block text-sm text-gray-600" id="current-date"></div>

                <!-- Search -->
                <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" 
                    name="q" 
                    placeholder="Cari berita..." 
                    value="{{ request('q') }}"
                    class="pl-10 pr-4 py-2 border rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-primary w-64 transition-all">
                
                <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary">
                    <i class="ri-search-line"></i>
                </button>
            </form>

                <!-- Login Admin -->
                <a href="{{ route('login') }}" 
                class="bg-primary text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-primary/90 transition">
                    Login Admin
                </a>
            </div>

        </div>
    </div>
</header>
