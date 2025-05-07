<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سایت موزیک</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url('/fonts/Vazir.eot');
            src: url('/fonts/Vazir.eot?#iefix') format('embedded-opentype'),
                 url('/fonts/Vazir.woff2') format('woff2'),
                 url('/fonts/Vazir.woff') format('woff'),
                 url('/fonts/Vazir.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        body {
            font-family: 'Vazir', Tahoma, Arial, sans-serif;
            background-color: #f8f9fa;
        }
        
        .highlight {
            color: #3b82f6;
        }
        
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .hero {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            color: white;
        }
        
        .categories {
            margin: 60px 0;
        }
        
        .categories h2, .featured h2, .latest h2 {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 40px;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .category-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .card-image {
            height: 150px;
            background-color: #edf2f7;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .default-icon {
            font-size: 3rem;
        }
        
        .card-content {
            padding: 20px;
        }
        
        .card-content h3 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .card-content p {
            color: #6b7280;
            margin-bottom: 15px;
        }
        
        .featured, .latest {
            margin: 60px 0;
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }
        
        .music-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
        }
        
        .music-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .music-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .music-image {
            height: 180px;
            background-color: #edf2f7;
            position: relative;
        }
        
        .play-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .play-button:hover {
            background: #3b82f6;
            color: white;
        }
        
        .music-content {
            padding: 15px;
        }
        
        .music-content h3 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .music-content p {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 5px;
        }
        
        .music-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #9ca3af;
        }
        
        .footer {
            background-color: #1f2937;
            color: white;
            padding: 50px 0 20px;
            margin-top: 80px;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }
        
        .footer h3 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .footer-bottom {
            text-align: center;
            border-top: 1px solid #374151;
            margin-top: 30px;
            padding-top: 20px;
            color: #9ca3af;
            font-size: 0.875rem;
        }
        
        @media (max-width: 768px) {
            .categories-grid, .music-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            }
        }
        
        @media (max-width: 480px) {
            .categories-grid, .music-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold">سایت موزیک</a>
                <nav>
                    <ul class="flex space-x-6 space-x-reverse">
                        <li><a href="/" class="text-blue-600 hover:text-blue-800">صفحه اصلی</a></li>
                        <li><a href="/artists" class="text-gray-700 hover:text-blue-600">خوانندگان</a></li>
                        <li><a href="/albums" class="text-gray-700 hover:text-blue-600">آلبوم‌ها</a></li>
                        <li><a href="/songs" class="text-gray-700 hover:text-blue-600">موزیک‌ها</a></li>
                        @auth
                            <li><a href="/admin" class="text-gray-700 hover:text-blue-600">پنل مدیریت</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800">خروج</button>
                                </form>
                            </li>
                        @else
                            <li><a href="/login" class="text-gray-700 hover:text-blue-600">ورود</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl font-bold mb-4">بهترین موزیک‌ها را آنلاین گوش دهید</h1>
                    <p class="text-lg mb-8 opacity-90">دسترسی به هزاران موزیک با کیفیت بالا از خوانندگان محبوب</p>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="/songs" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-bold">مشاهده موزیک‌ها</a>
                        <a href="/artists" class="bg-blue-700 text-white hover:bg-blue-800 px-6 py-3 rounded-lg font-bold">خوانندگان</a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://placehold.co/600x400?text=موزیک" alt="موزیک" class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- دسته‌بندی‌های موسیقی با کارت‌های متحرک -->
    <div id="categories" class="categories">
        <h2>دسته‌بندی‌های <span class="highlight">موسیقی</span></h2>
        <div class="categories-grid">
            @php
            $categories = [
                [
                    'name' => 'پاپ',
                    'icon' => '📱',
                    'description' => 'محبوب‌ترین سبک موسیقی'
                ],
                [
                    'name' => 'سنتی',
                    'icon' => '🏛️',
                    'description' => 'موسیقی اصیل ایرانی'
                ],
                [
                    'name' => 'راک',
                    'icon' => '🎤',
                    'description' => 'انرژی و هیجان'
                ],
                [
                    'name' => 'بین‌المللی',
                    'icon' => '🌍',
                    'description' => 'موسیقی از سراسر جهان'
                ]
            ];
            @endphp
            
            @foreach($categories as $index => $category)
                <div class="category-card">
                    <div class="card-image">
                        <div class="default-icon">
                            @if($index == 0)
                                📱
                            @elseif($index == 1)
                                🏛️
                            @elseif($index == 2)
                                🎤
                            @elseif($index == 3)
                                🌍
                            @endif
                        </div>
                    </div>
                    <div class="card-content">
                        <h3>{{ $category['name'] }}</h3>
                        <p>{{ $category['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- خوانندگان برتر -->
    <div class="featured">
        <h2>خوانندگان <span class="highlight">برتر</span></h2>
        <div class="music-grid">
            @if(isset($featuredArtists) && $featuredArtists->count() > 0)
                @foreach($featuredArtists as $artist)
                    <div class="music-card">
                        <div class="music-image">
                            @if($artist->image)
                                <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <span class="text-4xl">🎤</span>
                                </div>
                            @endif
                        </div>
                        <div class="music-content">
                            <h3>{{ $artist->name }}</h3>
                            <div class="music-stats">
                                <span>{{ $artist->songs->count() }} موزیک</span>
                                <span>{{ $artist->albums->count() }} آلبوم</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @for($i = 0; $i < 4; $i++)
                    <div class="music-card">
                        <div class="music-image">
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <span class="text-4xl">🎤</span>
                            </div>
                        </div>
                        <div class="music-content">
                            <h3>نام خواننده</h3>
                            <div class="music-stats">
                                <span>0 موزیک</span>
                                <span>0 آلبوم</span>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>

    <!-- آخرین موزیک‌ها -->
    <div class="latest">
        <h2>آخرین <span class="highlight">موزیک‌ها</span></h2>
        <div class="music-grid">
            @if(isset($latestSongs) && $latestSongs->count() > 0)
                @foreach($latestSongs as $song)
                    <div class="music-card">
                        <div class="music-image">
                            @if($song->cover)
                                <img src="{{ asset('storage/' . $song->cover) }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <span class="text-4xl">🎵</span>
                                </div>
                            @endif
                            <div class="play-button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="music-content">
                            <h3>{{ $song->title }}</h3>
                            <p>{{ $song->artist->name }}</p>
                            <div class="music-stats">
                                <span>{{ $song->album ? $song->album->title : 'تک آهنگ' }}</span>
                                <span>{{ $song->plays }} بازدید</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @for($i = 0; $i < 8; $i++)
                    <div class="music-card">
                        <div class="music-image">
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <span class="text-4xl">🎵</span>
                            </div>
                            <div class="play-button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="music-content">
                            <h3>عنوان موزیک</h3>
                            <p>نام خواننده</p>
                            <div class="music-stats">
                                <span>نام آلبوم</span>
                                <span>0 بازدید</span>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div>
                <h3>سایت موزیک</h3>
                <p class="text-gray-400 mb-4">بهترین و جدیدترین موزیک‌ها را آنلاین گوش دهید</p>
            </div>
            
            <div>
                <h3>دسترسی سریع</h3>
                <ul class="footer-links">
                    <li><a href="/">صفحه اصلی</a></li>
                    <li><a href="/artists">خوانندگان</a></li>
                    <li><a href="/albums">آلبوم‌ها</a></li>
                    <li><a href="/songs">موزیک‌ها</a></li>
                </ul>
            </div>
            
            <div>
                <h3>ژانرها</h3>
                <ul class="footer-links">
                    <li><a href="#">پاپ</a></li>
                    <li><a href="#">سنتی</a></li>
                    <li><a href="#">راک</a></li>
                    <li><a href="#">بین‌المللی</a></li>
                </ul>
            </div>
            
            <div>
                <h3>تماس با ما</h3>
                <ul class="footer-links">
                    <li>آدرس: تهران، خیابان ولیعصر</li>
                    <li>تلفن: 021-12345678</li>
                    <li>ایمیل: info@musicsite.com</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} سایت موزیک. تمامی حقوق محفوظ است.</p>
        </div>
    </footer>
</body>
</html>