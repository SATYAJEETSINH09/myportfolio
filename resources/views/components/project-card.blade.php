@props(['project', 'isFeatured' => false])

@if($isFeatured)
  <article class="project-card-featured reveal-on-scroll" data-cursor-view>
    <div class="project-media-wrap">
      <span class="project-badge-float">FEATURED BACKEND SYSTEM</span>
      <div class="browser-mockup-frame project-mockup-featured">
        <div class="browser-bar">
          <div class="terminal-dots">
            <span class="terminal-dot"></span>
            <span class="terminal-dot"></span>
            <span class="terminal-dot"></span>
          </div>
          <div class="browser-url-pill">api.{{ $project->slug }}.io/v1/core</div>
        </div>
        <div class="mockup-content-body">
          <div class="mockup-title">> {{ strtoupper($project->title) }} ARCHITECTURE CORE</div>
          <div class="mockup-endpoint-box">
            <div class="mockup-endpoint-url">{{ $project->api_demo['endpoint'] ?? 'POST /api/v1/activities/complete' }}</div>
            <div class="mockup-status-line">● 200 OK · Atomic Transaction (38ms)</div>
          </div>
          <div class="mockup-subgrid">
            <div class="mockup-subcard">
              Scope: <span class="subcard-val">Production Active</span>
            </div>
            <div class="mockup-subcard">
              Queue: <span class="subcard-val-accent">Async Redis Workers</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="project-info-wrap">
      <div>
        <div class="project-num-tag">PROJECT {{ $project->project_number ?? '01' }} · {{ strtoupper($project->category) }}</div>
        <h3 class="project-title"><a href="{{ route('projects.show', $project) }}" style="color:inherit; text-decoration:none;">{{ strtoupper($project->title) }}</a></h3>
        <div class="project-subtitle">{{ $project->tagline }}</div>
        <p class="project-desc">
          {{ $project->short_description ?? $project->description }}
        </p>
        <div class="project-tech-pills">
          @foreach($project->technologies as $tech)
            <span class="tech-pill">{{ $tech->name }}</span>
          @endforeach
        </div>
      </div>
      <div class="project-actions">
        <a href="{{ route('projects.show', $project) }}" class="btn btn-primary">
          VIEW CASE STUDY <span class="btn-arrow">↗</span>
        </a>
        <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">
          SYSTEM DIAGRAM <span class="btn-arrow">↗</span>
        </a>
      </div>
    </div>
  </article>
@else
  <article class="project-card-split reveal-on-scroll" data-cursor-view>
    <div class="project-media-wrap">
      <div class="browser-mockup-frame project-mockup-standard">
        <div class="browser-bar">
          <div class="terminal-dots">
            <span class="terminal-dot"></span>
            <span class="terminal-dot"></span>
            <span class="terminal-dot"></span>
          </div>
          <div class="browser-url-pill">api.{{ $project->slug }}.com/v1</div>
        </div>
        <div class="mockup-content-body">
          <div class="mockup-title">> {{ strtoupper($project->title) }} ARCHITECTURE CORE</div>
          <div class="mockup-endpoint-box">
            <div class="mockup-endpoint-url">{{ $project->api_demo['endpoint'] ?? 'GET /api/v1/resource' }}</div>
            <div class="mockup-status-line">● 200 OK · Active Verification & Routing</div>
          </div>
          <div class="mockup-subgrid">
            <div class="mockup-subcard">
              Scope: <span class="subcard-val">Production Active</span>
            </div>
            <div class="mockup-subcard">
              Queue: <span class="subcard-val-accent">Async Redis Workers</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="project-info-wrap">
      <div>
        <div class="project-num-tag">PROJECT {{ $project->project_number ?? '02' }} · {{ strtoupper($project->category) }}</div>
        <h3 class="project-title"><a href="{{ route('projects.show', $project) }}" style="color:inherit; text-decoration:none;">{{ strtoupper($project->title) }}</a></h3>
        <div class="project-subtitle">{{ $project->tagline }}</div>
        <p class="project-desc">
          {{ $project->short_description ?? $project->description }}
        </p>
        <div class="project-tech-pills">
          @foreach($project->technologies as $tech)
            <span class="tech-pill">{{ $tech->name }}</span>
          @endforeach
        </div>
      </div>
      <div class="project-actions">
        <a href="{{ route('projects.show', $project) }}" class="btn btn-primary">
          VIEW CASE STUDY <span class="btn-arrow">↗</span>
        </a>
        <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">
          SYSTEM DIAGRAM <span class="btn-arrow">↗</span>
        </a>
      </div>
    </div>
  </article>
@endif
