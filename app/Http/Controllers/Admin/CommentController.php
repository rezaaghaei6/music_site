<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['article', 'user']);
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by article
        if ($request->has('article_id')) {
            $query->where('article_id', $request->article_id);
        }
        
        $comments = $query->latest()->paginate(15);
        
        return view('admin.comments.index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);
        
        return redirect()->route('admin.comments.index')
            ->with('success', 'نظر با موفقیت تایید شد.');
    }

    public function spam(Comment $comment)
    {
        $comment->update(['status' => 'spam']);
        
        return redirect()->route('admin.comments.index')
            ->with('success', 'نظر به عنوان اسپم علامت‌گذاری شد.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        
        return redirect()->route('admin.comments.index')
            ->with('success', 'نظر با موفقیت حذف شد.');
    }
}
