<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\NavigationItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of blog articles with optional category filtering and search.
     */
    public function index(Request $request): View
    {
        $settings = Setting::pluck('value', 'key')->all();
        $navItems = NavigationItem::active()->get();

        $query = BlogPost::published();

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(6)->withQueryString();
        $categories = BlogPost::published()->reorder()->distinct()->pluck('category');

        return view('blog.index', compact('posts', 'categories', 'settings', 'navItems'));
    }

    /**
     * Display the specified blog post article.
     */
    public function show(BlogPost $post): View
    {
        $settings = Setting::pluck('value', 'key')->all();
        $navItems = NavigationItem::active()->get();

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts', 'settings', 'navItems'));
    }
}
