<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artist->name }} | پنل مدیریت</title>
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
                        <a href="{{ url('/admin') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">داشبورد</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/artists') }}" class="block p-2 rounded text-blue-600 bg-blue-100">خوانندگان</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/albums') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">آلبوم‌ها</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/songs') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">موزیک‌ها</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/users') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">کاربران</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/settings') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">تنظیمات</a>
                    </li>
                    <li class="mt-6">
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left p-2 rounded text-red-600 hover:bg-red-100">خروج</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex items-center mb-6">
                <a href="{{ route('admin.artists.index') }}" class="text-gray-600 hover:text-gray-800 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">جزئیات خواننده</h1>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4 mb-4 md:mb-0">
                        @if ($artist->image)
                            <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="w-full h-auto rounded-lg">
                        @else
                            <div class="w-full h-48 bg-gray-300 rounded-lg flex items-center justify-center">
                                <span class="text-4xl text-gray-500">{{ substr($artist->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="md:w-3/4 md:pr-6">
                        <h2 class="text-2xl font-bold mb-2">{{ $artist->name }}</h2>
                        
                        @if ($artist->is_featured)
                            <div class="mb-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">خواننده ویژه</span>
                            </div>
                        @endif
                        
                        @if ($artist->bio)
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">بیوگرافی:</h3>
                                <p class="text-gray-700 whitespace-pre-line">{{ $artist->bio }}</p>
                            </div>
                        @endif
                        
                        <div class="flex space-x-2 space-x-reverse mt-4">
                            <a href="{{ route('admin.artists.edit', $artist) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                ویرایش
                            </a>
                            <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" onsubmit="return confirm('آیا از حذف این خواننده اطمینان دارید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- آلبوم‌های خواننده -->
            <h2 class="text-2xl font-bold mb-4">آلبوم‌ها</h2>
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                @if ($artist->albums->count() > 0)
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-right">تصویر</th>
                                <th class="py-3 px-4 text-right">عنوان</th>
                                <th class="py-3 px-4 text-right">سال انتشار</th>
                                <th class="py-3 px-4 text-right">تعداد موزیک</th>
                                <th class="py-3 px-4 text-right">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artist->albums as $album)
                                <tr class="border-t">
                                    <td class="py-3 px-4">
                                        @if ($album->cover)
                                            <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->title }}" class="h-10 w-10 rounded object-cover">
                                        @else
                                            <div class="h-10 w-10 rounded bg-gray-300 flex items-center justify-center">
                                                <span class="text-gray-500">{{ substr($album->title, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">{{ $album->title }}</td>
                                    <td class="py-3 px-4">{{ $album->release_year }}</td>
                                    <td class="py-3 px-4">{{ $album->songs->count() }}</td>
                                    <td class="py-3 px-4">
                                        <a href="#" class="text-blue-600 hover:text-blue-800">مشاهده</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="py-6 text-center text-gray-500">هیچ آلبومی برای این خواننده ثبت نشده است.</div>
                @endif
            </div>
            
            <!-- موزیک‌های خواننده -->
            <h2 class="text-2xl font-bold mb-4">موزیک‌ها</h2>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if ($artist->songs->count() > 0)
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-right">تصویر</th>
                                <th class="py-3 px-4 text-right">عنوان</th>
                                <th class="py-3 px-4 text-right">آلبوم</th>
                                <th class="py-3 px-4 text-right">ژانر</th>
                                <th class="py-3 px-4 text-right">تعداد پخش</th>
                                <th class="py-3 px-4 text-right">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artist->songs as $song)
                                <tr class="border-t">
                                    <td class="py-3 px-4">
                                        @if ($song->cover)
                                            <img src="{{ asset('storage/' . $song->cover) }}" alt="{{ $song->title }}" class="h-10 w-10 rounded object-cover">
                                        @else
                                            <div class="h-10 w-10 rounded bg-gray-300 flex items-center justify-center">
                                                <span class="text-gray-500">{{ substr($song->title, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">{{ $song->title }}</td>
                                    <td class="py-3 px-4">{{ $song->album ? $song->album->title : '-' }}</td>
                                    <td class="py-3 px-4">{{ $song->genre ? $song->genre->name : '-' }}</td>
                                    <td class="py-3 px-4">{{ $song->plays }}</td>
                                    <td class="py-3 px-4">
                                        <a href="#" class="text-blue-600 hover:text-blue-800">مشاهده</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="py-6 text-center text-gray-500">هیچ موزیکی برای این خواننده ثبت نشده است.</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
