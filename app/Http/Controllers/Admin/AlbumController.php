<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('artist')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        return view('admin.albums.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'release_date' => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            // 'is_active' را حذف می‌کنیم چون در جدول وجود ندارد
        ]);
    
        // ایجاد اسلاگ
        $slug = Str::slug($validated['title']);
        
        // بررسی تکراری بودن اسلاگ
        $count = Album::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
    
        // آپلود تصویر
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('public/albums');
            $validated['cover_image'] = str_replace('public/', '', $path);
            // همچنین ستون cover را با همان مقدار پر می‌کنیم
            $validated['cover'] = $validated['cover_image'];
        }
    
        // استخراج سال از تاریخ انتشار
        $releaseYear = null;
        if (!empty($validated['release_date'])) {
            $releaseYear = date('Y', strtotime($validated['release_date']));
        }
    
        // ایجاد آلبوم با ستون‌های موجود
        Album::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'artist_id' => $validated['artist_id'],
            'release_date' => $validated['release_date'] ?? null,
            'cover_image' => $validated['cover_image'] ?? null,
            'cover' => $validated['cover_image'] ?? null, // استفاده از همان مقدار cover_image
            'description' => $validated['description'] ?? null,
            'release_year' => $releaseYear,
            'is_featured' => $validated['is_featured'] ?? false,
            // 'is_active' را حذف می‌کنیم
        ]);
    
        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'آلبوم با موفقیت ایجاد شد.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'artist_id' => ['required', 'exists:artists,id'],
            'release_date' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'max:2048'], // 2MB Max
            'description' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        // آپلود تصویر کاور جدید
        if ($request->hasFile('cover_image')) {
            // حذف تصویر قبلی
            if ($album->cover_image) {
                Storage::delete('public/' . $album->cover_image);
            }
            
            $path = $request->file('cover_image')->store('public/albums');
            $validated['cover_image'] = str_replace('public/', '', $path);
        }

        // به‌روزرسانی آلبوم
        $album->update([
            'title' => $validated['title'],
            'artist_id' => $validated['artist_id'],
            'release_date' => $validated['release_date'],
            'cover_image' => $validated['cover_image'] ?? $album->cover_image,
            'description' => $validated['description'],
            'is_featured' => $validated['is_featured'],
            'is_active' => $validated['is_active'],
        ]);

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'آلبوم با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        // حذف تصویر کاور
        if ($album->cover_image) {
            Storage::delete('public/' . $album->cover_image);
        }

        $album->delete();

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'آلبوم با موفقیت حذف شد.');
    }

    /**
     * Upload album cover image via AJAX.
     */
    public function uploadCover(Request $request)
    {
        $request->validate([
            'cover' => ['required', 'image', 'max:2048'] // 2MB Max
        ]);

        $path = $request->file('cover')->store('public/albums');
        $url = Storage::url($path);

        return response()->json([
            'success' => true,
            'path' => str_replace('public/', '', $path),
            'url' => $url
        ]);
    }

    /**
     * Toggle the featured status of the album.
     */
    public function toggleFeatured(Album $album)
    {
        $album->update([
            'is_featured' => !$album->is_featured
        ]);

        return response()->json([
            'success' => true,
            'is_featured' => $album->is_featured
        ]);
    }

    /**
     * Toggle the active status of the album.
     */
    public function toggleActive(Album $album)
    {
        $album->update([
            'is_active' => !$album->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $album->is_active
        ]);
    }
}