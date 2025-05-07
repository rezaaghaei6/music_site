<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد | پنل مدیریت</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white h-screen shadow-md">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">پنل مدیریت</h2>
            </div>
            <nav class="p-4">
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded text-blue-600 bg-blue-100">داشبورد</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.artists.index') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">خوانندگان</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.albums.index') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">آلبوم‌ها</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.songs.index') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">موزیک‌ها</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.genres.index') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">ژانرها</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.playlists.index') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">لیست‌های پخش</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.users') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">کاربران</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.settings') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">تنظیمات</a>
                    </li>
                    <li class="mt-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left p-2 rounded text-red-600 hover:bg-red-100">خروج</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">داشبورد</h1>
                <div class="text-gray-600">
                    خوش آمدید، {{ Auth::user()->name }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-lg font-semibold mb-1 text-gray-700">خوانندگان</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Artist::count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-lg font-semibold mb-1 text-gray-700">آلبوم‌ها</h3>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Album::count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-lg font-semibold mb-1 text-gray-700">موزیک‌ها</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Song::count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-lg font-semibold mb-1 text-gray-700">کاربران</h3>
                            <p class="text-3xl font-bold text-purple-600">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Latest Songs -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">آخرین موزیک‌ها</h2>
                    <a href="{{ route('admin.songs.index') }}" class="text-blue-600 hover:text-blue-800">مشاهده همه</a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-right">عنوان</th>
                                <th class="py-3 px-4 text-right">خواننده</th>
                                <th class="py-3 px-4 text-right">آلبوم</th>
                                <th class="py-3 px-4 text-right">تعداد پخش</th>
                                <th class="py-3 px-4 text-right">تاریخ انتشار</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (\App\Models\Song::with(['artist', 'album'])->orderBy('created_at', 'desc')->limit(5)->get() as $song)
                                <tr class="border-t">
                                    <td class="py-3 px-4">{{ $song->title }}</td>
                                    <td class="py-3 px-4">{{ $song->artist->name }}</td>
                                    <td class="py-3 px-4">{{ $song->album ? $song->album->title : '-' }}</td>
                                    <td class="py-3 px-4">{{ $song->plays }}</td>
                                    <td class="py-3 px-4">{{ $song->created_at->format('Y/m/d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">هیچ موزیکی یافت نشد.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Latest Artists -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">آخرین خوانندگان</h2>
                    <a href="{{ route('admin.artists.index') }}" class="text-blue-600 hover:text-blue-800">مشاهده همه</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse (\App\Models\Artist::orderBy('created_at', 'desc')->limit(4)->get() as $artist)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="h-40 bg-gray-300 relative">
                                @if ($artist->image)
                                    <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <span class="text-4xl text-gray-500">{{ substr($artist->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">{{ $artist->name }}</h3>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>{{ $artist->songs->count() }} موزیک</span>
                                    <span>{{ $artist->albums->count() }} آلبوم</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
                            هیچ خواننده‌ای یافت نشد.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>