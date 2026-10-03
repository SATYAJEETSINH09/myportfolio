<!-- 05 / EXPERIENCE SECTION (Editorial Timeline) -->
<section class="section" id="experience">
  <div class="container">
    <div class="section-label reveal-on-scroll">05 / EXPERIENCE</div>
    <h2 class="section-title reveal-on-scroll">CAREER TIMELINE</h2>
    <p class="section-subtitle reveal-on-scroll">
      Professional backend development positions and production engineering track record.
    </p>

    <div class="timeline-editorial reveal-on-scroll delay-200">
      @if(isset($experiences) && $experiences->count() > 0)
        @foreach($experiences as $exp)
          <div class="timeline-entry {{ $exp->is_current ? 'current' : '' }}">
            <div class="timeline-entry-dot"></div>
            <div class="timeline-year-label">
              <span>{{ $exp->period }}</span>
              @if($exp->is_current)
                <span class="timeline-current-tag">● CURRENT ROLE</span>
              @endif
            </div>
            <div class="timeline-surface-card">
              <h3 class="timeline-role-title">{{ strtoupper($exp->position) }}</h3>
              <div class="timeline-company-name">{{ $exp->company }}</div>
              
              @if($exp->stack)
                <div class="project-tech-pills" style="margin-bottom:1.25rem;">
                  @foreach(explode('·', $exp->stack) as $pill)
                    <span class="tech-pill">{{ trim($pill) }}</span>
                  @endforeach
                </div>
              @endif

              @if($exp->description)
                <p style="font-size:1.025rem; color:var(--text-secondary); line-height:1.65; margin-bottom:1.5rem;">
                  {{ $exp->description }}
                </p>
              @endif

              @if($exp->points->count() > 0)
                <div class="timeline-contributions-heading">KEY CONTRIBUTIONS</div>
                <ul class="timeline-contributions-list">
                  @foreach($exp->points as $idx => $pt)
                    <li class="timeline-contrib-item">
                      <span class="num">0{{ $idx + 1 }}</span>
                      <span>{{ $pt->text }}</span>
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
          </div>
        @endforeach
      @else
        <!-- Fallback Default Experience -->
        <div class="timeline-entry current">
          <div class="timeline-entry-dot"></div>
          <div class="timeline-year-label">
            <span>2025 — PRESENT</span>
            <span class="timeline-current-tag">● CURRENT ROLE</span>
          </div>
          <div class="timeline-surface-card">
            <h3 class="timeline-role-title">BACKEND DEVELOPER</h3>
            <div class="timeline-company-name">Binstellar Technologies Pvt. Ltd.</div>
            <p style="font-size:1rem; color:var(--text-secondary);">
              Develop and maintain production backend systems, scalable REST APIs, and administrative workflows.
            </p>
          </div>
        </div>
      @endif
    </div>
  </div>
</section>
