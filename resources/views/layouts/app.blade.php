<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="بهترین پلتفرم موسیقی برای گوش دادن به آهنگ‌های محبوب شما">
    <title>{{ config('app.name', 'موزیکا') }} | @yield('title', 'پلتفرم موسیقی آنلاین')</title>
    
    <!-- فونت‌ها -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    
    <!-- استایل‌های تیلویند -->
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
        
        .wave-shape {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .wave-shape svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 56px;
        }

        .wave-shape .shape-fill {
            fill: #FFFFFF;
        }
        
        .bg-music-pattern {
            background-color: #f0f9ff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230ea5e9' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body class="flex flex-col min-h-screen">
    @include('partials.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')
    
    <!-- پخش کننده موسیقی ثابت -->
    <div id="music-player" class="player-container fixed bottom-0 left-0 right-0 py-3 px-4 hidden">
        <div class="container mx-auto">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 space-x-reverse">
                    <img id="player-cover" src="{{ asset('img/default-cover.jpg') }}" alt="Album Cover" class="w-12 h-12 rounded-md object-cover">
                    <div>
                        <h4 id="player-title" class="font-medium text-gray-800 text-sm">عنوان آهنگ</h4>
                        <p id="player-artist" class="text-xs text-gray-500">نام هنرمند</p>
                    </div>
                </div>
                
                <div class="flex-grow mx-6 hidden md:block">
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <span id="current-time" class="text-xs text-gray-500">0:00</span>
                            <span id="duration" class="text-xs text-gray-500">0:00</span>
                        </div>
                        <div class="relative h-1 bg-gray-200 rounded-full mt-1">
                            <div id="progress-bar" class="absolute top-0 left-0 h-full bg-primary-500 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 space-x-reverse">
                    <button id="prev-button" class="text-gray-600 hover:text-primary-600">
                        <i class="fas fa-step-backward"></i>
                    </button>
                    <button id="play-pause-button" class="w-8 h-8 rounded-full bg-primary-500 text-white flex items-center justify-center hover:bg-primary-600">
                        <i class="fas fa-play"></i>
                    </button>
                    <button id="next-button" class="text-gray-600 hover:text-primary-600">
                        <i class="fas fa-step-forward"></i>
                    </button>
                    <button id="volume-button" class="text-gray-600 hover:text-primary-600 hidden md:block">
                        <i class="fas fa-volume-up"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <audio id="audio-player" src=""></audio>
    </div>

    <!-- اسکریپت‌ها -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // پخش کننده موسیقی
            const player = document.getElementById('music-player');
            const audioPlayer = document.getElementById('audio-player');
            const playPauseButton = document.getElementById('play-pause-button');
            const prevButton = document.getElementById('prev-button');
            const nextButton = document.getElementById('next-button');
            const progressBar = document.getElementById('progress-bar');
            const currentTimeElement = document.getElementById('current-time');
            const durationElement = document.getElementById('duration');
            const playerCover = document.getElementById('player-cover');
            const playerTitle = document.getElementById('player-title');
            const playerArtist = document.getElementById('player-artist');
            
            // تابع‌های پخش کننده
            let isPlaying = false;
            
            playPauseButton.addEventListener('click', function() {
                if (isPlaying) {
                    audioPlayer.pause();
                } else {
                    audioPlayer.play();
                }
            });
            
            audioPlayer.addEventListener('play', function() {
                isPlaying = true;
                playPauseButton.innerHTML = '<i class="fas fa-pause"></i>';
            });
            
            audioPlayer.addEventListener('pause', function() {
                isPlaying = false;
                playPauseButton.innerHTML = '<i class="fas fa-play"></i>';
            });
            
            audioPlayer.addEventListener('timeupdate', function() {
                const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                progressBar.style.width = percent + '%';
                
                const currentMinutes = Math.floor(audioPlayer.currentTime / 60);
                const currentSeconds = Math.floor(audioPlayer.currentTime % 60);
                currentTimeElement.textContent = `${currentMinutes}:${currentSeconds < 10 ? '0' : ''}${currentSeconds}`;
            });
            
            audioPlayer.addEventListener('loadedmetadata', function() {
                const durationMinutes = Math.floor(audioPlayer.duration / 60);
                const durationSeconds = Math.floor(audioPlayer.duration % 60);
                durationElement.textContent = `${durationMinutes}:${durationSeconds < 10 ? '0' : ''}${durationSeconds}`;
            });
            
            // گوش دادن به رویداد پخش آهنگ
            window.addEventListener('play-song', function(event) {
                const songData = event.detail;
                
                playerCover.src = songData.cover;
                playerTitle.textContent = songData.title;
                playerArtist.textContent = songData.artist;
                audioPlayer.src = songData.url;
                
                player.classList.remove('hidden');
                audioPlayer.play();
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>