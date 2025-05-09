<footer class="bg-white border-t border-gray-200 py-8 px-6">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4 gradient-text">{{ config('app.name', 'موزیکا') }}</h3>
                <p class="text-gray-600 mb-4">پلتفرم موسیقی آنلاین برای لذت بردن از بهترین موزیک‌ها</p>
                <div class="flex space-x-4 space-x-reverse">
                    <a href="#" class="text-gray-400 hover:text-primary-500"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-primary-500"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-primary-500"><i class="fab fa-telegram"></i></a>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-bold mb-4">لینک‌های سریع</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-500">صفحه اصلی</a></li>
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-500">دسته‌بندی‌ها</a></li>
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-500">هنرمندان</a></li>
                    <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-500">آلبوم‌ها</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-bold mb-4">منابع</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">وبلاگ</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">پشتیبانی</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">سوالات متداول</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">تماس با ما</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-bold mb-4">قانونی</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">حریم خصوصی</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">شرایط استفاده</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">کپی‌رایت</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500">درباره ما</a></li>
                </ul>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'موزیکا') }}. تمامی حقوق محفوظ است.
            </p>
        </div>
    </div>
</footer>