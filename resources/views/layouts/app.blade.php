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
            margin: 0;
            padding: 0;
        }
        
        .highlight {
            color: #3b82f6;
        }
        
        /* Header Styles */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        nav ul {
            display: flex;
            gap: 25px;
            list-style: none;
            padding: 0;
        }
        
        nav a {
            text-decoration: none;
            transition: color 0.3s;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .animated-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease;
        }
        
        .animated-subtitle {
            font-size: 1.25rem;
            margin-bottom: 30px;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.2s forwards;
        }
        
        .button {
            display: inline-block;
            background: white;
            color: #3b82f6;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: bold;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeInUp 1s ease 0.4s forwards;
        }
        
        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .pulse-btn {
            animation: pulse 2s infinite;
        }
        
        .wave-animation {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            z-index: 1;
        }
        
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="%23FFFFFF"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="%23FFFFFF"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%23FFFFFF"/></svg>') no-repeat;
            background-size: cover;
            animation: wave 10s linear infinite;
        }
        
        .wave:nth-child(2) {
            animation-delay: 3s;
            opacity: 0.7;
        }
        
        .wave:nth-child(3) {
            animation-delay: 6s;
            opacity: 0.5;
        }
        
        /* Featured Player */
        .featured-player {
            padding: 60px 0;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .featured-player h2 {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 40px;
        }
        
        .player-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
        }
        
        .album-cover {
            width: 200px;
            height: 200px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .album-cover .default-icon {
            font-size: 5rem;
        }
        
        .player-controls {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .song-info h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .song-info p {
            color: #666;
            margin-bottom: 20px;
        }
        
        .controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .controls button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .prev-btn, .next-btn {
            background: #f0f0f0;
        }
        
        .play-btn {
            background: #3b82f6;
            color: white;
            padding: 10px 30px;
        }
        
        .progress-bar {
            height: 5px;
            background: #eee;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .progress {
            width: 30%;
            height: 100%;
            background: #3b82f6;
        }
        
        /* Categories */
        .categories {
            padding: 60px 0;
        }
        
        .categories h2 {
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .card-image {
            height: 150px;
            background: #f0f0f0;
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
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        
        .card-btn {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        
        .card-btn:hover {
            background: #2563eb;
        }
        
        /* Trending Section */
        .trending {
            padding: 60px 0;
            background: #f9fafb;
        }
        
        .trending h2 {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 40px;
        }
        
        .trending-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .trending-item {
            background: white;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            cursor: pointer;
        }
        
        .trending-item:hover {
            transform: translateY(-5px);
        }
        
        .trending-item .default-icon {
            font-size: 2.5rem;
            margin-right: 20px;
        }
        
        .trending-item h3 {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .trending-item p {
            color: #666;
        }
        
        .play-icon {
            margin-left: auto;
            font-size: 1.5rem;
        }
        
        /* Stats Section */
        .stats-section {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transform: translateY(50px);
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 10px;
        }
        
        .stat-label {
            font-size: 1.25rem;
            color: #666;
        }
        
        /* Newsletter */
        .newsletter {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            color: white;
            padding: 100px 20px 60px;
            text-align: center;
        }
        
        .newsletter h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .newsletter p {
            max-width: 600px;
            margin: 0 auto 30px;
            opacity: 0.9;
        }
        
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .newsletter-form input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 5px 0 0 5px;
            font-size: 1rem;
        }
        
        .newsletter-form button {
            background: #1e40af;
            color: white;
            border: none;
            padding: 0 30px;
            border-radius: 0 5px 5px 0;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .newsletter-form button:hover {
            background: #1e3a8a;
        }
        
        /* Footer */
        footer {
            background: #1f2937;
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }
        
        footer h3 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
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
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #374151;
            color: #9ca3af;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }
        
        @keyframes wave {
            0% {
                transform: translateX(0) translateZ(0) scaleY(1);
            }
            50% {
                transform: translateX(-25%) translateZ(0) scaleY(0.8);
            }
            100% {
                transform: translateX(-50%) translateZ(0) scaleY(1);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .player-container {
                flex-direction: column;
            }
            
            .album-cover {
                width: 100%;
                height: 200px;
            }
            
            .stats-section {
                padding: 40px 20px;
            }
            
            .stat-item {
                width: 50%;
                margin-bottom: 30px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-form input {
                border-radius: 5px;
                margin-bottom: 10px;
            }
            
            .newsletter-form button {
                border-radius: 5px;
                padding: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .animated-title {
                font-size: 2rem;
            }
            
            .categories-grid, .trending-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-item {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold">سایت موزیک</a>
                <nav>
                    <ul>
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

    <main>
        @yield('content')
    </main>

    <footer>
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