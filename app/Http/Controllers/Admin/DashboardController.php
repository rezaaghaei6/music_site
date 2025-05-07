<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'categories' => Category::count(),
            'tags' => Tag::count(),
            'comments' => Comment::count(),
            'pending_comments' => Comment::where('status', 'pending')->count(),
        ];
        
        $latestArticles = Article::with('user')
                                ->latest()
                                ->take(5)
                                ->get();
        
        $latestComments = Comment::with(['article', 'user'])
                                ->latest()
                                ->take(5)
                                ->get();
        
        return view('admin.dashboard.index', compact('stats', 'latestArticles', 'latestComments'));
    }
}