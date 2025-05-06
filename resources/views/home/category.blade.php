@extends('layouts.app')

@section('content')
<div class="category-header">
    <h1>{{ $name }}</h1>
    <p>بهترین آهنگ‌های {{ $name }} را کشف کنید</p>
</div>

<div class="category-content">
    <div class="filter-bar">
        <div class="filter-item active">همه</div>
        <div class="filter-item">جدیدترین</div>
        <div class="filter-item">محبوب‌ترین</div>
        <div class="filter-item">قدیمی</div>
    </div>

    <div class="songs-grid">
        <!-- نمونه آهنگ‌ها -->
        <div class="song-item">
            <div class="default-icon">🎵</div>
            <div class="song-info">
                <h3>عنوان آهنگ ۱</h3>
                <p>خواننده ۱</p>
            </div>
            <div class="song-actions">
                <button class="play-btn">▶️</button>
                <button class="like-btn">❤️</button>
            </div>
        </div>
        
        <div class="song-item">
            <div class="default-icon">🎵</div>
            <div class="song-info">
                <h3>عنوان آهنگ ۲</h3>
                <p>خواننده ۲</p>
            </div>
            <div class="song-actions">
                <button class="play-btn">▶️</button>
                <button class="like-btn">❤️</button>
            </div>
        </div>
        
        <div class="song-item">
            <div class="default-icon">🎵</div>
            <div class="song-info">
                <h3>عنوان آهنگ ۳</h3>
                <p>خواننده ۳</p>
            </div>
            <div class="song-actions">
                <button class="play-btn">▶️</button>
                <button class="like-btn">❤️</button>
            </div>
        </div>
        
        <div class="song-item">
            <div class="default-icon">🎵</div>
            <div class="song-info">
                <h3>عنوان آهنگ ۴</h3>
                <p>خواننده ۴</p>
            </div>
            <div class="song-actions">
                <button class="play-btn">▶️</button>
                <button class="like-btn">❤️</button>
            </div>
        </div>
        
        <div class="song-item">
            <div class="default-icon">🎵</div>
            <div class="song-info">
                <h3>عنوان آهنگ ۵</h3>
                <p>خواننده ۵</p>
            </div>
            <div class="song-actions">
                <button class="play-btn">▶️</button>
                <button class="like-btn">❤️</button>
            </div>
        </div>
        
        <div class="song-item">
            <div class="default-icon">🎵</div>
            <div class="song-info">
                <h3>عنوان آهنگ ۶</h3>
                <p>خواننده ۶</p>
            </div>
            <div class="song-actions">
                <button class="play-btn">▶️</button>
                <button class="like-btn">❤️</button>
            </div>
        </div>
    </div>
</div>
@endsection