<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SongController extends Controller
{
    /**
     * نمایش لیست موزیک‌ها
     */
    public function index(Request $request)
    {
        // فیلترها
        $query = Song::query();
        
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('category') && !empty($request->category)) {
            $query->where('genre_id', $request->category);
        }
        
        if ($request->has('artist') && !empty($request->artist)) {
            $query->where('artist_id', $request->artist);
        }
        
        // مرتب‌سازی
        $sort = $request->sort ?? 'created_at';
        $direction = $request->direction ?? 'desc';
        $query->orderBy($sort, $direction);
        
        // دریافت آهنگ‌ها با اطلاعات مرتبط
        $songs = $query->with(['artist', 'album', 'genre'])->paginate(10);
        
        // دریافت دسته‌بندی‌ها (ژانرها)
        $categories = Genre::orderBy('name')->get();
        
        // دریافت هنرمندان
        $artists = Artist::orderBy('name')->get();
        
        return view('admin.songs.index', compact('songs', 'categories', 'artists'));
    }

    /**
     * نمایش فرم ایجاد موزیک جدید
     */
    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $categories = Genre::orderBy('name')->get(); // اضافه کردن این خط
        
        return view('admin.songs.create', compact('artists', 'albums', 'categories'));
    }


    /**
     * ذخیره موزیک جدید
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'duration' => 'nullable|string',
            'file_path' => 'required|string',
            'cover_image' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'release_date' => 'nullable|date',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // ایجاد اسلاگ برای موزیک
        $slug = Str::slug($validated['title']);
        $count = Song::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        
        // ایجاد موزیک
        $song = Song::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'artist_id' => $validated['artist_id'],
            'album_id' => $validated['album_id'],
            'genre_id' => $validated['genre_id'],
            'duration' => $validated['duration'],
            'file_path' => $validated['file_path'],
            'cover_image' => $validated['cover_image'] ?? null,
            'lyrics' => $validated['lyrics'] ?? null,
            'release_date' => $validated['release_date'] ?? now(),
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
            'plays' => 0,
        ]);
        
        return redirect()->route('admin.songs.index')
            ->with('success', 'موزیک با موفقیت ایجاد شد.');
    }

    /**
     * نمایش جزئیات موزیک
     */
    public function show(Song $song)
    {
        return view('admin.songs.show', compact('song'));
    }

    /**
     * نمایش فرم ویرایش موزیک
     */
    public function edit(Song $song)
    {
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();
        
        return view('admin.songs.edit', compact('song', 'artists', 'albums', 'genres'));
    }

    /**
     * به‌روزرسانی موزیک
     */
    public function update(Request $request, Song $song)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'duration' => 'nullable|string',
            'file_path' => 'required|string',
            'cover_image' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'release_date' => 'nullable|date',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);
        
        // به‌روزرسانی موزیک
        $song->update([
            'title' => $validated['title'],
            'artist_id' => $validated['artist_id'],
            'album_id' => $validated['album_id'],
            'genre_id' => $validated['genre_id'],
            'duration' => $validated['duration'],
            'file_path' => $validated['file_path'],
            'cover_image' => $validated['cover_image'] ?? $song->cover_image,
            'lyrics' => $validated['lyrics'] ?? $song->lyrics,
            'release_date' => $validated['release_date'] ?? $song->release_date,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);
        
        return redirect()->route('admin.songs.index')
            ->with('success', 'موزیک با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف موزیک
     */
    public function destroy(Song $song)
    {
        // حذف فایل موزیک اگر وجود داشته باشد
        if ($song->file_path && Storage::exists('public/' . $song->file_path)) {
            Storage::delete('public/' . $song->file_path);
        }
        
        // حذف تصویر کاور اگر وجود داشته باشد
        if ($song->cover_image && Storage::exists('public/' . $song->cover_image)) {
            Storage::delete('public/' . $song->cover_image);
        }
        
        // حذف موزیک از پایگاه داده
        $song->delete();
        
        return redirect()->route('admin.songs.index')
            ->with('success', 'موزیک با موفقیت حذف شد.');
    }
    
    /**
     * آپلود فایل صوتی
     */
    public function uploadAudio(Request $request)
    {
        if (!$request->hasFile('audio')) {
            return response()->json(['error' => 'فایل صوتی آپلود نشده است'], 400);
        }
        
        $file = $request->file('audio');
        $extension = $file->getClientOriginalExtension();
        $allowedExtensions = ['mp3', 'wav', 'ogg', 'm4a'];
        
        if (!in_array($extension, $allowedExtensions)) {
            return response()->json(['error' => 'فرمت فایل مجاز نیست. فرمت‌های مجاز: mp3, wav, ogg, m4a'], 400);
        }
        
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $extension;
        $path = $file->storeAs('songs', $filename, 'public');
        
        return response()->json([
            'success' => true,
            'path' => $path,
            'filename' => $file->getClientOriginalName()
        ]);
    }
    
    /**
     * آپلود تصویر کاور
     */
    public function uploadCover(Request $request)
    {
        if (!$request->hasFile('cover')) {
            return response()->json(['error' => 'تصویر کاور آپلود نشده است'], 400);
        }
        
        $file = $request->file('cover');
        $extension = $file->getClientOriginalExtension();
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        
        if (!in_array($extension, $allowedExtensions)) {
            return response()->json(['error' => 'فرمت تصویر مجاز نیست. فرمت‌های مجاز: jpg, jpeg, png, webp'], 400);
        }
        
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $extension;
        $path = $file->storeAs('covers', $filename, 'public');
        
        return response()->json([
            'success' => true,
            'path' => $path,
            'url' => asset('storage/' . $path)
        ]);
    }
    
    /**
     * دریافت اطلاعات فایل صوتی
     */
    public function getAudioInfo(Request $request)
    {
        $validated = $request->validate([
            'file_path' => 'required|string',
        ]);
        
        $filePath = storage_path('app/public/' . $validated['file_path']);
        
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'فایل یافت نشد'], 404);
        }
        
        // برای استخراج مدت زمان فایل صوتی می‌توانید از کتابخانه‌های مختلفی استفاده کنید
        // در اینجا یک مقدار پیش‌فرض برمی‌گردانیم
        
        return response()->json([
            'success' => true,
            'duration' => '00:03:45', // این مقدار باید با کتابخانه مناسب استخراج شود
            'filesize' => File::size($filePath)
        ]);
    }
}