<!-- 07 / ENGINEERING NOTES SECTION -->
<section class="section" id="notes">
  <div class="container">
    <div class="section-label reveal-on-scroll">07 / ENGINEERING NOTES</div>
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1.5rem; margin-bottom:1rem;">
      <div>
        <h2 class="section-title reveal-on-scroll" style="margin-bottom:0.75rem;">THINGS I'VE<br>LEARNED BUILDING<br>SOFTWARE.</h2>
        <p class="section-subtitle reveal-on-scroll">
          Practical engineering takeaways on Laravel, database optimization, authentication, and Docker deployment.
        </p>
      </div>
      <a href="{{ route('blog.index') }}" class="btn btn-secondary reveal-on-scroll">
        ALL ARTICLES <span class="btn-arrow">↗</span>
      </a>
    </div>

    <div class="notes-grid reveal-on-scroll delay-200">
      @if(isset($blogPosts) && $blogPosts->count() > 0)
        @foreach($blogPosts as $post)
          <article class="note-card" onclick="window.location.href='{{ route('blog.show', $post) }}'">
            <div>
              <div class="note-meta">
                <span class="note-cat">{{ strtoupper($post->category) }}</span>
                <span class="note-date">{{ $post->published_at ? $post->published_at->format('M Y') : 'SEP 2026' }}</span>
              </div>
              <h3 class="note-title"><a href="{{ route('blog.show', $post) }}" style="color:inherit; text-decoration:none;">{{ $post->title }}</a></h3>
              <p class="note-excerpt">
                {{ $post->excerpt }}
              </p>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center;">
              <a href="{{ route('blog.show', $post) }}" class="btn-text">
                <span>Read Full Note</span> <span class="btn-arrow">↗</span>
              </a>
              <span class="btn-text" style="font-size:0.75rem; color:var(--text-muted);">
                Article Page ↗
              </span>
            </div>
          </article>
        @endforeach
      @endif
    </div>
  </div>
</section>
