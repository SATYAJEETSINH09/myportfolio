@extends('layouts.portfolio')

@section('title', $post->title . ' — Engineering Notes — ' . ($settings['site_name'] ?? 'Satyajeetsinh Dodiya'))
@section('meta_description', $post->excerpt)

@push('styles')
<style>
  .article-container {
    max-width: 820px;
    margin: 0 auto;
  }
  .article-header {
    padding-top: 8.5rem;
    padding-bottom: 3.5rem;
    border-bottom: 1px solid var(--border-primary);
  }
  .article-body {
    padding: 3.5rem 0;
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--text-secondary);
  }
  .article-body h2 {
    font-family: var(--font-display);
    font-size: 1.75rem;
    color: var(--text-primary);
    margin-top: 2.75rem;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
  }
  .article-body h3 {
    font-family: var(--font-sans);
    font-weight: 700;
    font-size: 1.35rem;
    color: var(--text-primary);
    margin-top: 2rem;
    margin-bottom: 0.75rem;
  }
  .article-body p {
    margin-bottom: 1.5rem;
  }
  .article-body ul, .article-body ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
  }
  .article-body li {
    margin-bottom: 0.5rem;
  }
  .article-body pre {
    background: #09090B;
    color: #FAFAFA;
    padding: 1.5rem;
    border-radius: 8px;
    border: 1px solid #27272A;
    font-family: var(--font-mono);
    font-size: 0.875rem;
    overflow-x: auto;
    margin: 2rem 0;
    line-height: 1.6;
  }
  .article-body code {
    font-family: var(--font-mono);
    font-size: 0.9em;
    background: var(--bg-tertiary);
    color: var(--text-primary);
    padding: 0.15rem 0.4rem;
    border-radius: 4px;
    border: 1px solid var(--border-primary);
  }
  .article-body pre code {
    background: transparent;
    border: none;
    padding: 0;
    color: inherit;
  }
  .article-body blockquote {
    border-left: 3px solid var(--text-primary);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: var(--text-primary);
  }
  .article-footer {
    border-top: 1px solid var(--border-primary);
    padding: 3rem 0;
    margin-top: 3rem;
  }
</style>
@endpush

@section('content')
  <div class="container article-container">
    <!-- Back to Notes Navigation -->
    <div style="padding-top:7rem; margin-bottom:-6rem;">
      <a href="{{ route('blog.index') }}" class="btn-text">
        <span>← All Engineering Notes</span>
      </a>
    </div>

    <!-- Article Header -->
    <header class="article-header">
      <div class="section-label" style="margin-bottom:1rem;">
        {{ strtoupper($post->category) }} · {{ $post->published_at ? $post->published_at->format('M d, Y') : 'SEP 30, 2026' }} · {{ $post->read_time ?? '5 MIN READ' }}
      </div>
      <h1 class="section-title" style="font-size:clamp(2rem, 4.5vw, 3.25rem); line-height:1.15; margin-bottom:1.5rem;">
        {{ $post->title }}
      </h1>
      <p style="font-size:1.25rem; line-height:1.6; color:var(--text-secondary); font-family:var(--font-sans);">
        {{ $post->excerpt }}
      </p>

      <div style="display:flex; align-items:center; gap:1rem; margin-top:2rem; padding-top:1.5rem; border-top:1px dashed var(--border-primary);">
        <div style="width:40px; height:40px; border-radius:50%; background:var(--text-primary); color:var(--bg-primary); display:flex; align-items:center; justify-content:center; font-weight:800; font-family:var(--font-mono); font-size:0.875rem;">
          SD
        </div>
        <div>
          <div style="font-weight:700; color:var(--text-primary); font-size:0.95rem;">{{ $settings['site_name'] ?? 'Satyajeetsinh Dodiya' }}</div>
          <div style="font-size:0.8rem; font-family:var(--font-mono); color:var(--text-muted);">{{ $settings['role'] ?? 'Laravel Backend Developer' }}</div>
        </div>
      </div>
    </header>

    <!-- Article Content -->
    <article class="article-body">
      {!! nl2br(e($post->content)) !!}
    </article>

    <!-- Article Share & Next Actions -->
    <div class="article-footer">
      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem;">
        <div>
          <div style="font-family:var(--font-mono); font-size:0.8rem; color:var(--text-muted); margin-bottom:0.5rem;">
            SHARE THIS NOTE
          </div>
          <div style="display:flex; gap:0.75rem;">
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">
              X / TWITTER ↗
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">
              LINKEDIN ↗
            </a>
          </div>
        </div>
        <div>
          <a href="{{ route('portfolio.home') }}#contact" class="btn btn-primary btn-sm">
            DISCUSS THIS TOPIC ↗
          </a>
        </div>
      </div>
    </div>

    <!-- Related Articles -->
    @if(isset($relatedPosts) && $relatedPosts->count() > 0)
      <div style="margin-top:4rem; margin-bottom:6rem;">
        <div class="section-label">RELATED NOTES</div>
        <h3 style="font-family:var(--font-display); font-size:1.75rem; margin-bottom:2rem;">MORE IN {{ strtoupper($post->category) }}</h3>
        <div class="notes-grid">
          @foreach($relatedPosts as $related)
            <article class="note-card" onclick="window.location.href='{{ route('blog.show', $related) }}'">
              <div>
                <div class="note-meta">
                  <span class="note-cat">{{ strtoupper($related->category) }}</span>
                  <span class="note-date">{{ $related->published_at ? $related->published_at->format('M Y') : 'SEP 2026' }}</span>
                </div>
                <h4 class="note-title" style="font-size:1.15rem;">{{ $related->title }}</h4>
                <p class="note-excerpt">{{ $related->excerpt }}</p>
              </div>
              <div style="margin-top:1.5rem;">
                <span class="btn-text">
                  <span>Read Note</span> <span class="btn-arrow">↗</span>
                </span>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    @endif
  </div>
@endsection
