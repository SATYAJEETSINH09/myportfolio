@props(['experiences' => collect(), 'educations' => collect()])

@php
  // Default education fallback if not passed
  $defaultEducations = [
      [
          'degree' => 'Bachelor of Engineering in Computer Engineering',
          'field' => 'Computer Engineering',
          'institution' => 'Government Engineering College, Modasa',
          'location' => 'Modasa, India',
          'period' => '2020 — 2025',
          'grade' => 'CGPA: 7.52',
          'badge' => 'B.E. DEGREE · CGPA: 7.52',
          'badge_type' => 'college',
          'description' => 'Bachelor of Engineering in Computer Engineering from Government Engineering College, Modasa with 7.52 CGPA, focusing on system architecture, database engineering, and software development.',
          'skills' => ['Computer Engineering', 'DBMS & MySQL', 'Data Structures', 'OOP', 'Web Architecture', 'CGPA: 7.52'],
          'highlights' => [
              'Graduated with CGPA 7.52 in Bachelor of Engineering (Computer Engineering).',
              'Specialized in Database Management Systems (MySQL), Data Structures & Algorithms, and System Architecture.',
              'Engineered capstone projects applying full-stack and backend engineering principles.',
          ],
      ],
      [
          'degree' => 'Higher Secondary Certificate — XII (GSEB)',
          'field' => 'Science & General Stream',
          'institution' => 'Shree D.A. Vidhya Mandir',
          'location' => 'Dhandhuka, India',
          'period' => '2020',
          'grade' => 'Score: 64%',
          'badge' => 'XII (GSEB) · 64%',
          'badge_type' => 'school',
          'description' => 'Completed Higher Secondary Certificate (Class XII) under Gujarat Secondary and Higher Secondary Education Board (GSEB) at Shree D.A. Vidhya Mandir with 64%.',
          'skills' => ['Mathematics', 'Computer Studies', 'Science & Logic', 'Score: 64%'],
          'highlights' => [
              'Scored 64% in Class XII (GSEB) with strong grounding in mathematics and science.',
              'Built foundational knowledge in discrete logic, algebra, and computational problem solving.',
          ],
      ],
  ];

  $educationsList = (isset($educations) && count($educations) > 0) ? $educations : $defaultEducations;
  $expCount = isset($experiences) ? count($experiences) : 1;
  $eduCount = count($educationsList);
  $totalCount = $expCount + $eduCount;
@endphp

<!-- 05 / EXPERIENCE & ACADEMICS SECTION -->
<section class="section" id="experience">
  <div class="container">
    <div class="section-label reveal-on-scroll">05 / CAREER & EDUCATION</div>
    <h2 class="section-title reveal-on-scroll">EXPERIENCE & ACADEMICS</h2>
    <p class="section-subtitle reveal-on-scroll">
      Production backend engineering positions alongside formal academic foundation in computer applications.
    </p>

    <!-- Filter Navigation Tabs -->
    <div class="timeline-filter-nav reveal-on-scroll delay-100">
      <button type="button" class="timeline-filter-btn active" data-filter="all">
        <span>ALL HISTORY</span>
        <span class="timeline-filter-badge">({{ $totalCount }})</span>
      </button>
      <button type="button" class="timeline-filter-btn" data-filter="work">
        <span>💼 WORK EXPERIENCE</span>
        <span class="timeline-filter-badge">({{ $expCount }})</span>
      </button>
      <button type="button" class="timeline-filter-btn" data-filter="education">
        <span>🎓 ACADEMIC EDUCATION</span>
        <span class="timeline-filter-badge">({{ $eduCount }})</span>
      </button>
    </div>

    <!-- Dual Track Grid -->
    <div class="timeline-dual-grid reveal-on-scroll delay-200">
      
      <!-- 01. WORK EXPERIENCE COLUMN -->
      <div class="timeline-column" id="col-work">
        <div class="timeline-column-header">
          <div class="timeline-column-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="opacity:0.75;"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
            <span>WORK EXPERIENCE</span>
          </div>
          <span class="timeline-column-count">{{ $expCount }} {{ $expCount === 1 ? 'POSITION' : 'POSITIONS' }}</span>
        </div>

        <div class="timeline-compact-track">
          @if(isset($experiences) && $experiences->count() > 0)
            @foreach($experiences as $exp)
              <div class="timeline-compact-entry {{ $exp->is_current ? 'current' : '' }}">
                <div class="timeline-compact-dot"></div>
                <div class="timeline-compact-card">
                  <div class="timeline-compact-header">
                    <h3 class="timeline-compact-title">{{ strtoupper($exp->position) }}</h3>
                    <div style="display:flex; align-items:center; gap:0.4rem; flex-wrap:wrap;">
                      <span class="timeline-compact-badge timeline-badge-year">{{ $exp->period }}</span>
                      @if($exp->is_current)
                        <span class="timeline-compact-badge timeline-badge-current">● CURRENT</span>
                      @endif
                    </div>
                  </div>

                  <div class="timeline-compact-institution">
                    <span style="font-weight:600; color:var(--text-primary);">{{ $exp->company }}</span>
                    @if($exp->location)
                      <span style="color:var(--text-muted);">·</span>
                      <span style="color:var(--text-muted);">{{ $exp->location }}</span>
                    @endif
                  </div>

                  @if($exp->stack)
                    <div class="timeline-compact-pills">
                      @foreach(explode('·', $exp->stack) as $pill)
                        <span class="timeline-compact-pill">{{ trim($pill) }}</span>
                      @endforeach
                    </div>
                  @endif

                  @if($exp->description)
                    <p class="timeline-compact-desc">
                      {{ $exp->description }}
                    </p>
                  @endif

                  @if($exp->points && $exp->points->count() > 0)
                    <ul class="timeline-compact-bullets">
                      @foreach($exp->points as $pt)
                        <li class="timeline-compact-bullet">
                          <span class="timeline-compact-bullet-marker">—</span>
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
            <div class="timeline-compact-entry current">
              <div class="timeline-compact-dot"></div>
              <div class="timeline-compact-card">
                <div class="timeline-compact-header">
                  <h3 class="timeline-compact-title">BACKEND DEVELOPER</h3>
                  <div style="display:flex; align-items:center; gap:0.4rem;">
                    <span class="timeline-compact-badge timeline-badge-year">March 2025 — Present</span>
                    <span class="timeline-compact-badge timeline-badge-current">● CURRENT</span>
                  </div>
                </div>
                <div class="timeline-compact-institution">
                  <span style="font-weight:600; color:var(--text-primary);">Binstellar Technologies Pvt. Ltd.</span>
                  <span style="color:var(--text-muted);">· India</span>
                </div>
                <div class="timeline-compact-pills">
                  <span class="timeline-compact-pill">Laravel</span>
                  <span class="timeline-compact-pill">PHP</span>
                  <span class="timeline-compact-pill">MySQL</span>
                  <span class="timeline-compact-pill">REST API</span>
                  <span class="timeline-compact-pill">JWT</span>
                  <span class="timeline-compact-pill">Postman</span>
                </div>
                <p class="timeline-compact-desc">
                  Built and maintained RESTful APIs in Laravel powering live education and healthcare platforms.
                </p>
                <ul class="timeline-compact-bullets">
                  <li class="timeline-compact-bullet"><span class="timeline-compact-bullet-marker">—</span><span>Built and maintained RESTful APIs in Laravel powering live education and healthcare platforms</span></li>
                  <li class="timeline-compact-bullet"><span class="timeline-compact-bullet-marker">—</span><span>Implemented JWT-based authentication and role-based authorization to secure multi-user access</span></li>
                  <li class="timeline-compact-bullet"><span class="timeline-compact-bullet-marker">—</span><span>Designed and developed scalable admin panel modules for data management and reporting</span></li>
                  <li class="timeline-compact-bullet"><span class="timeline-compact-bullet-marker">—</span><span>Optimized MySQL queries and database indexing, improving API response times</span></li>
                  <li class="timeline-compact-bullet"><span class="timeline-compact-bullet-marker">—</span><span>Tested and validated API endpoints using Postman prior to frontend integration</span></li>
                  <li class="timeline-compact-bullet"><span class="timeline-compact-bullet-marker">—</span><span>Collaborated with frontend engineers and cross-functional teams on API integration, following Laravel and Git best practices</span></li>
                </ul>
              </div>
            </div>
          @endif
        </div>
      </div>

      <!-- 02. ACADEMIC EDUCATION COLUMN -->
      <div class="timeline-column" id="col-education">
        <div class="timeline-column-header">
          <div class="timeline-column-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="opacity:0.75;"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
            <span>ACADEMIC BACKGROUND</span>
          </div>
          <span class="timeline-column-count">{{ $eduCount }} QUALIFICATIONS</span>
        </div>

        <div class="timeline-compact-track">
          @foreach($educationsList as $edu)
            <div class="timeline-compact-entry">
              <div class="timeline-compact-dot"></div>
              <div class="timeline-compact-card">
                <div class="timeline-compact-header">
                  <h3 class="timeline-compact-title">{{ strtoupper($edu['degree']) }}</h3>
                  <div style="display:flex; align-items:center; gap:0.4rem; flex-wrap:wrap;">
                    <span class="timeline-compact-badge timeline-badge-year">{{ $edu['period'] }}</span>
                    @if(($edu['badge_type'] ?? '') === 'college')
                      <span class="timeline-compact-badge timeline-badge-college">{{ $edu['badge'] }}</span>
                    @else
                      <span class="timeline-compact-badge timeline-badge-school">{{ $edu['badge'] }}</span>
                    @endif
                  </div>
                </div>

                <div class="timeline-compact-institution">
                  <span style="font-weight:600; color:var(--text-primary);">{{ $edu['institution'] }}</span>
                  @if(!empty($edu['location']))
                    <span style="color:var(--text-muted);">·</span>
                    <span style="color:var(--text-muted);">{{ $edu['location'] }}</span>
                  @endif
                </div>

                @if(!empty($edu['skills']))
                  <div class="timeline-compact-pills">
                    @foreach($edu['skills'] as $skill)
                      <span class="timeline-compact-pill">{{ $skill }}</span>
                    @endforeach
                  </div>
                @endif

                @if(!empty($edu['description']))
                  <p class="timeline-compact-desc">
                    {{ $edu['description'] }}
                  </p>
                @endif

                @if(!empty($edu['highlights']))
                  <ul class="timeline-compact-bullets">
                    @foreach($edu['highlights'] as $hl)
                      <li class="timeline-compact-bullet">
                        <span class="timeline-compact-bullet-marker">—</span>
                        <span>{{ $hl }}</span>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Timeline Interactive Filter Controller -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const filterBtns = document.querySelectorAll('.timeline-filter-btn');
    const colWork = document.getElementById('col-work');
    const colEdu = document.getElementById('col-education');

    if (!filterBtns.length || !colWork || !colEdu) return;

    filterBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        const filter = this.getAttribute('data-filter');

        // Update active class
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        if (filter === 'all') {
          colWork.classList.remove('hidden', 'full-width');
          colEdu.classList.remove('hidden', 'full-width');
        } else if (filter === 'work') {
          colWork.classList.remove('hidden');
          colWork.classList.add('full-width');
          colEdu.classList.add('hidden');
          colEdu.classList.remove('full-width');
        } else if (filter === 'education') {
          colEdu.classList.remove('hidden');
          colEdu.classList.add('full-width');
          colWork.classList.add('hidden');
          colWork.classList.remove('full-width');
        }
      });
    });
  });
</script>
