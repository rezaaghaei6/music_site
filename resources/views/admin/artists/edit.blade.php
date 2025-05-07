<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش خواننده | پنل مدیریت</title>
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
                <h1 class="text-3xl font-bold text-gray-900">ویرایش خواننده: {{ $artist->name }}</h1>
            </div>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('admin.artists.update', $artist) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 mb-2">نام خواننده</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $artist->name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="bio" class="block text-gray-700 mb-2">بیوگرافی</label>
                        <textarea name="bio" id="bio" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', $artist->bio) }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 mb-2">تصویر</label>
                        @if ($artist->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="h-32 w-32 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">فرمت‌های مجاز: JPG, PNG, GIF (حداکثر 2MB)</p>
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ old('is_featured', $artist->is_featured) ? 'checked' : '' }}>
                            <span class="mr-2 text-gray-700">نمایش به عنوان خواننده ویژه</span>
                        </label>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            به‌روزرسانی
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
