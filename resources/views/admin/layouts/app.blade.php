<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="پلتفرم موسیقی آنلاین">
    <title>{{ config('app.name') }} | @yield('title', 'پلتفرم موسیقی آنلاین')</title>
    
    <!-- فونت‌ها -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    
    <!-- تیلویند -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'vazir': ['Vazirmatn', 'sans-serif'],
                    },
                    colors: {
                        'primary': {
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
                        'secondary': {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                            950: '#2e1065',
                        },
                        'dark': {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        },
                    }
                }
            }
        }
    </script>
    
    <!-- آیکون‌ها -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- استایل‌های سفارشی -->
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }
        
        .gradient-text {
            background-image: linear-gradient(45deg, #0ea5e9, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: bold;
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .player-container {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .nav-link {
            position: relative;
            color: #1e293b;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #0ea5e9;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-image: linear-gradient(45deg, #0ea5e9, #8b5cf6);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }
        
        .btn-primary {
            background-image: linear-gradient(45deg, #0ea5e9, #0284c7);
            transition: transform 0.2s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .btn-secondary {
            background-image: linear-gradient(45deg, #8b5cf6, #6d28d9);
            transition: transform 0.2s ease;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .hero-gradient {
            background-image: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.1), rgba(139, 92, 246, 0.1));
        }
        
        .audio-control {
            transition: all 0.2s ease;
        }
        
        .audio-control:hover {
            color: #0ea5e9;
            transform: scale(1.1);
        }
        
        .progress-bar {
            height: 5px;
            cursor: pointer;
            background-color: #e2e8f0;
            border-radius: 2.5px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background-image: linear-gradient(45deg, #0ea5e9, #8b5cf6);
            transition: width 0.1s linear;
        }
        
        .volume-control {
            width: 80px;
            height: 4px;
            cursor: pointer;
            background-color: #e2e8f0;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .volume-fill {
            height: 100%;
            background-color: #0ea5e9;
            width: 80%;
        }
        
        .playlist-item {
            transition: all 0.2s ease;
        }
        
        .playlist-item:hover {
            background-color: #f0f9ff;
            transform: translateX(-5px);
        }
        
        .playlist-item.active {
            border-right: 3px solid #0ea5e9;
            background-color: #e0f2fe;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        /* طراحی واکنش‌گرا */
        @media (max-width: 768px) {
            .search-input {
                width: 150px;
            }
            .search-input:focus {
                width: 200px;
            }
        }
        
        @media (max-width: 640px) {
            .player-controls {
                flex-direction: column;
                align-items: center;
            }
            .volume-container {
                margin-top: 10px;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body class="flex flex-col min-h-screen">
    <!-- ناوبری -->
    @include('partials.navbar')

    <!-- محتوای اصلی -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- پخش‌کننده -->
    <div id="audio-player" class="player-container fixed bottom-0 left-0 right-0 py-3 px-4 z-40">
        <div class="container mx-auto">
            <div class="flex flex-col">
                <!-- نوار پیشرفت -->
                <div class="progress-bar mb-3">
                    <div class="progress-fill" style="width: 0%"></div>
                </div>
                
                <div class="flex items-center justify-between">
                    <!-- اطلاعات آهنگ -->
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <img id="current-thumbnail" src="{{ asset('img/default-cover.jpg') }}" alt="Album Cover" class="w-12 h-12 rounded-md object-cover">
                        <div>
                            <h4 id="current-title" class="text-sm font-medium text-dark-800">عنوان آهنگ</h4>
                            <p id="current-artist" class="text-xs text-dark-500">نام هنرمند</p>
                        </div>
                    </div>
                    
                    <!-- کنترل‌های پخش -->
                    <div class="player-controls flex items-center space-x-6 space-x-reverse">
                        <button id="prev-track" class="audio-control text-dark-600 hover:text-primary-500">
                            <i class="fas fa-step-backward"></i>
                        </button>
                        
                        <button id="play-pause" class="audio-control w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center hover:bg-primary-600">
                            <i class="fas fa-play"></i>
                        </button>
                        
                        <button id="next-track" class="audio-control text-dark-600 hover:text-primary-500">
                            <i class="fas fa-step-forward"></i>
                        </button>
                        
                        <!-- زمان آهنگ -->
                        <div class="hidden sm:flex items-center space-x-2 space-x-reverse">
                            <span id="current-time" class="text-xs text-dark-500">0:00</span>
                            <span class="text-xs text-dark-400">/</span>
                            <span id="duration" class="text-xs text-dark-500">0:00</span>
                        </div>
                    </div>
                    
                    <!-- کنترل صدا و سایر گزینه‌ها -->
                    <div class="volume-container flex items-center space-x-4 space-x-reverse">
                        <button id="toggle-mute" class="audio-control text-dark-600 hover:text-primary-500">
                            <i class="fas fa-volume-up"></i>
                        </button>
                        
                        <div class="hidden sm:block volume-control">
                            <div class="volume-fill"></div>
                        </div>
                        
                        <button id="toggle-playlist" class="audio-control text-dark-600 hover:text-primary-500">
                            <i class="fas fa-list"></i>
                        </button>
                        
                        <button id="toggle-repeat" class="audio-control text-dark-600 hover:text-primary-500">
                            <i class="fas fa-redo-alt"></i>
                        </button>
                        
                        <button id="toggle-shuffle" class="audio-control text-dark-600 hover:text-primary-500">
                            <i class="fas fa-random"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- پلی‌لیست -->
        <div id="current-playlist" class="hidden fixed bottom-20 right-0 w-80 max-h-96 overflow-y-auto bg-white rounded-t-lg shadow-lg border border-gray-200 p-4">
            <h3 class="text-lg font-bold mb-4 gradient-text">در حال پخش</h3>
            <ul class="space-y-2">
                <!-- نمونه آیتم‌های پلی‌لیست -->
                <li class="playlist-item active p-2 rounded-lg flex items-center justify-between">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <img src="{{ asset('img/default-cover.jpg') }}" alt="Song" class="w-10 h-10 rounded object-cover">
                        <div>
                            <p class="text-sm font-medium">عنوان آهنگ</p>
                            <p class="text-xs text-gray-500">نام هنرمند</p>
                        </div>
                    </div>
                    <span class="text-xs text-gray-500">3:45</span>
                </li>
                <!-- آیتم‌های بیشتر... -->
            </ul>
        </div>
    </div>

    <!-- فوتر -->
    @include('partials.footer')

    <!-- اسکریپت‌ها -->
    <script>
        // تابع‌های مربوط به منوی موبایل
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const searchToggle = document.getElementById('search-toggle');
            const mobileSearch = document.getElementById('mobile-search');
            const playlistToggle = document.getElementById('toggle-playlist');
            const currentPlaylist = document.getElementById('current-playlist');
            
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
            
            // تابع‌های باز و بسته کردن پلی‌لیست
            if (playlistToggle) {
                playlistToggle.addEventListener('click', function() {
                    currentPlaylist.classList.toggle('hidden');
                });
            }
            
            // تابع‌های پخش‌کننده موزیک
            const playPauseBtn = document.getElementById('play-pause');
            const playIcon = '<i class="fas fa-play"></i>';
            const pauseIcon = '<i class="fas fa-pause"></i>';
            
            if (playPauseBtn) {
                playPauseBtn.addEventListener('click', function() {
                    if (playPauseBtn.innerHTML === playIcon) {
                        playPauseBtn.innerHTML = pauseIcon;
                    } else {
                        playPauseBtn.innerHTML = playIcon;
                    }
                });
            }
            
            // اسکریپت پخش آهنگ
            const audioPlayer = new Audio();
            const playButtons = document.querySelectorAll('.play-song');
            const currentTitle = document.getElementById('current-title');
            const currentArtist = document.getElementById('current-artist');
            const currentThumbnail = document.getElementById('current-thumbnail');
            const progressFill = document.querySelector('.progress-fill');
            const currentTimeEl = document.getElementById('current-time');
            const durationEl = document.getElementById('duration');
            
            // تابع فرمت زمان
            function formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
            }
            
            // به‌روزرسانی پیشرفت
            audioPlayer.addEventListener('timeupdate', function() {
                const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                if (progressFill) progressFill.style.width = `${progress}%`;
                if (currentTimeEl) currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
            });
            
            // تنظیم مدت زمان
            audioPlayer.addEventListener('loadedmetadata', function() {
                if (durationEl) durationEl.textContent = formatTime(audioPlayer.duration);
            });
            
            // رویداد پایان آهنگ
            audioPlayer.addEventListener('ended', function() {
                if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            });
            
            // کلیک روی دکمه‌های پخش آهنگ
            playButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const songId = this.getAttribute('data-song-id');
                    const songUrl = this.getAttribute('data-song-url');
                    const songTitle = this.getAttribute('data-song-title');
                    const songArtist = this.getAttribute('data-song-artist');
                    const songCover = this.getAttribute('data-song-cover');
                    
                    // تنظیم اطلاعات آهنگ در پخش‌کننده
                    currentTitle.textContent = songTitle;
                    currentArtist.textContent = songArtist;
                    currentThumbnail.src = songCover;
                    
                    // تنظیم منبع آهنگ و پخش
                    audioPlayer.src = songUrl;
                    audioPlayer.play();
                    
                    // تغییر آیکون به حالت مکث
                    if (playPauseBtn) playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>