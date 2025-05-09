@extends('layouts.admin')

@section('title', 'مدیریت موزیک‌ها')

@section('header', 'مدیریت موزیک‌ها')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">لیست موزیک‌ها</h2>
        <a href="{{ route('admin.songs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ml-1"></i>
            افزودن موزیک
        </a>
    </div>
    
    <!-- فیلترها -->
    <form action="{{ route('admin.songs.index') }}" method="GET" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">جستجو</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" 
                    class="form-input" placeholder="عنوان یا هنرمند...">
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">دسته‌بندی</label>
                <select id="category" name="category" 
                    class="form-input">
                    <option value="">همه دسته‌بندی‌ها</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="artist" class="block text-sm font-medium text-gray-700 mb-1">هنرمند</label>
                <select id="artist" name="artist" 
                    class="form-input">
                    <option value="">همه هنرمندان</option>
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}" {{ request('artist') == $artist->id ? 'selected' : '' }}>
                            {{ $artist->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search ml-1"></i>
                    جستجو
                </button>
            </div>
        </div>
    </form>
    
    <!-- جدول موزیک‌ها -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>موزیک</th>
                    <th>هنرمند</th>
                    <th>دسته‌بندی</th>
                    <th>تعداد پخش</th>
                    <th>وضعیت</th>
                    <th>تاریخ انتشار</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($songs as $song)
                    <tr>
                        <td class="flex items-center space-x-3 space-x-reverse">
                            @if ($song->cover_image)
                                <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="w-10 h-10 rounded object-cover">
                            @else
                                <div class="w-10 h-10 rounded bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-music text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <div class="font-medium">{{ $song->title }}</div>
                                @if ($song->album)
                                    <div class="text-xs text-gray-500">{{ $song->album->title }}</div>
                                @endif
                            </div>
                        </td>
                        <td>{{ $song->artist->name ?? 'نامشخص' }}</td>
                        <td>{{ $song->genre->name ?? 'نامشخص' }}</td>
                        <td>{{ number_format($song->plays) }}</td>
                        <td>
                            @if ($song->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">فعال</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">غیرفعال</span>
                            @endif
                            
                            @if ($song->is_featured)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs mr-1">ویژه</span>
                            @endif
                        </td>
                        <td>{{ $song->release_date ? \Morilog\Jalali\Jalalian::fromDateTime($song->release_date)->format('Y/m/d') : 'نامشخص' }}</td>
                        <td>
                            <div class="flex space-x-1 space-x-reverse">
                                <button type="button" class="btn btn-sm bg-blue-500 text-white hover:bg-blue-600 song-preview" data-song="{{ asset('storage/' . $song->file_path) }}" data-title="{{ $song->title }}">
                                    <i class="fas fa-play"></i>
                                </button>
                                
                                <a href="{{ route('admin.songs.edit', $song) }}" class="btn btn-sm bg-yellow-500 text-white hover:bg-yellow-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('admin.songs.destroy', $song) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm bg-red-500 text-white hover:bg-red-600" onclick="return confirm('آیا از حذف این موزیک اطمینان دارید؟')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">هیچ موزیکی یافت نشد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- پاگینیشن -->
    <div class="mt-4">
        {{ $songs->withQueryString()->links() }}
    </div>
</div>

<!-- پلیر پیش‌نمایش موزیک -->
<div id="audio-player" class="fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t border-gray-200 p-4 hidden">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4 space-x-reverse">
                <button id="play-pause-btn" class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center">
                    <i class="fas fa-pause"></i>
                </button>
                
                <div>
                    <div id="song-title" class="font-medium">عنوان موزیک</div>
                    <div class="text-sm text-gray-500">پیش‌نمایش موزیک</div>
                </div>
            </div>
            
            <div class="flex-1 mx-4">
                <div class="relative">
                    <div class="h-1 bg-gray-200 rounded">
                        <div id="progress-bar" class="h-1 bg-primary-500 rounded" style="width: 0%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span id="current-time">0:00</span>
                        <span id="duration">0:00</span>
                    </div>
                </div>
            </div>
            
            <button id="close-player" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <audio id="audio-element" src=""></audio>
</div>
@endsection

@section('scripts')
<script>
    // پلیر پیش‌نمایش موزیک
    document.addEventListener('DOMContentLoaded', function() {
        const audioPlayer = document.getElementById('audio-player');
        const audioElement = document.getElementById('audio-element');
        const playPauseBtn = document.getElementById('play-pause-btn');
        const songTitle = document.getElementById('song-title');
        const progressBar = document.getElementById('progress-bar');
        const currentTime = document.getElementById('current-time');
        const duration = document.getElementById('duration');
        const closePlayer = document.getElementById('close-player');
        
        // دکمه‌های پیش‌نمایش
        const previewButtons = document.querySelectorAll('.song-preview');
        
        previewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const songUrl = this.getAttribute('data-song');
                const title = this.getAttribute('data-title');
                
                audioElement.src = songUrl;
                songTitle.textContent = title;
                audioElement.play();
                audioPlayer.classList.remove('hidden');
                playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
            });
        });
        
        // دکمه پخش/توقف
        playPauseBtn.addEventListener('click', function() {
            if (audioElement.paused) {
                audioElement.play();
                this.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                audioElement.pause();
                this.innerHTML = '<i class="fas fa-play"></i>';
            }
        });
        
        // بستن پلیر
        closePlayer.addEventListener('click', function() {
            audioElement.pause();
            audioPlayer.classList.add('hidden');
        });
        
        // به‌روزرسانی پیشرفت پخش
        audioElement.addEventListener('timeupdate', function() {
            const percent = (audioElement.currentTime / audioElement.duration) * 100;
            progressBar.style.width = percent + '%';
            
            // نمایش زمان جاری
            const mins = Math.floor(audioElement.currentTime / 60);
            const secs = Math.floor(audioElement.currentTime % 60);
            currentTime.textContent = mins + ':' + (secs < 10 ? '0' : '') + secs;
        });
        
        // نمایش مدت زمان کل
        audioElement.addEventListener('loadedmetadata', function() {
            const mins = Math.floor(audioElement.duration / 60);
            const secs = Math.floor(audioElement.duration % 60);
            duration.textContent = mins + ':' + (secs < 10 ? '0' : '') + secs;
        });
        
        // پایان پخش
        audioElement.addEventListener('ended', function() {
            playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            progressBar.style.width = '0%';
        });
    });
</script>
@endsection