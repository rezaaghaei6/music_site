@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- هدر دسته‌بندی -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-gray-600">{{ $category->description }}</p>
        @endif
    </div>
    
    <!-- فیلترها -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-8">
        <form action="{{ route('category.show', $category->slug) }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">مرتب‌سازی</label>
                <select id="sort" name="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>جدیدترین</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>محبوب‌ترین</option>
                    <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>نام (الف تا ی)</option>
                    <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>نام (ی تا الف)</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded-md hover:bg-primary-600 transition-colors">
                    اعمال فیلترها
                </button>
            </div>
        </form>
    </div>
    
    <!-- لیست آهنگ‌ها -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse($songs as $song)
            <div class="card-hover bg-white rounded-lg overflow-hidden shadow-sm">
                <div class="relative group">
                    <img src="{{ $song->cover ? asset('storage/' . $song->cover) : asset('img/default-cover.jpg') }}" 
                        alt="{{ $song->title }}" class="w-full aspect-square object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="play-song w-12 h-12 rounded-full bg-white text-primary-600 flex items-center justify-center hover:scale-110 transition-transform"
                            data-song-id="{{ $song->id }}"
                            data-song-title="{{ $song->title }}"
                            data-song-artist="{{ $song->artist->name }}"
                            data-song-cover="{{ $song->cover ? asset('storage/' . $song->cover) : asset('img/default-cover.jpg') }}"
                            data-song-url="{{ asset('storage/' . $song->file_path) }}">
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                    @if($song->is_featured)
                        <span class="absolute top-2 right-2 bg-primary-500 text-white text-xs px-2 py-1 rounded-full">ویژه</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-medium text-gray-800 truncate">{{ $song->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $song->artist->name }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-gray-500">{{ $song->created_at->diffForHumans() }}</span>
                        <span class="text-xs text-gray-500">
                            <i class="fas fa-play mr-1"></i> {{ $song->plays }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-music text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500">هیچ موزیکی در این دسته‌بندی یافت نشد.</p>
            </div>
        @endforelse
    </div>
    
    <!-- صفحه‌بندی -->
    <div class="mt-8">
        {{ $songs->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // اسکریپت پخش آهنگ
        const playButtons = document.querySelectorAll('.play-song');
        
        playButtons.forEach(button => {
            button.addEventListener('click', function() {
                const songId = this.getAttribute('data-song-id');
                const songUrl = this.getAttribute('data-song-url');
                const songTitle = this.getAttribute('data-song-title');
                const songArtist = this.getAttribute('data-song-artist');
                const songCover = this.getAttribute('data-song-cover');
                
                // ارسال اطلاعات به پخش‌کننده
                window.dispatchEvent(new CustomEvent('play-song', {
                    detail: {
                        id: songId,
                        url: songUrl,
                        title: songTitle,
                        artist: songArtist,
                        cover: songCover
                    }
                }));
            });
        });
    });
</script>
@endsection