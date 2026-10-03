<!-- 02 / SELECTED PROJECTS SECTION -->
<section class="section" id="work">
  <div class="container">
    <div class="projects-header reveal-on-scroll">
      <div>
        <div class="section-label">02 / SELECTED WORK</div>
        <h2 class="section-title">REAL PRODUCTS.<br>REAL PROBLEMS.</h2>
      </div>
      <p class="section-subtitle">
        A curated selection of production backend systems, scalable REST APIs, and full stack web applications.
      </p>
    </div>

    <div class="projects-editorial-grid">
      @if(isset($featuredProject) && $featuredProject)
        <x-project-card :project="$featuredProject" :isFeatured="true" />
      @endif

      @php
        $secondaryProjects = isset($projects) ? $projects->where('featured', false)->values() : collect();
      @endphp

      @if($secondaryProjects->count() > 0)
        @foreach($secondaryProjects->chunk(2) as $chunkIndex => $chunk)
          <div class="projects-split-row {{ $chunkIndex % 2 === 1 ? 'alt' : '' }}">
            @foreach($chunk as $project)
              <x-project-card :project="$project" :isFeatured="false" />
            @endforeach
          </div>
        @endforeach
      @endif
    </div>
  </div>
</section>
