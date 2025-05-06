<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>موسیقی آنلاین - بهترین پلتفرم موسیقی</title>
    <meta name="description" content="پلتفرم موسیقی آنلاین با بهترین آهنگ‌های روز دنیا">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="dark-mode">
    <!-- هدر -->
    @include('partials.navbar')
    
    <!-- محتوای اصلی -->
    <main>
        @yield('content')
    </main>
    
    <!-- فوتر -->
    @include('partials.footer')
    
    <!-- اسکریپت‌ها -->
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>