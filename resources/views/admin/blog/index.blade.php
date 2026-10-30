@extends('admin.layouts.app')

@section('title', 'Blog Articles & Notes')
@section('page-title', 'Blog Articles & Notes')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap;">
    <form method="GET" action="{{ route('admin.posts.index') }}" style="display: flex; gap: 0.75rem; flex: 1; max-width: 600px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..." class="adm-input" style="max-width: 300px;">
        <select name="status" class="adm-select" style="max-width: 150px;" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
        <button type="submit" class="adm-btn adm-btn-secondary">Filter</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.posts.index') }}" class="adm-btn adm-btn-secondary">Clear</a>
        @endif
    </form>

    <a href="{{ route('admin.posts.create') }}" class="adm-btn adm-btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        <span>Write New Article</span>
    </a>
</div>

<div class="adm-table-wrap">
    <table class="adm-table">
        <thead>
            <tr>
                <th>Title & Excerpt</th>
                <th>Category</th>
                <th>Author</th>
                <th>Status</th>
                <th>Date</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>
                        <div style="font-weight: 700; font-size: 0.92rem;">{{ $post->title }}</div>
                        <div style="font-size: 0.76rem; color: var(--adm-text-dim); max-width: 380px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $post->excerpt }}
                        </div>
                    </td>
                    <td>
                        <span class="adm-badge indigo">{{ $post->category }}</span>
                    </td>
                    <td style="font-size: 0.82rem; color: var(--adm-text-muted);">
                        {{ $post->author }}
                    </td>
                    <td>
                        @if($post->status === 'published')
                            <span class="adm-badge emerald">Published</span>
                        @else
                            <span class="adm-badge amber">Draft</span>
                        @endif
                    </td>
                    <td style="font-size: 0.78rem; color: var(--adm-text-dim); font-family: var(--adm-font-mono);">
                        {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : $post->created_at->format('M d, Y') }}
                    </td>
                    <td style="text-align: right;">
                        <div style="display: inline-flex; gap: 0.5rem;">
                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="adm-btn adm-btn-secondary adm-btn-sm" title="Preview Live">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="adm-btn adm-btn-secondary adm-btn-sm">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2.5rem; color: var(--adm-text-dim);">
                        No articles found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $posts->links() }}
</div>
@endsection
