<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت خوانندگان | پنل مدیریت</title>
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">مدیریت خوانندگان</h1>
                <a href="{{ route('admin.artists.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    افزودن خواننده جدید
                </a>
            </div>
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 text-right">تصویر</th>
                            <th class="py-3 px-4 text-right">نام</th>
                            <th class="py-3 px-4 text-right">تعداد آلبوم</th>
                            <th class="py-3 px-4 text-right">تعداد موزیک</th>
                            <th class="py-3 px-4 text-right">ویژه</th>
                            <th class="py-3 px-4 text-right">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($artists as $artist)
                            <tr class="border-t">
                                <td class="py-3 px-4">
                                    @if ($artist->image)
                                        <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-gray-500">{{ substr($artist->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4">{{ $artist->name }}</td>
                                <td class="py-3 px-4">{{ $artist->albums->count() }}</td>
                                <td class="py-3 px-4">{{ $artist->songs->count() }}</td>
                                <td class="py-3 px-4">
                                    @if ($artist->is_featured)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">بله</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">خیر</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-2 space-x-reverse">
                                        <a href="{{ route('admin.artists.show', $artist) }}" class="text-blue-600 hover:text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.artists.edit', $artist) }}" class="text-yellow-600 hover:text-yellow-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" onsubmit="return confirm('آیا از حذف این خواننده اطمینان دارید؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">هیچ خواننده‌ای یافت نشد.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $artists->links() }}
            </div>
        </div>
    </div>
</body>
</html>
