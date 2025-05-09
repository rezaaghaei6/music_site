@extends('layouts.admin')

@section('title', 'داشبورد مدیریت')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium mb-8">داشبورد</h3>

    <!-- آمار کلی -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- تعداد موزیک‌ها -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
                <i class="fas fa-music text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    موزیک‌ها
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ number_format($totalSongs) }}
                </p>
            </div>
        </div>

        <!-- تعداد هنرمندان -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                <i class="fas fa-microphone text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    هنرمندان
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ number_format($totalArtists) }}
                </p>
            </div>
        </div>

        <!-- تعداد آلبوم‌ها -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                <i class="fas fa-compact-disc text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    آلبوم‌ها
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ number_format($totalAlbums) }}
                </p>
            </div>
        </div>

        <!-- تعداد پخش -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full">
                <i class="fas fa-play text-xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    پخش‌ها
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ number_format($totalPlays) }}
                </p>
            </div>
        </div>
    </div>

    <!-- بخش اصلی -->
    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <!-- آخرین موزیک‌ها -->
        <div class="bg-white rounded-lg shadow-xs">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold text-gray-700">آخرین موزیک‌ها</h2>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-right text-gray-500 uppercase border-b">
                                <th class="px-4 py-3">عنوان</th>
                                <th class="px-4 py-3">هنرمند</th>
                                <th class="px-4 py-3">تاریخ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @forelse($latestSongs as $song)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <!-- تصویر موزیک -->
                                            <div class="relative hidden w-8 h-8 ml-3 rounded-full md:block">
                                                @if($song->cover_image)
                                                    <img class="object-cover w-full h-full rounded-full" src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" loading="lazy" />
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <i class="fas fa-music text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $song->title }}</p>
                                                @if($song->album)
                                                    <p class="text-xs text-gray-600">{{ $song->album->title }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $song->artist->name ?? 'نامشخص' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $song->created_at->format('Y/m/d') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-sm text-center text-gray-500">
                                        موزیکی یافت نشد.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.songs.index') }}" class="text-sm text-blue-600 hover:underline">
                        مشاهده همه موزیک‌ها
                    </a>
                </div>
            </div>
        </div>

        <!-- پربازدیدترین موزیک‌ها -->
        <div class="bg-white rounded-lg shadow-xs">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold text-gray-700">پربازدیدترین موزیک‌ها</h2>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-right text-gray-500 uppercase border-b">
                                <th class="px-4 py-3">عنوان</th>
                                <th class="px-4 py-3">هنرمند</th>
                                <th class="px-4 py-3">تعداد پخش</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @forelse($popularSongs as $song)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <!-- تصویر موزیک -->
                                            <div class="relative hidden w-8 h-8 ml-3 rounded-full md:block">
                                                @if($song->cover_image)
                                                    <img class="object-cover w-full h-full rounded-full" src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" loading="lazy" />
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <i class="fas fa-music text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $song->title }}</p>
                                                @if($song->album)
                                                    <p class="text-xs text-gray-600">{{ $song->album->title }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $song->artist->name ?? 'نامشخص' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ number_format($song->plays) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-sm text-center text-gray-500">
                                        موزیکی یافت نشد.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- نمودار و آمار به تفکیک ژانر -->
    <div class="bg-white rounded-lg shadow-xs p-4">
        <div class="border-b pb-4">
            <h2 class="text-lg font-semibold text-gray-700">آمار موزیک‌ها به تفکیک ژانر</h2>
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($songsByGenre as $genre)
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-gray-700 mb-2">{{ $genre->songs_count }}</div>
                        <div class="text-sm text-gray-600">{{ $genre->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- لینک‌های سریع -->
    <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <a href="{{ route('admin.songs.create') }}" class="transform hover:scale-105 transition-transform duration-200 bg-white rounded-lg shadow-xs p-4 flex items-center">
            <div class="p-3 ml-4 text-blue-500 bg-blue-100 rounded-full">
                <i class="fas fa-plus text-xl"></i>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">افزودن موزیک جدید</p>
                <p class="text-sm text-gray-600">آپلود و ثبت موزیک جدید</p>
            </div>
        </a>

        <a href="{{ route('admin.artists.create') }}" class="transform hover:scale-105 transition-transform duration-200 bg-white rounded-lg shadow-xs p-4 flex items-center">
            <div class="p-3 ml-4 text-green-500 bg-green-100 rounded-full">
                <i class="fas fa-user-plus text-xl"></i>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">افزودن هنرمند</p>
                <p class="text-sm text-gray-600">ثبت هنرمند جدید</p>
            </div>
        </a>

        <a href="{{ route('admin.albums.create') }}" class="transform hover:scale-105 transition-transform duration-200 bg-white rounded-lg shadow-xs p-4 flex items-center">
            <div class="p-3 ml-4 text-purple-500 bg-purple-100 rounded-full">
                <i class="fas fa-compact-disc text-xl"></i>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">افزودن آلبوم</p>
                <p class="text-sm text-gray-600">ثبت آلبوم جدید</p>
            </div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="transform hover:scale-105 transition-transform duration-200 bg-white rounded-lg shadow-xs p-4 flex items-center">
            <div class="p-3 ml-4 text-yellow-500 bg-yellow-100 rounded-full">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">مدیریت کاربران</p>
                <p class="text-sm text-gray-600">مشاهده و مدیریت کاربران</p>
            </div>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // اگر نیاز به نمودار دارید، می‌توانید اینجا اضافه کنید
</script>
@endsection