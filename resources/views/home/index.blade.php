@extends('layouts.app')

@section('title', 'صفحه اصلی')

@section('content')
    <!-- بخش قهرمان -->
    <section class="bg-music-pattern relative py-20 px-6 overflow-hidden">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <div class="relative z-10">
                        <h1 class="text-4xl md:text-5xl font-bold mb-6">
                            <span class="gradient-text">موزیک مورد علاقه‌تان</span> را کشف کنید
                        </h1>
                        <p class="text-lg text-gray-700 mb-8">
                            میلیون‌ها آهنگ، پادکست و کتاب صوتی. بدون نیاز به کارت اعتباری.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('home') }}" class="bg-primary-600 text-white px-6 py-3 rounded-full font-medium hover:bg-primary-700 transition-colors">
                                مرور موزیک‌ها
                            </a>
                            <a href="{{ route('home') }}" class="bg-white text-primary-600 px-6 py-3 rounded-full font-medium border border-primary-200 hover:bg-primary-50 transition-colors">
                                هنرمندان
                            </a>
                        </div>
                    </div>
                    
                    <!-- اشکال تزئینی -->
                    <div class="absolute top-10 left-10 w-20 h-20 bg-primary-100 rounded-full opacity-70 blur-lg"></div>
                    <div class="absolute bottom-10 right-10 w-32 h-32 bg-secondary-100 rounded-full opacity-70 blur-lg"></div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative">
                        <div class="w-64 h-64 bg-primary-100 rounded-full absolute top-0 right-0 -z-10"></div>
                        <div class="w-48 h-48 bg-secondary-100 rounded-full absolute bottom-0 left-0 -z-10"></div>
                        <img src="{{ asset('img/hero-image.png') }}" alt="Music Experience" class="relative z-10 max-w-full pulse-animation">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- شکل موج -->
        <div class="wave-shape">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- بخش آهنگ‌های محبوب -->
    <section class="py-16 px-6 bg-white">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold flex items-center">
                    <i class="fas fa-fire text-orange-500 mr-3"></i>
                    محبوب‌ترین آهنگ‌ها
                </h2>
                <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-700 flex items-center group">
                    مشاهده همه
                    <i class="fas fa-chevron-left mr-1 text-xs group-hover:mr-2 transition-all"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @if(isset($popularSongs) && count($popularSongs) > 0)
                    @foreach($popularSongs as $song)
                    <div class="card-hover bg-gray-50 rounded-lg overflow-hidden shadow-sm">
                        <div class="relative group">
                            <img src="{{ $song->cover ? asset('storage/' . $song->cover) : asset('img/default-cover.jpg') }}" 
                                alt="{{ $song->title }}" class="w-full aspect-square object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="play-song w-12 h-12 rounded-full bg-white text-primary-600 flex items-center justify-center hover:scale-110 transition-transform"
                                    data-song-id="{{ $song->id }}"
                                    data-song-title="{{ $song->title }}"
                                    data-song-artist="{{ $song->artist->name ?? 'Unknown Artist' }}"
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
                            <p class="text-sm text-gray-500">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-5 text-center py-10">
                        <div class="text-gray-400 text-5xl mb-4"><i class="fas fa-music"></i></div>
                        <p class="text-gray-500">هنوز آهنگی اضافه نشده است</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- بخش دسته‌بندی‌های موسیقی -->
    <section class="py-16 px-6 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold mb-10">دسته‌بندی‌های موسیقی</h2>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @if(isset($genres) && count($genres) > 0)
                    @foreach($genres as $genre)
                    <a href="{{ route('home') }}" class="card-hover block relative overflow-hidden rounded-lg h-32">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-secondary-500 opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ $genre->name }}</span>
                        </div>
                    </a>
                    @endforeach
                @elseif(isset($categories) && count($categories) > 0)
                    @foreach($categories as $category)
                    <a href="{{ route('home') }}" class="card-hover block relative overflow-hidden rounded-lg h-32">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-secondary-500 opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ $category->name }}</span>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="col-span-6 text-center py-10">
                        <div class="text-gray-400 text-5xl mb-4"><i class="fas fa-list"></i></div>
                        <p class="text-gray-500">هیچ دسته‌بندی یافت نشد</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- بخش هنرمندان محبوب -->
    <section class="py-16 px-6 bg-white">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold">هنرمندان محبوب</h2>
                <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-700 flex items-center group">
                    مشاهده همه
                    <i class="fas fa-chevron-left mr-1 text-xs group-hover:mr-2 transition-all"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @if(isset($artists) && count($artists) > 0)
                    @foreach($artists as $artist)
                    <a href="{{ route('home') }}" class="card-hover text-center">
                        <div class="mx-auto w-24 h-24 mb-3 overflow-hidden rounded-full border-2 border-white shadow-md">
                            <img src="{{ $artist->image ? asset('storage/' . $artist->image) : asset('img/default-artist.jpg') }}" 
                                alt="{{ $artist->name }}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-medium text-gray-800">{{ $artist->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $artist->songs_count ?? 0 }} آهنگ</p>
                    </a>
                    @endforeach
                @elseif(isset($popularArtists) && count($popularArtists) > 0)
                    @foreach($popularArtists as $artist)
                    <a href="{{ route('home') }}" class="card-hover text-center">
                        <div class="mx-auto w-24 h-24 mb-3 overflow-hidden rounded-full border-2 border-white shadow-md">
                            <img src="{{ $artist->image ? asset('storage/' . $artist->image) : asset('img/default-artist.jpg') }}" 
                                alt="{{ $artist->name }}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-medium text-gray-800">{{ $artist->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $artist->songs_count ?? 0 }} آهنگ</p>
                    </a>
                    @endforeach
                @else
                    <div class="col-span-6 text-center py-10">
                        <div class="text-gray-400 text-5xl mb-4"><i class="fas fa-microphone"></i></div>
                        <p class="text-gray-500">هیچ هنرمندی یافت نشد</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- بخش آلبوم‌های جدید -->
    <section class="py-16 px-6 bg-gray-50">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold">آلبوم‌های جدید</h2>
                <a href="{{ route('home') }}" class="text-primary-600 hover:text-primary-700 flex items-center group">
                    مشاهده همه
                    <i class="fas fa-chevron-left mr-1 text-xs group-hover:mr-2 transition-all"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @if(isset($newAlbums) && count($newAlbums) > 0)
                    @foreach($newAlbums as $album)
                    <a href="{{ route('home') }}" class="card-hover bg-white rounded-lg overflow-hidden shadow-sm">
                        <div class="relative">
                            <img src="{{ $album->cover ? asset('storage/' . $album->cover) : asset('img/default-album.jpg') }}" 
                                alt="{{ $album->title }}" class="w-full aspect-square object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium text-gray-800">{{ $album->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $album->artist->name ?? 'Unknown Artist' }}</p>
                            <div class="flex items-center mt-2">
                                <span class="text-xs text-gray-500">{{ $album->release_date ? $album->release_date->format('Y') : 'نامشخص' }}</span>
                                <span class="mx-2 text-gray-300">•</span>
                                <span class="text-xs text-gray-500">{{ $album->songs_count ?? 0 }} آهنگ</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @elseif(isset($albums) && count($albums) > 0)
                    @foreach($albums as $album)
                    <a href="{{ route('home') }}" class="card-hover bg-white rounded-lg overflow-hidden shadow-sm">
                        <div class="relative">
                            <img src="{{ $album->cover ? asset('storage/' . $album->cover) : asset('img/default-album.jpg') }}" 
                                alt="{{ $album->title }}" class="w-full aspect-square object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="font-medium text-gray-800">{{ $album->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $album->artist->name ?? 'Unknown Artist' }}</p>
                            <div class="flex items-center mt-2">
                                <span class="text-xs text-gray-500">{{ $album->release_date ? $album->release_date->format('Y') : 'نامشخص' }}</span>
                                <span class="mx-2 text-gray-300">•</span>
                                <span class="text-xs text-gray-500">{{ $album->songs_count ?? 0 }} آهنگ</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="col-span-4 text-center py-10">
                        <div class="text-gray-400 text-5xl mb-4"><i class="fas fa-compact-disc"></i></div>
                        <p class="text-gray-500">هیچ آلبومی یافت نشد</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    <!-- بخش اشتراک خبرنامه -->
    <section class="py-16 px-6 bg-music-pattern">
        <div class="container mx-auto max-w-4xl bg-white rounded-2xl shadow-lg p-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-32 h-32 bg-primary-100 rounded-full -translate-x-1/2 -translate-y-1/2 opacity-70"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-secondary-100 rounded-full translate-x-1/2 translate-y-1/2 opacity-70"></div>
            
            <div class="text-center relative z-10 max-w-2xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">به خبرنامه ما بپیوندید</h2>
                <p class="text-gray-600 mb-8">از آخرین آهنگ‌ها، آلبوم‌ها و اخبار دنیای موسیقی باخبر شوید</p>
                
                <form class="flex flex-col sm:flex-row gap-3">
                    <input type="email" placeholder="ایمیل خود را وارد کنید" class="flex-grow py-3 px-4 rounded-lg border border-gray-200 focus:outline-none focus:border-primary-500">
                    <button type="submit" class="bg-primary-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                        عضویت
                    </button>
                </form>
            </div>
        </div>
    </section>
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