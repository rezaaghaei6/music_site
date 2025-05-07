<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه یافت نشد | خطای 404</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-gray-300">404</h1>
            <h2 class="text-2xl font-bold mb-6 text-gray-700">صفحه مورد نظر یافت نشد</h2>
            <p class="text-gray-600 mb-8">صفحه‌ای که به دنبال آن هستید وجود ندارد یا حذف شده است.</p>
            <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                بازگشت به صفحه اصلی
            </a>
        </div>
    </div>
</body>
</html>