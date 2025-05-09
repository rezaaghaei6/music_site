<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت') | سیستم مدیریت موزیک</title>
    
    <!-- فونت‌آوسام -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- تیلویند CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- فونت وزیر -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Vazirmatn', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        },
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
        
        /* منوی سایدبار */
        .sidebar {
            width: 260px;
            transition: all 0.3s;
        }
        
        .sidebar-collapsed {
            width: 80px;
        }
        
        .sidebar-collapsed .sidebar-text {
            display: none;
        }
        
        .main-content {
            transition: all 0.3s;
        }
        
        .sidebar-link {
            transition: all 0.2s;
        }
        
        .sidebar-link:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .sidebar-link.active {
            background-color: #0ea5e9;
            color: white;
        }
        
        /* دراپ‌داون */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 0.375rem;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        /* جدول */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th {
            background-color: #f3f4f6;
            text-align: right;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .data-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .data-table tr:hover {
            background-color: #f9fafb;
        }
        
        /* دکمه‌ها */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: #0ea5e9;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #0284c7;
        }
        
        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #4b5563;
        }
        
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        /* فرم‌ها */
        .form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        /* اعلان‌ها */
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }
        
        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #047857;
        }
        
        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #ef4444;
            color: #b91c1c;
        }
        
        .alert-warning {
            background-color: #fffbeb;
            border: 1px solid #f59e0b;
            color: #b45309;
        }
        
        .alert-info {
            background-color: #e0f2fe;
            border: 1px solid #0ea5e9;
            color: #0369a1;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- سایدبار -->
        <aside class="sidebar bg-white shadow-lg h-screen sticky top-0 overflow-y-auto">
            <div class="p-4">
                <div class="flex items-center justify-between mb-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-primary-600">
                        <span>Laravel</span>
                    </a>
                    <button id="toggle-sidebar" class="text-gray-500 hover:text-gray-700 lg:hidden">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <nav class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 space-x-reverse px-3 py-2 rounded-md {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i>
                        <span class="sidebar-text">داشبورد</span>
                    </a>
                    
                    <a href="{{ route('admin.songs.index') }}" class="sidebar-link flex items-center space-x-3 space-x-reverse px-3 py-2 rounded-md {{ request()->routeIs('admin.songs.*') ? 'active' : '' }}">
                        <i class="fas fa-music w-5 text-center"></i>
                        <span class="sidebar-text">موزیک‌ها</span>
                    </a>
                    
                    <a href="{{ route('admin.artists.index') }}" class="sidebar-link flex items-center space-x-3 space-x-reverse px-3 py-2 rounded-md {{ request()->routeIs('admin.artists.*') ? 'active' : '' }}">
                        <i class="fas fa-microphone w-5 text-center"></i>
                        <span class="sidebar-text">هنرمندان</span>
                    </a>
                    
                    <a href="{{ route('admin.albums.index') }}" class="sidebar-link flex items-center space-x-3 space-x-reverse px-3 py-2 rounded-md {{ request()->routeIs('admin.albums.*') ? 'active' : '' }}">
                        <i class="fas fa-compact-disc w-5 text-center"></i>
                        <span class="sidebar-text">آلبوم‌ها</span>
                    </a>
                    
                    <a href="{{ route('admin.genres.index') }}" class="sidebar-link flex items-center space-x-3 space-x-reverse px-3 py-2 rounded-md {{ request()->routeIs('admin.genres.*') ? 'active' : '' }}">
                        <i class="fas fa-guitar w-5 text-center"></i>
                        <span class="sidebar-text">ژانرها</span>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center space-x-3 space-x-reverse px-3 py-2 rounded-md {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="sidebar-text">کاربران</span>
                    </a>
                    
                    <a href="{{ route('admin.settings') }}" class="sidebar-link flex items-center space-x-3 space-x-reverse px-3 py-2 rounded-md {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <i class="fas fa-cog w-5 text-center"></i>
                        <span class="sidebar-text">تنظیمات</span>
                    </a>
                </nav>
            </div>
        </aside>
        
        <!-- محتوای اصلی -->
        <div class="main-content flex-1">
            <!-- هدر -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-900">
                            @yield('header', 'پنل مدیریت Laravel')
                        </h1>
                        
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <div class="dropdown relative">
                                <button class="flex items-center space-x-2 space-x-reverse text-gray-700 hover:text-gray-900">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="dropdown-content left-0 mt-2">
                                    <div class="py-1">
                                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            پروفایل
                                        </a>
                                        <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            تنظیمات
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-right block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                خروج
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- محتوای اصلی -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('content')
            </main>
            
            <!-- فوتر -->
            <footer class="bg-white shadow-inner py-4 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} سیستم مدیریت موزیک. تمامی حقوق محفوظ است.
                </div>
            </footer>
        </div>
    </div>
    
    <script>
        // تاگل سایدبار
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('sidebar-collapsed');
            document.querySelector('.main-content').classList.toggle('ml-20');
        });
        
        // فعال‌سازی تولتیپ‌ها
        const tooltips = document.querySelectorAll('[data-tooltip]');
        tooltips.forEach(tooltip => {
            tooltip.addEventListener('mouseover', function() {
                const tooltipText = this.getAttribute('data-tooltip');
                const tooltipEl = document.createElement('div');
                tooltipEl.classList.add('tooltip');
                tooltipEl.textContent = tooltipText;
                document.body.appendChild(tooltipEl);
                
                const rect = this.getBoundingClientRect();
                tooltipEl.style.top = rect.bottom + 10 + 'px';
                tooltipEl.style.left = rect.left + rect.width / 2 - tooltipEl.offsetWidth / 2 + 'px';
                
                this.addEventListener('mouseout', function() {
                    tooltipEl.remove();
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>