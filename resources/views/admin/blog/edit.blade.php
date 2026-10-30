@extends('admin.layouts.app')

@section('title', 'Edit Article - ' . $post->title)
@section('page-title', 'Edit Article')

@section('content')
<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('admin.posts.index') }}" class="adm-btn adm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Articles</span>
        </a>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="adm-btn adm-btn-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                <span>View Live</span>
            </a>
            <button type="submit" class="adm-btn adm-btn-primary">
                <span>Save Changes</span>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </button>
        </div>
    </div>

    <div class="adm-form-grid">
        <!-- Main Content Area (8) -->
        <div class="adm-col-8" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Article Content</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="title">Article Title <span class="required">*</span></label>
                    <input type="text" id="title" name="title" class="adm-input" value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="slug">URL Slug <span class="required">*</span></label>
                    <input type="text" id="slug" name="slug" class="adm-input" value="{{ old('slug', $post->slug) }}" required>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="excerpt">Short Excerpt / Abstract</label>
                    <textarea id="excerpt" name="excerpt" class="adm-textarea" style="min-height: 80px;">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="content">Markdown / Article Body <span class="required">*</span></label>
                    <textarea id="content" name="content" class="adm-textarea" style="min-height: 400px; font-family: var(--adm-font-mono); font-size: 0.88rem; line-height: 1.6;" required>{{ old('content', $post->content) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Meta Sidebar (4) -->
        <div class="adm-col-4" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Publishing Settings -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Publishing</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="status">Publication Status</label>
                    <select id="status" name="status" class="adm-select">
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="category">Category / Topic <span class="required">*</span></label>
                    <input type="text" id="category" name="category" class="adm-input" value="{{ old('category', $post->category) }}" required>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="author">Author Name</label>
                    <input type="text" id="author" name="author" class="adm-input" value="{{ old('author', $post->author) }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="published_at">Publication Date</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="adm-input" value="{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : '' }}">
                </div>
            </div>

            <!-- Cover Image -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Featured Image</h2>
                </div>

                @if($post->cover_image)
                    <div style="margin-bottom: 1rem;">
                        <img src="{{ Str::startsWith($post->cover_image, 'http') ? $post->cover_image : (Str::startsWith($post->cover_image, 'blog/') ? asset('storage/' . $post->cover_image) : asset($post->cover_image)) }}" alt="{{ $post->title }}" style="width: 100%; max-height: 140px; object-fit: cover; border-radius: var(--adm-radius-sm); border: 1px solid var(--adm-border);">
                    </div>
                @endif

                <div class="adm-form-group">
                    <label class="adm-label">Change Cover File</label>
                    <input type="file" name="cover_image_file" class="adm-input" accept="image/*">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
