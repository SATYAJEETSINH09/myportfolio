<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request): View
    {
        $query = BlogPost::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $posts = $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        $categories = BlogPost::select('category')->distinct()->pluck('category');

        return view('admin.blog.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create(): View
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created blog post in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_posts,slug'],
            'category' => ['required', 'string', 'max:100'],
            'author' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string', 'in:published,draft,archived'],
            'published_at' => ['nullable', 'date'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('blog', 'public');
            $validated['cover_image'] = $path;
        }

        $validated['author'] = $validated['author'] ?? 'Satyajeetsinh Dodiya';
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(BlogPost $post): View
    {
        return view('admin.blog.edit', compact('post'));
    }

    /**
     * Update the specified blog post in storage.
     */
    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:blog_posts,slug,' . $post->id],
            'category' => ['required', 'string', 'max:100'],
            'author' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string', 'in:published,draft,archived'],
            'published_at' => ['nullable', 'date'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ]);

        if ($request->hasFile('cover_image_file')) {
            if ($post->cover_image && !Str::startsWith($post->cover_image, ['http'])) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $path = $request->file('cover_image_file')->store('blog', 'public');
            $validated['cover_image'] = $path;
        }

        if ($validated['status'] === 'published' && empty($validated['published_at']) && empty($post->published_at)) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified blog post from storage.
     */
    public function destroy(BlogPost $post): RedirectResponse
    {
        if ($post->cover_image && !Str::startsWith($post->cover_image, ['http'])) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article deleted successfully.');
    }
}
