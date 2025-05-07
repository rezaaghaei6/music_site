<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    /**
     * نمایش لیست خوانندگان
     */
    public function index()
    {
        $artists = Artist::orderBy('name')->paginate(10);
        return view('admin.artists.index', compact('artists'));
    }

    /**
     * نمایش فرم ایجاد خواننده جدید
     */
    public function create()
    {
        return view('admin.artists.create');
    }

    /**
     * ذخیره خواننده جدید در دیتابیس
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        
        // اگر تصویر آپلود شده باشد
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/artists', $imageName);
            $data['image'] = 'artists/' . $imageName;
        }
        
        $data['is_featured'] = $request->has('is_featured');

        Artist::create($data);

        return redirect()->route('admin.artists.index')
                        ->with('success', 'خواننده با موفقیت اضافه شد.');
    }

    /**
     * نمایش اطلاعات یک خواننده
     */
    public function show(Artist $artist)
    {
        return view('admin.artists.show', compact('artist'));
    }

    /**
     * نمایش فرم ویرایش خواننده
     */
    public function edit(Artist $artist)
    {
        return view('admin.artists.edit', compact('artist'));
    }

    /**
     * به‌روزرسانی اطلاعات خواننده در دیتابیس
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        
        // اگر تصویر جدید آپلود شده باشد
        if ($request->hasFile('image')) {
            // حذف تصویر قبلی
            if ($artist->image) {
                Storage::delete('public/' . $artist->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/artists', $imageName);
            $data['image'] = 'artists/' . $imageName;
        }
        
        $data['is_featured'] = $request->has('is_featured');

        $artist->update($data);

        return redirect()->route('admin.artists.index')
                        ->with('success', 'اطلاعات خواننده با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف خواننده از دیتابیس
     */
    public function destroy(Artist $artist)
    {
        // حذف تصویر خواننده
        if ($artist->image) {
            Storage::delete('public/' . $artist->image);
        }
        
        $artist->delete();

        return redirect()->route('admin.artists.index')
                        ->with('success', 'خواننده با موفقیت حذف شد.');
    }
}