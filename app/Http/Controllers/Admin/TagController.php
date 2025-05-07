<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('articles')->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {
        $data = $request->validated();
        
        // Set slug
        $data['slug'] = Str::slug($data['name']);
        
        Tag::create($data);
        
        return redirect()->route('admin.tags.index')
            ->with('success', 'برچسب با موفقیت ایجاد شد.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->validated();
        
        // Update slug if name changed
        if ($tag->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        $tag->update($data);
        
        return redirect()->route('admin.tags.index')
            ->with('success', 'برچسب با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        
        return redirect()->route('admin.tags.index')
            ->with('success', 'برچسب با موفقیت حذف شد.');
    }
}
