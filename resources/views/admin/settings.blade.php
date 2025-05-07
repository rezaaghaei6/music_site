<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنظیمات | پنل مدیریت</title>
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
                        <a href="{{ url('/admin/users') }}" class="block p-2 rounded text-gray-700 hover:bg-gray-100">کاربران</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded text-gray-700 hover:bg-gray-100">محتوا</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/admin/settings') }}" class="block p-2 rounded text-blue-600 bg-blue-100">تنظیمات</a>
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
            <h1 class="text-3xl font-bold mb-6 text-gray-900">تنظیمات</h1>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4 text-gray-800">تنظیمات عمومی</h2>
                
                <form>
                    <div class="mb-4">
                        <label for="site_name" class="block text-gray-700 mb-2">نام سایت</label>
                        <input type="text" id="site_name" name="site_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="سایت موزیک">
                    </div>
                    
                    <div class="mb-4">
                        <label for="site_description" class="block text-gray-700 mb-2">توضیحات سایت</label>
                        <textarea id="site_description" name="site_description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">سایت موزیک - دانلود و پخش آنلاین موسیقی</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="admin_email" class="block text-gray-700 mb-2">ایمیل مدیر</label>
                        <input type="email" id="admin_email" name="admin_email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ Auth::user()->email }}">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">وضعیت سایت</label>
                        <div class="flex items-center">
                            <input type="radio" id="site_status_online" name="site_status" value="online" checked class="ml-2">
                            <label for="site_status_online" class="ml-4">آنلاین</label>
                            
                            <input type="radio" id="site_status_maintenance" name="site_status" value="maintenance" class="ml-2">
                            <label for="site_status_maintenance">حالت تعمیر و نگهداری</label>
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            ذخیره تنظیمات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>