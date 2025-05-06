@extends('layouts.app')

@section('content')
<!-- بخش قهرمان با انیمیشن -->
<div class="hero animated-bg">
    <div class="hero-content">
        <h1 class="animated-title">دنیای <span class="highlight">موسیقی</span> را کشف کنید</h1>
        <p class="animated-subtitle">بهترین آهنگ‌های روز دنیا در یک پلتفرم</p>
        <a href="#categories" class="button pulse-btn">شروع کنید</a>
    </div>
    <div class="wave-animation">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</div>

<!-- بخش پخش کننده برتر -->
<div class="featured-player">
    <h2>پیشنهاد <span class="highlight">ویژه</span></h2>
    <div class="player-container">
        <div class="album-cover">
            <div class="default-icon">🎵</div>
        </div>
        <div class="player-controls">
            <div class="song-info">
                <h3>عنوان آهنگ</h3>
                <p>خواننده</p>
            </div>
            <div class="controls">
                <button class="prev-btn">قبلی</button>
                <button class="play-btn">پخش</button>
                <button class="next-btn">بعدی</button>
            </div>
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
        </div>
    </div>
</div>

<!-- دسته‌بندی‌های موسیقی با کارت‌های متحرک -->
<div id="categories" class="categories">
    <h2>دسته‌بندی‌های <span class="highlight">موسیقی</span></h2>
    <div class="categories-grid">
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
                        @else
                            🧘
                        @endif
                    </div>
                </div>
                <div class="card-content">
                    <h3>{{ $category['name'] }}</h3>
                    <p>بهترین آهنگ‌های {{ $category['name'] }} را گوش دهید</p>
                    <a href="{{ route('category', $category['name']) }}" class="card-btn">مشاهده</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- بخش آهنگ‌های پرطرفدار -->
<div id="trending" class="trending">
    <h2>آهنگ‌های <span class="highlight">پرطرفدار</span></h2>
    <div class="trending-grid">
        <div class="trending-item">
            <div class="default-icon">🎵</div>
            <h3>عنوان آهنگ ۱</h3>
            <p>خواننده ۱</p>
            <div class="play-icon">▶️</div>
        </div>
        <div class="trending-item">
            <div class="default-icon">🎵</div>
            <h3>عنوان آهنگ ۲</h3>
            <p>خواننده ۲</p>
            <div class="play-icon">▶️</div>
        </div>
        <div class="trending-item">
            <div class="default-icon">🎵</div>
            <h3>عنوان آهنگ ۳</h3>
            <p>خواننده ۳</p>
            <div class="play-icon">▶️</div>
        </div>
    </div>
</div>

<!-- بخش آمار -->
<div class="stats-section">
    <div class="stat-item">
        <div class="stat-number">۱۰۰۰+</div>
        <div class="stat-label">آهنگ</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">۵۰+</div>
        <div class="stat-label">هنرمند</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">۲۰+</div>
        <div class="stat-label">ژانر</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">۱۰۰۰۰+</div>
        <div class="stat-label">کاربر</div>
    </div>
</div>

<!-- خبرنامه -->
<div id="newsletter" class="newsletter">
    <h2>از آخرین <span class="highlight">آهنگ‌ها</span> باخبر شوید</h2>
    <p>برای دریافت آخرین اخبار موسیقی، ایمیل خود را وارد کنید</p>
    <form class="newsletter-form">
        <input type="email" placeholder="ایمیل خود را وارد کنید">
        <button type="submit">عضویت</button>
    </form>
</div>
@endsection