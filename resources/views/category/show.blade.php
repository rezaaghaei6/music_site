<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} | سایت موسیقی</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">{{ $category->name }}</h1>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <p class="text-gray-700 dark:text-gray-300 mb-4">آهنگ‌های دسته‌بندی {{ $category->name }}</p>
            
            <!-- اینجا می‌توانید لیست آهنگ‌های این دسته‌بندی را نمایش دهید -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                    <h3 class="font-bold">آهنگ نمونه 1</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">خواننده: هنرمند 1</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                    <h3 class="font-bold">آهنگ نمونه 2</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">خواننده: هنرمند 2</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                    <h3 class="font-bold">آهنگ نمونه 3</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">خواننده: هنرمند 3</p>
                </div>
            </div>
        </div>
        
        <div class="mt-6">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                بازگشت به صفحه اصلی
            </a>
        </div>
    </div>
</body>
</html>
