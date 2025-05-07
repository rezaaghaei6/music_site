<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود | پنل مدیریت</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg px-8 py-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-900">ورود به پنل مدیریت</h2>
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-2">ایمیل</label>
                        <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required autofocus>
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 mb-2">رمز عبور</label>
                        <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="mr-2 text-sm text-gray-600">مرا به خاطر بسپار</label>
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            ورود
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <a href="{{ url('/') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        بازگشت به صفحه اصلی
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>