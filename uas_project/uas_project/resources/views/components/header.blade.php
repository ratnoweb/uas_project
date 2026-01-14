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
                <div class="hidden md:flex items-center space-x-2">
                    <i class="ri-search-line text-gray-600"></i>
                    <input type="text" placeholder="Cari berita..."
                        class="border border-gray-300 rounded-button px-3 py-1 text-sm focus:outline-none focus:border-primary">
                </div>

                <!-- Login Admin -->
                <a href="{{ route('login') }}" 
                class="bg-primary text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-primary/90 transition">
                    Login Admin
                </a>
            </div>

        </div>
    </div>
</header>
