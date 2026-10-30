@extends('admin.layouts.app')

@section('title', 'Write New Engineering Article')
@section('page-title', 'Write New Article')

@section('content')
<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('admin.posts.index') }}" class="adm-btn adm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Articles</span>
        </a>
        <button type="submit" class="adm-btn adm-btn-primary">
            <span>Publish Article</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
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
                    <input type="text" id="title" name="title" class="adm-input" value="{{ old('title') }}" required placeholder="e.g. Architecting Scalable REST APIs in Laravel">
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="excerpt">Short Excerpt / Abstract</label>
                    <textarea id="excerpt" name="excerpt" class="adm-textarea" style="min-height: 80px;" placeholder="Brief synopsis shown on the blog feed and search engines...">{{ old('excerpt') }}</textarea>
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="content">Markdown / Article Body <span class="required">*</span></label>
                    <textarea id="content" name="content" class="adm-textarea" style="min-height: 400px; font-family: var(--adm-font-mono); font-size: 0.88rem; line-height: 1.6;" placeholder="### Heading 1&#10;Write full article in Markdown or HTML..." required>{{ old('content') }}</textarea>
                    <span class="adm-help">Supports full Markdown syntax, code blocks (```php), lists, and headers.</span>
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
                        <option value="published" selected>Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="category">Category / Topic <span class="required">*</span></label>
                    <input type="text" id="category" name="category" class="adm-input" value="{{ old('category', 'Laravel') }}" required placeholder="e.g. Laravel, Architecture, Database">
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="author">Author Name</label>
                    <input type="text" id="author" name="author" class="adm-input" value="{{ old('author', 'Satyajeetsinh Dodiya') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="published_at">Publication Date</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="adm-input">
                </div>
            </div>

            <!-- Cover Image -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Featured Image</h2>
                </div>

                <div class="adm-form-group">
                    <label class="adm-label">Upload Cover File</label>
                    <input type="file" name="cover_image_file" class="adm-input" accept="image/*">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
