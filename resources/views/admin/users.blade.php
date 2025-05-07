<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کاربران | پنل مدیریت</title>
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
                        <a href="{{ url('/admin/users') }}" class="block p-2 rounded text-blue-600 bg-blue-100">کاربران</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded text-gray-700 hover:bg-gray-100">محتوا</a>
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
            <h1 class="text-3xl font-bold mb-6 text-gray-900">مدیریت کاربران</h1>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">لیست کاربران</h2>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">افزودن کاربر</button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b text-right">نام</th>
                                <th class="py-2 px-4 border-b text-right">ایمیل</th>
                                <th class="py-2 px-4 border-b text-right">تاریخ ثبت‌نام</th>
                                <th class="py-2 px-4 border-b text-right">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">{{ Auth::user()->name }}</td>
                                <td class="py-2 px-4 border-b">{{ Auth::user()->email }}</td>
                                <td class="py-2 px-4 border-b">{{ Auth::user()->created_at->format('Y/m/d') }}</td>
                                <td class="py-2 px-4 border-b">
                                    <button class="text-blue-600 hover:text-blue-800 ml-2">ویرایش</button>
                                    <button class="text-red-600 hover:text-red-800">حذف</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>