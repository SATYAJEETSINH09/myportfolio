@extends('layouts.portfolio')

@section('title', 'Engineering Notes & Articles — ' . ($settings['site_name'] ?? 'Satyajeetsinh Dodiya'))
@section('meta_description', 'Practical engineering takeaways on Laravel, database optimization, authentication, and backend architecture.')

@section('content')
  <section class="section" style="padding-top:8.5rem; min-height:85vh;">
    <div class="container">
      <div class="section-label reveal-on-scroll">07 / ENGINEERING NOTES</div>
      <div class="projects-header reveal-on-scroll">
        <div>
          <h1 class="section-title">THINGS I'VE<br>LEARNED.</h1>
        </div>
        <p class="section-subtitle">
          In-depth notes, architectural insights, and practical guides on Laravel backend engineering, database optimization, security, and cloud deployment.
        </p>
      </div>

      <!-- Categories / Filter Bar -->
      @if(isset($categories) && count($categories) > 0)
        <div style="display:flex; flex-wrap:wrap; gap:0.75rem; margin-top:2.5rem; margin-bottom:2.5rem;" class="reveal-on-scroll">
          <a href="{{ route('blog.index') }}" 
             class="btn {{ !request('category') ? 'btn-primary' : 'btn-secondary' }}" 
             style="font-size:0.75rem; padding:0.5rem 1rem;">
            ALL ({{ $posts->total() }})
          </a>
          @foreach($categories as $category)
            <a href="{{ route('blog.index', ['category' => $category]) }}" 
               class="btn {{ request('category') === $category ? 'btn-primary' : 'btn-secondary' }}" 
               style="font-size:0.75rem; padding:0.5rem 1rem;">
              {{ strtoupper($category) }}
            </a>
          @endforeach
        </div>
      @endif

      <!-- Notes Grid -->
      <div class="notes-grid reveal-on-scroll delay-200">
        @forelse($posts as $post)
          <article class="note-card" onclick="window.location.href='{{ route('blog.show', $post) }}'">
            <div>
              <div class="note-meta">
                <span class="note-cat">{{ strtoupper($post->category) }}</span>
                <span class="note-date">{{ $post->published_at ? $post->published_at->format('M Y') : 'SEP 2026' }}</span>
              </div>
              <h2 class="note-title" style="font-size:1.25rem;">{{ $post->title }}</h2>
              <p class="note-excerpt">
                {{ $post->excerpt }}
              </p>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:1.5rem;">
              <span class="btn-text">
                <span>Read Full Article</span> <span class="btn-arrow">↗</span>
              </span>
              <span style="font-family:var(--font-mono); font-size:0.75rem; color:var(--text-muted);">
                {{ $post->read_time ?? '5 min read' }}
              </span>
            </div>
          </article>
        @empty
          <div style="grid-column:1/-1; padding:4rem 2rem; text-align:center; border:1px dashed var(--border-primary); border-radius:12px;">
            <p style="font-family:var(--font-mono); color:var(--text-muted);">No articles found matching your criteria.</p>
            <a href="{{ route('blog.index') }}" class="btn btn-secondary btn-sm" style="margin-top:1.5rem;">VIEW ALL ARTICLES</a>
          </div>
        @endforelse
      </div>

      <!-- Pagination -->
      @if($posts->hasPages())
        <div style="margin-top:4rem; display:flex; justify-content:center;">
          {{ $posts->links() }}
        </div>
      @endif
    </div>
  </section>
@endsection
