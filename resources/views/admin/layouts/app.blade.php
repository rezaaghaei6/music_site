<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - پنل مدیریت</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=vazirmatn:400,500,600,700" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Styles -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div x-data="{ sidebarOpen: false }" class="relative flex min-h-screen">
            <!-- Mobile Sidebar Toggle -->
            <div class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden" 
                x-show="sidebarOpen" 
                x-transition:enter="transition-opacity ease-linear duration-300" 
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100" 
                x-transition:leave="transition-opacity ease-linear duration-300" 
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0" 
                @click="sidebarOpen = false" 
                x-cloak>
            </div>
            
            <!-- Sidebar -->
            <div class="fixed inset-y-0 right-0 z-30 w-64 bg-white dark:bg-gray-800 shadow-lg transform transition-transform lg:translate-x-0 lg:static lg:inset-0" 
                :class="{'translate-x-0': sidebarOpen, 'translate-x-full': !sidebarOpen}" 
                x-cloak="lg">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">پنل مدیریت</h2>
                    <button @click="sidebarOpen = false" class="p-2 rounded-md lg:hidden">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <nav class="p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} text-gray-700 dark:text-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span>داشبورد</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.articles.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} text-gray-700 dark:text-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    <span>مقالات</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.categories.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} text-gray-700 dark:text-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span>دسته‌بندی‌ها</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tags.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.tags.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} text-gray-700 dark:text-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span>برچسب‌ها</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.comments.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.comments.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} text-gray-700 dark:text-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                    <span>نظرات</span>
                                </div>
                            </a>
                        </li>
                        <li class="pt-4 mt-4 border-t dark:border-gray-700">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span>بازگشت به سایت</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Header -->
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="flex items-center justify-between px-4 py-3">
                        <div class="flex items-center">
                            <button @click="sidebarOpen = true" class="p-2 rounded-md lg:hidden">
                                <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mr-4">@yield('title', 'پنل مدیریت')</h2>
                        </div>
                        <div class="flex items-center">
                            <!-- User Dropdown -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="flex items-center text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                                    <span class="ml-2">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50" x-cloak>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">پروفایل</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-right px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">خروج</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                
                <!-- Main -->
                <main class="flex-1 overflow-y-auto p-4">
                    @if(session('success'))
                        <div class="bg-green-100 border-r-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
