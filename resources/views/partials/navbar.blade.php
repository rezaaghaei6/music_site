<nav class="navbar sticky top-0 z-50 py-4 px-6">
    <div class="container mx-auto flex justify-between items-center">
        <!-- لوگو و نام سایت -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2 space-x-reverse">
            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white">
                <i class="fas fa-music"></i>
            </div>
            <span class="text-xl font-bold gradient-text">{{ config('app.name') }}</span>
        </a>
        
        <!-- جستجو -->
        <div class="hidden md:block relative">
            <form action="{{ route('home') }}" method="GET">
                <input type="text" name="q" placeholder="جستجوی موزیک، هنرمند، آلبوم..." 
                    class="py-2 px-4 pr-10 rounded-full border border-gray-200 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 w-64">
                <button type="submit" class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        <!-- لینک‌های اصلی -->
        <div class="hidden md:flex items-center space-x-6 space-x-reverse">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 {{ request()->routeIs('home') ? 'font-bold text-primary-600' : '' }}">صفحه اصلی</a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">دسته‌بندی‌ها</a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">هنرمندان</a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">آلبوم‌ها</a>
        </div>
        
        <!-- دکمه‌های همراه -->
        <div class="flex items-center space-x-4 space-x-reverse">
            <button id="search-toggle" class="md:hidden text-gray-600 hover:text-primary-600">
                <i class="fas fa-search"></i>
            </button>
            
            <button id="menu-toggle" class="md:hidden text-gray-600 hover:text-primary-600">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
    
    <!-- جستجوی موبایل -->
    <div id="mobile-search" class="mt-4 px-6 hidden md:hidden">
        <form action="{{ route('home') }}" method="GET">
            <div class="relative">
                <input type="text" name="q" placeholder="جستجو..." 
                    class="w-full py-2 px-4 pr-10 rounded-full border border-gray-200 focus:outline-none focus:border-primary-500">
                <button type="submit" class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
    
    <!-- منوی موبایل -->
    <div id="mobile-menu" class="mt-4 px-6 py-4 bg-white rounded-lg shadow-lg hidden md:hidden">
        <div class="flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 {{ request()->routeIs('home') ? 'font-bold text-primary-600' : '' }}">صفحه اصلی</a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">دسته‌بندی‌ها</a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">هنرمندان</a>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">آلبوم‌ها</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const searchToggle = document.getElementById('search-toggle');
        const mobileSearch = document.getElementById('mobile-search');
        
        // تابع‌های باز و بسته کردن منوی موبایل
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                if (!mobileSearch.classList.contains('hidden')) {
                    mobileSearch.classList.add('hidden');
                }
            });
        }
        
        // تابع‌های باز و بسته کردن جستجوی موبایل
        if (searchToggle) {
            searchToggle.addEventListener('click', function() {
                mobileSearch.classList.toggle('hidden');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
    });
</script>