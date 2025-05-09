<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PlaylistController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Song;
use App\Models\Genre;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

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
    $latestSongs = Song::with(['artist', 'album'])
                      ->orderBy('created_at', 'desc')
                      ->take(8)
                      ->get();
    
    // دریافت خوانندگان ویژه
    $featuredArtists = Artist::where('is_featured', true)
                           ->take(4)
                           ->get();
    
    // دریافت آلبوم‌های جدید
    $newAlbums = Album::with('artist')
                    ->orderBy('created_at', 'desc')
                    ->take(4)
                    ->get();
                    
    // دریافت موزیک‌های ویژه
    $featuredSongs = Song::with(['artist', 'album'])
                       ->where('is_featured', true)
                       ->orderBy('created_at', 'desc')
                       ->take(6)
                       ->get();
    
    // دریافت موزیک‌های پربازدید
    $popularSongs = Song::with(['artist', 'album'])
                      ->orderBy('plays', 'desc')
                      ->take(10)
                      ->get();
    
    // دریافت ژانرهای محبوب
    $genres = Genre::withCount('songs')
                 ->orderBy('songs_count', 'desc')
                 ->take(8)
                 ->get();
    
    return view('home.index', compact(
        'latestSongs', 
        'featuredArtists', 
        'newAlbums', 
        'featuredSongs', 
        'popularSongs',
        'genres'
    ));
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

// مسیر GET برای نمایش فرم ثبت نام (اختیاری)
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }
    return view('auth.register');
})->name('register');

// مسیر POST برای پردازش فرم ثبت نام (اختیاری)
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
    ]);
    
    Auth::login($user);
    
    return redirect('/admin');
})->name('register.submit');

// مسیرهای پنل ادمین
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // داشبورد اصلی
    Route::get('/', function () {
        // آمار و اطلاعات برای داشبورد
        $totalSongs = Song::count();
        $totalArtists = Artist::count();
        $totalAlbums = Album::count();
        $totalGenres = Genre::count();
        $totalPlays = Song::sum('plays');
        
        // آخرین موزیک‌های اضافه شده
        $latestSongs = Song::with(['artist', 'album'])
                         ->latest()
                         ->take(5)
                         ->get();
        
        // پربازدیدترین موزیک‌ها
        $popularSongs = Song::with(['artist'])
                          ->orderBy('plays', 'desc')
                          ->take(5)
                          ->get();
        
        // موزیک‌های اخیر به تفکیک ژانر
        $songsByGenre = Genre::withCount('songs')
                           ->orderBy('songs_count', 'desc')
                           ->take(5)
                           ->get();
        
        return view('admin.dashboard', compact(
            'totalSongs', 
            'totalArtists', 
            'totalAlbums', 
            'totalGenres',
            'totalPlays',
            'latestSongs',
            'popularSongs',
            'songsByGenre'
        ));
    })->name('dashboard');
    
    // مدیریت خوانندگان
    Route::resource('artists', ArtistController::class);
    
    // آپلود تصویر خواننده با AJAX
    Route::post('artists/upload-image', [ArtistController::class, 'uploadImage'])->name('artists.upload-image');
    
    // مدیریت آلبوم‌ها
    Route::resource('albums', AlbumController::class);
    
    // آپلود کاور آلبوم با AJAX
    Route::post('albums/upload-cover', [AlbumController::class, 'uploadCover'])->name('albums.upload-cover');
    
    // مدیریت موزیک‌ها
    Route::resource('songs', SongController::class);
    
    // آپلود فایل صوتی با AJAX
    Route::post('songs/upload-audio', [SongController::class, 'uploadAudio'])->name('songs.upload-audio');
    
    // آپلود کاور موزیک با AJAX
    Route::post('songs/upload-cover', [SongController::class, 'uploadCover'])->name('songs.upload-cover');
    
    // دریافت اطلاعات موزیک (مانند مدت زمان) با AJAX
    Route::post('songs/get-audio-info', [SongController::class, 'getAudioInfo'])->name('songs.get-audio-info');
    
    // مدیریت ژانرها
    Route::resource('genres', GenreController::class);
    
    // مدیریت لیست‌های پخش
    Route::resource('playlists', PlaylistController::class);
    
    // افزودن موزیک به لیست پخش
    Route::post('playlists/{playlist}/add-song', [PlaylistController::class, 'addSong'])->name('playlists.add-song');
    
    // حذف موزیک از لیست پخش
    Route::delete('playlists/{playlist}/remove-song/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.remove-song');
    
    // تغییر ترتیب موزیک‌ها در لیست پخش
    Route::post('playlists/{playlist}/reorder', [PlaylistController::class, 'reorder'])->name('playlists.reorder');
    
    // مدیریت کاربران - با استفاده از resource
    Route::resource('users', UserController::class);
    
    // تغییر وضعیت ادمین کاربر
    Route::patch('/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    
    // تنظیمات سایت
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
    
    Route::post('/settings', function (Request $request) {
        // پردازش تنظیمات و ذخیره آنها
        // این بخش به پیاده‌سازی سیستم تنظیمات شما بستگی دارد
        
        return back()->with('success', 'تنظیمات با موفقیت ذخیره شدند.');
    })->name('settings.update');
    
    // گزارش‌گیری و آمار
    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('reports');
    
    // گزارش آماری موزیک‌ها
    Route::get('/reports/songs', function () {
        return view('admin.reports.songs');
    })->name('reports.songs');
    
    // گزارش آماری خوانندگان
    Route::get('/reports/artists', function () {
        return view('admin.reports.artists');
    })->name('reports.artists');
    
    // گزارش آماری کاربران
    Route::get('/reports/users', function () {
        return view('admin.reports.users');
    })->name('reports.users');
});

// مسیرهای عمومی سایت

// صفحه نمایش همه خوانندگان
Route::get('/artists', function () {
    $artists = Artist::orderBy('name')->paginate(24);
    return view('site.artists.index', compact('artists'));
})->name('artists.index');

// صفحه نمایش جزئیات یک خواننده
Route::get('/artists/{artist:slug}', function (Artist $artist) {
    // دریافت آلبوم‌های خواننده
    $albums = $artist->albums()->with('songs')->latest()->get();
    
    // دریافت موزیک‌های خواننده که در آلبوم نیستند
    $singleSongs = $artist->songs()->whereNull('album_id')->latest()->get();
    
    // دریافت موزیک‌های محبوب خواننده
    $popularSongs = $artist->songs()->orderBy('plays', 'desc')->take(10)->get();
    
    return view('site.artists.show', compact('artist', 'albums', 'singleSongs', 'popularSongs'));
})->name('artists.show');

// صفحه نمایش همه آلبوم‌ها
Route::get('/albums', function () {
    $albums = Album::with('artist')->orderBy('created_at', 'desc')->paginate(24);
    return view('site.albums.index', compact('albums'));
})->name('albums.index');

// صفحه نمایش جزئیات یک آلبوم
Route::get('/albums/{album:slug}', function (Album $album) {
    // دریافت موزیک‌های آلبوم
    $songs = $album->songs()->with('artist')->orderBy('created_at', 'desc')->get();
    
    // دریافت سایر آلبوم‌های همین خواننده
    $otherAlbums = Album::where('artist_id', $album->artist_id)
                     ->where('id', '!=', $album->id)
                     ->latest()
                     ->take(4)
                     ->get();
    
    return view('site.albums.show', compact('album', 'songs', 'otherAlbums'));
})->name('albums.show');

// صفحه نمایش همه موزیک‌ها
Route::get('/songs', function () {
    $songs = Song::with(['artist', 'album'])->orderBy('created_at', 'desc')->paginate(20);
    return view('site.songs.index', compact('songs'));
})->name('songs.index');

// صفحه نمایش جزئیات یک موزیک
Route::get('/songs/{song:slug}', function (Song $song) {
    // افزایش تعداد بازدید
    $song->increment('plays');
    
    // دریافت سایر موزیک‌های همین خواننده
    $relatedSongs = Song::where('artist_id', $song->artist_id)
                     ->where('id', '!=', $song->id)
                     ->latest()
                     ->take(8)
                     ->get();
    
    // دریافت موزیک‌های مشابه (از همان ژانر)
    $similarSongs = Song::where('genre_id', $song->genre_id)
                     ->where('id', '!=', $song->id)
                     ->inRandomOrder()
                     ->take(4)
                     ->get();
    
    return view('site.songs.show', compact('song', 'relatedSongs', 'similarSongs'));
})->name('songs.show');

// صفحه نمایش همه ژانرها
Route::get('/genres', function () {
    $genres = Genre::withCount('songs')->orderBy('name')->paginate(24);
    return view('site.genres.index', compact('genres'));
})->name('genres.index');

// صفحه نمایش موزیک‌های یک ژانر
Route::get('/genres/{genre:slug}', function (Genre $genre) {
    $songs = $genre->songs()->with(['artist', 'album'])->latest()->paginate(20);
    return view('site.genres.show', compact('genre', 'songs'));
})->name('genres.show');

// صفحه لیست‌های پخش عمومی
Route::get('/playlists', function () {
    $playlists = Playlist::where('is_public', true)
                      ->withCount('songs')
                      ->latest()
                      ->paginate(12);
    return view('site.playlists.index', compact('playlists'));
})->name('playlists.index');

// صفحه نمایش یک لیست پخش
Route::get('/playlists/{playlist:slug}', function (Playlist $playlist) {
    // اگر لیست پخش خصوصی است، فقط صاحب آن می‌تواند آن را ببیند
    if (!$playlist->is_public && (!Auth::check() || Auth::id() != $playlist->user_id)) {
        abort(403);
    }
    
    $songs = $playlist->songs()->with(['artist', 'album'])->get();
    return view('site.playlists.show', compact('playlist', 'songs'));
})->name('playlists.show');

// API برای پخش موزیک
Route::get('/api/songs/{song}/play', function (Song $song) {
    $song->increment('plays');
    return response()->json([
        'success' => true,
        'plays' => $song->plays
    ]);
})->name('api.songs.play');

// API برای دانلود موزیک
Route::get('/api/songs/{song}/download', function (Song $song) {
    // اگر ستون downloads در جدول وجود دارد، این خط را فعال کنید
    // $song->increment('downloads');
    
    return response()->download(storage_path('app/public/' . $song->file_path));
})->name('api.songs.download');

// صفحه جستجو
Route::get('/search', function (Request $request) {
    $query = $request->input('q');
    
    if (!$query) {
        return redirect()->route('home');
    }
    
    $artists = Artist::where('name', 'like', "%{$query}%")->get();
    $albums = Album::where('title', 'like', "%{$query}%")->get();
    $songs = Song::where('title', 'like', "%{$query}%")
                 ->orWhereHas('artist', function ($q) use ($query) {
                     $q->where('name', 'like', "%{$query}%");
                 })
                 ->with(['artist', 'album'])
                 ->get();
    
    return view('site.search', compact('query', 'artists', 'albums', 'songs'));
})->name('search');

// صفحه تماس با ما
Route::get('/contact', function () {
    return view('site.contact');
})->name('contact');

// پردازش فرم تماس با ما
Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    
    // ارسال ایمیل یا ذخیره در پایگاه داده
    // ...
    
    return back()->with('success', 'پیام شما با موفقیت ارسال شد.');
})->name('contact.submit');

// صفحه درباره ما
Route::get('/about', function () {
    return view('site.about');
})->name('about');

// صفحه قوانین و مقررات
Route::get('/terms', function () {
    return view('site.terms');
})->name('terms');

// صفحه حریم خصوصی
Route::get('/privacy', function () {
    return view('site.privacy');
})->name('privacy');

// مسیرهای کاربران احراز هویت شده
Route::middleware(['auth'])->group(function () {
    // پروفایل کاربر
    Route::get('/profile', function () {
        return view('site.profile.index');
    })->name('profile');
    
    // ویرایش پروفایل کاربر
    Route::get('/profile/edit', function () {
        return view('site.profile.edit');
    })->name('profile.edit');
    
    Route::put('/profile', function (Request $request) {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($validated['password']) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }
        
        $user->save();
        
        return redirect()->route('profile')->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
    })->name('profile.update');
    
    // لیست‌های پخش کاربر
    Route::get('/profile/playlists', function () {
        $playlists = Auth::user()->playlists()->withCount('songs')->latest()->paginate(10);
        return view('site.profile.playlists.index', compact('playlists'));
    })->name('profile.playlists');
    
    // ایجاد لیست پخش جدید
    Route::get('/profile/playlists/create', function () {
        return view('site.profile.playlists.create');
    })->name('profile.playlists.create');
    
    Route::post('/profile/playlists', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);
        
        $slug = \Illuminate\Support\Str::slug($validated['name']);
        
        // بررسی تکراری نبودن اسلاگ
        $count = Playlist::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        
        Auth::user()->playlists()->create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'is_public' => $request->has('is_public'),
        ]);
        
        return redirect()->route('profile.playlists')->with('success', 'لیست پخش با موفقیت ایجاد شد.');
    })->name('profile.playlists.store');
    
    // ویرایش لیست پخش
    Route::get('/profile/playlists/{playlist}/edit', function (Playlist $playlist) {
        // بررسی مالکیت لیست پخش
        if (Auth::id() !== $playlist->user_id) {
            abort(403);
        }
        
        return view('site.profile.playlists.edit', compact('playlist'));
    })->name('profile.playlists.edit');
    
    Route::put('/profile/playlists/{playlist}', function (Request $request, Playlist $playlist) {
        // بررسی مالکیت لیست پخش
        if (Auth::id() !== $playlist->user_id) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);
        
        $playlist->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'is_public' => $request->has('is_public'),
        ]);
        
        return redirect()->route('profile.playlists')->with('success', 'لیست پخش با موفقیت به‌روزرسانی شد.');
    })->name('profile.playlists.update');
    
    // حذف لیست پخش
    Route::delete('/profile/playlists/{playlist}', function (Playlist $playlist) {
        // بررسی مالکیت لیست پخش
        if (Auth::id() !== $playlist->user_id) {
            abort(403);
        }
        
        $playlist->delete();
        
        return redirect()->route('profile.playlists')->with('success', 'لیست پخش با موفقیت حذف شد.');
    })->name('profile.playlists.destroy');
    
    // افزودن موزیک به لیست پخش کاربر
    Route::post('/profile/playlists/{playlist}/add-song', function (Request $request, Playlist $playlist) {
        // بررسی مالکیت لیست پخش
        if (Auth::id() !== $playlist->user_id) {
            abort(403);
        }
        
        $validated = $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);
        
        // بررسی تکراری نبودن موزیک در لیست پخش
        if (!$playlist->songs()->where('song_id', $validated['song_id'])->exists()) {
            $position = $playlist->songs()->count();
            $playlist->songs()->attach($validated['song_id'], ['position' => $position]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'موزیک با موفقیت به لیست پخش اضافه شد.'
        ]);
    })->name('profile.playlists.add-song');
    
    // حذف موزیک از لیست پخش کاربر
    Route::delete('/profile/playlists/{playlist}/remove-song/{song}', function (Playlist $playlist, Song $song) {
        // بررسی مالکیت لیست پخش
        if (Auth::id() !== $playlist->user_id) {
            abort(403);
        }
        
        $playlist->songs()->detach($song->id);
        
        // بازنشانی ترتیب موزیک‌ها
        $songs = $playlist->songs()->orderBy('pivot_position')->get();
        foreach ($songs as $index => $s) {
            $playlist->songs()->updateExistingPivot($s->id, ['position' => $index]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'موزیک با موفقیت از لیست پخش حذف شد.'
        ]);
    })->name('profile.playlists.remove-song');
    
    // تغییر ترتیب موزیک‌ها در لیست پخش کاربر
    Route::post('/profile/playlists/{playlist}/reorder', function (Request $request, Playlist $playlist) {
        // بررسی مالکیت لیست پخش
        if (Auth::id() !== $playlist->user_id) {
            abort(403);
        }
        
        $validated = $request->validate([
            'songs' => 'required|array',
            'songs.*' => 'exists:songs,id',
        ]);
        
        foreach ($validated['songs'] as $index => $songId) {
            $playlist->songs()->updateExistingPivot($songId, ['position' => $index]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'ترتیب موزیک‌ها با موفقیت به‌روزرسانی شد.'
        ]);
    })->name('profile.playlists.reorder');
    
    // موزیک‌های مورد علاقه کاربر
    Route::get('/profile/favorites', function () {
        // اینجا باید مدل و جدول مربوط به علاقه‌مندی‌ها را ایجاد کنید
        return view('site.profile.favorites');
    })->name('profile.favorites');
    
    // افزودن موزیک به علاقه‌مندی‌ها
    Route::post('/favorites/add', function (Request $request) {
        $validated = $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);
        
        // اینجا باید مدل و جدول مربوط به علاقه‌مندی‌ها را ایجاد کنید
        
        return response()->json([
            'success' => true,
            'message' => 'موزیک به علاقه‌مندی‌ها اضافه شد.'
        ]);
    })->name('favorites.add');
    
    // حذف موزیک از علاقه‌مندی‌ها
    Route::delete('/favorites/remove/{song}', function (Song $song) {
        // اینجا باید مدل و جدول مربوط به علاقه‌مندی‌ها را ایجاد کنید
        
        return response()->json([
            'success' => true,
            'message' => 'موزیک از علاقه‌مندی‌ها حذف شد.'
        ]);
    })->name('favorites.remove');
});

// آپلود موزیک - مسیرهای عمومی
Route::middleware(['auth'])->group(function () {
    // مسیر نمایش صفحه آپلود
    Route::get('/upload-music', function () {
        return view('upload-music');
    })->name('upload-music');
    
    // مسیر آپلود چانک
    Route::post('/upload-chunk', function (Illuminate\Http\Request $request) {
        // بررسی وجود فایل
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'فایلی آپلود نشده است'], 400);
        }
        
        // دریافت اطلاعات چانک
        $chunkNumber = $request->input('chunkNumber');
        $totalChunks = $request->input('totalChunks');
        $fileId = $request->input('fileId');
        $filename = $request->input('filename');
        
        // ایجاد دایرکتوری برای ذخیره چانک‌ها
        $chunkDir = storage_path('app/chunks/' . $fileId);
        if (!file_exists($chunkDir)) {
            mkdir($chunkDir, 0777, true);
        }
        
        // ذخیره چانک
        $file = $request->file('file');
        $chunkFile = $chunkDir . '/' . $chunkNumber;
        file_put_contents($chunkFile, file_get_contents($file->getRealPath()));
        
        // اگر آخرین چانک است، فایل‌ها را ترکیب کنید
        if ((int)$chunkNumber === (int)$totalChunks - 1) {
            // ایجاد نام فایل منحصر به فرد
            $safeFilename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $filename);
            $finalPath = 'public/songs/' . $safeFilename;
            
            // اطمینان از وجود دایرکتوری مقصد
            $songDir = storage_path('app/public/songs');
            if (!file_exists($songDir)) {
                mkdir($songDir, 0777, true);
            }
            
            // ترکیب چانک‌ها
            $finalFile = fopen(storage_path('app/' . $finalPath), 'wb');
            
            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkFile = $chunkDir . '/' . $i;
                if (file_exists($chunkFile)) {
                    $chunk = fopen($chunkFile, 'rb');
                    stream_copy_to_stream($chunk, $finalFile);
                    fclose($chunk);
                    unlink($chunkFile); // حذف چانک پس از استفاده
                }
            }
            
            fclose($finalFile);
            rmdir($chunkDir); // حذف دایرکتوری چانک‌ها
            
            return response()->json([
                'success' => true,
                'path' => $finalPath,
                'message' => 'فایل با موفقیت آپلود شد.'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'چانک ' . $chunkNumber . ' از ' . $totalChunks . ' آپلود شد.'
        ]);
    })->name('upload-chunk');
});

// مسیرهای بازیابی رمز عبور
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            event(new \Illuminate\Auth\Events\PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

// مسیر 404 - صفحه یافت نشد
Route::fallback(function () {
    return view('errors.404');
});