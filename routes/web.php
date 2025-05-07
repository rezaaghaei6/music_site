<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PlaylistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// صفحه اصلی
Route::get('/', function () {
    // دریافت آخرین موزیک‌ها
    $latestSongs = \App\Models\Song::with(['artist', 'album'])
                                  ->orderBy('created_at', 'desc')
                                  ->take(8)
                                  ->get();
    
    // دریافت خوانندگان ویژه
    $featuredArtists = \App\Models\Artist::where('is_featured', true)
                                       ->take(4)
                                       ->get();
    
    return view('home.index', compact('latestSongs', 'featuredArtists'));
})->name('home');

// مسیرهای احراز هویت

// مسیر GET برای نمایش فرم ورود
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }
    return view('auth.login');
})->name('login');

// مسیر POST برای پردازش فرم ورود
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/admin');
    }

    return back()->withErrors([
        'email' => 'اطلاعات وارد شده صحیح نیست.',
    ]);
})->name('login.submit');

// مسیر خروج
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// مسیرهای پنل ادمین
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // داشبورد اصلی
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // مدیریت خوانندگان
    Route::resource('artists', ArtistController::class);
    
    // مدیریت آلبوم‌ها
    Route::resource('albums', AlbumController::class);
    
    // مدیریت موزیک‌ها
    Route::resource('songs', SongController::class);
    
    // مدیریت ژانرها
    Route::resource('genres', GenreController::class);
    
    // مدیریت لیست‌های پخش
    Route::resource('playlists', PlaylistController::class);
    
    // مدیریت کاربران
    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');
    
    // تنظیمات
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});

// مسیرهای عمومی سایت

// صفحه نمایش همه خوانندگان
Route::get('/artists', function () {
    $artists = App\Models\Artist::orderBy('name')->paginate(12);
    return view('site.artists.index', compact('artists'));
})->name('artists.index');

// صفحه نمایش جزئیات یک خواننده
Route::get('/artists/{artist:slug}', function (App\Models\Artist $artist) {
    return view('site.artists.show', compact('artist'));
})->name('artists.show');

// صفحه نمایش همه آلبوم‌ها
Route::get('/albums', function () {
    $albums = App\Models\Album::with('artist')->orderBy('created_at', 'desc')->paginate(12);
    return view('site.albums.index', compact('albums'));
})->name('albums.index');

// صفحه نمایش جزئیات یک آلبوم
Route::get('/albums/{album:slug}', function (App\Models\Album $album) {
    return view('site.albums.show', compact('album'));
})->name('albums.show');

// صفحه نمایش همه موزیک‌ها
Route::get('/songs', function () {
    $songs = App\Models\Song::with(['artist', 'album'])->orderBy('created_at', 'desc')->paginate(20);
    return view('site.songs.index', compact('songs'));
})->name('songs.index');

// صفحه نمایش جزئیات یک موزیک
Route::get('/songs/{song:slug}', function (App\Models\Song $song) {
    // افزایش تعداد بازدید
    $song->increment('plays');
    return view('site.songs.show', compact('song'));
})->name('songs.show');

// API برای پخش موزیک
Route::get('/api/songs/{song}/play', function (App\Models\Song $song) {
    $song->increment('plays');
    return response()->json([
        'success' => true,
        'plays' => $song->plays
    ]);
})->name('api.songs.play');

// صفحه جستجو
Route::get('/search', function (Request $request) {
    $query = $request->input('q');
    
    if (!$query) {
        return redirect()->route('home');
    }
    
    $artists = App\Models\Artist::where('name', 'like', "%{$query}%")->get();
    $albums = App\Models\Album::where('title', 'like', "%{$query}%")->get();
    $songs = App\Models\Song::where('title', 'like', "%{$query}%")->get();
    
    return view('site.search', compact('query', 'artists', 'albums', 'songs'));
})->name('search');

// مسیر 404 - صفحه یافت نشد
Route::fallback(function () {
    return view('errors.404');
});