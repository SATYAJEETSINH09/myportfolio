@extends('layouts.portfolio')

@section('title', $project->title . ' — Case Study · ' . ($settings['site_name'] ?? 'Satyajeetsinh Dodiya'))
@section('meta_description', $project->short_description ?? $project->description)

@section('content')
  <section class="section" style="padding-top:7.5rem; border-bottom:none;">
    <div class="container">
      
      <!-- Top Breadcrumb Navigation -->
      <div style="margin-bottom:2rem;">
        <a href="{{ route('portfolio.home') }}#work" class="btn-text" style="font-size:0.8125rem;">
          ← BACK TO SELECTED WORK
        </a>
      </div>

      <!-- Case Study Container Surface -->
      <div style="background:var(--bg-card); border:1px solid var(--border-primary); border-radius:var(--radius-2xl); overflow:hidden; box-shadow:var(--shadow-lg);">
        
        <!-- 1. Hero Header -->
        <div class="case-study-hero">
          <div class="section-label">01 / CASE STUDY</div>
          <h1 style="font-size:clamp(2.5rem, 5.5vw, 4rem); text-transform:uppercase; margin-bottom:0.5rem; line-height:1.02;">
            {{ $project->title }}
          </h1>
          <div style="font-family:var(--font-mono); font-size:1.1rem; color:var(--text-secondary); margin-bottom:1.5rem;">
            {{ $project->tagline }}
          </div>
          
          <div class="project-tech-pills">
            @foreach($project->technologies as $tech)
              <span class="tech-pill">{{ $tech->name }}</span>
            @endforeach
          </div>

          <div class="case-study-meta-grid">
            <div class="case-study-meta-item">
              <div class="label">ROLE</div>
              <div class="val">{{ $project->role ?? 'Backend Developer' }}</div>
            </div>
            <div class="case-study-meta-item">
              <div class="label">TIMELINE</div>
              <div class="val">{{ $project->year ?? '2025–2026' }}</div>
            </div>
            <div class="case-study-meta-item">
              <div class="label">SYSTEM TYPE</div>
              <div class="val">{{ $project->project_type ?? 'Web + Mobile Backend' }}</div>
            </div>
            <div class="case-study-meta-item">
              <div class="label">STATUS</div>
              <div class="val" style="color:var(--accent-dot);">● Production Active</div>
            </div>
          </div>
        </div>

        <!-- 2. Case Study Body Content -->
        <div class="case-study-body">
          
          <!-- The Challenge -->
          @if($project->challenge)
            <div>
              <div class="case-study-section-heading">THE PROBLEM & ARCHITECTURE CHALLENGE</div>
              <p style="font-size:1.15rem; line-height:1.75; color:var(--text-primary); margin-bottom:1.5rem;">
                {{ $project->challenge }}
              </p>
            </div>
          @endif

          <!-- Verified Performance Metrics -->
          @if($project->metrics && is_array($project->metrics))
            <div>
              <div class="case-study-section-heading">VERIFIED PRODUCTION PERFORMANCE</div>
              <div class="case-study-meta-grid" style="margin-top:0; margin-bottom:2rem;">
                @foreach($project->metrics as $metric)
                  <div class="case-study-meta-item">
                    <div class="label">{{ $metric['label'] }}</div>
                    <div class="val" style="font-size:1.65rem; color:var(--text-primary); font-family:var(--font-mono);">
                      {{ $metric['val'] }}
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- My Engineering Responsibilities -->
          @if($project->features->count() > 0)
            <div>
              <div class="case-study-section-heading">MY CORE RESPONSIBILITIES & ARCHITECTURE</div>
              <div class="role-breakdown-grid">
                @foreach($project->features as $idx => $feature)
                  <div class="role-step-item">
                    <span style="font-family:var(--font-mono); font-weight:700; color:var(--text-muted); font-size:0.8125rem;">0{{ $idx + 1 }}</span>
                    <div>
                      <div class="role-step-title">{{ $feature->title }}</div>
                      @if($feature->description)
                        <div style="font-size:0.85rem; color:var(--text-secondary); margin-top:0.25rem;">{{ $feature->description }}</div>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- System Architecture Diagram -->
          <div>
            <div class="case-study-section-heading">SYSTEM ARCHITECTURE TOPOLOGY</div>
            <div class="arch-diagram">
              <div class="arch-canvas">
                <div class="arch-layer">
                  <div class="arch-node">
                    <div class="arch-node-title">Mobile App (Flutter / React Native)</div>
                    <div class="arch-node-desc">Client Applications</div>
                  </div>
                  <div class="arch-node">
                    <div class="arch-node-title">Web Portal (SPA / Blade)</div>
                    <div class="arch-node-desc">Administrative Dashboards</div>
                  </div>
                </div>

                <div class="arch-connector-down">
                  <div class="arch-connector-line"></div>
                </div>

                <div class="arch-layer">
                  <div class="arch-node core-hub" style="width:100%;">
                    <div class="arch-node-title" style="font-size:1.1rem;">Laravel REST API Gateway</div>
                    <div class="arch-node-desc">Sanctum Authentication · Form Requests · Action Pattern Services · Rate Limiting</div>
                  </div>
                </div>

                <div class="arch-connector-down">
                  <div class="arch-connector-line"></div>
                </div>

                <div class="arch-layer">
                  <div class="arch-node">
                    <div class="arch-node-title">MySQL Database</div>
                    <div class="arch-node-desc">Relational DB with Indexes</div>
                  </div>
                  <div class="arch-node">
                    <div class="arch-node-title">Redis & Queue Workers</div>
                    <div class="arch-node-desc">Asynchronous FCM & Webhooks</div>
                  </div>
                  <div class="arch-node">
                    <div class="arch-node-title">Third-Party Services</div>
                    <div class="arch-node-desc">Firebase Cloud Messaging</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- API Showcase Specification -->
          @if($project->api_demo && is_array($project->api_demo))
            <div>
              <div class="case-study-section-heading">LIVE API ENDPOINT SPECIFICATION</div>
              <div class="api-showcase-box">
                <div class="api-endpoint-tabs">
                  <button class="api-tab-btn active">
                    <span class="api-req-badge api-req-{{ strtolower($project->api_demo['method'] ?? 'post') }}">
                      {{ $project->api_demo['method'] ?? 'POST' }}
                    </span> 
                    {{ $project->api_demo['endpoint'] ?? '/api/v1/resource' }}
                  </button>
                </div>
                <div class="api-showcase-content">
                  @if(!empty($project->api_demo['request']))
                    <div style="font-family:var(--font-mono); font-size:0.75rem; color:#A1A1AA; margin-bottom:0.5rem;">// REQUEST HEADERS & PAYLOAD:</div>
                    <pre style="color:#38BDF8; font-size:0.85rem; margin-bottom:1.25rem; overflow-x:auto;">{{ json_encode($project->api_demo['request'], JSON_PRETTY_PRINT) }}</pre>
                  @endif

                  @if(!empty($project->api_demo['response']))
                    <div style="font-family:var(--font-mono); font-size:0.75rem; color:#A1A1AA; margin-bottom:0.5rem;">// HTTP 200 OK RESPONSE:</div>
                    <pre style="color:#34D399; font-size:0.85rem; overflow-x:auto;">{{ json_encode($project->api_demo['response'], JSON_PRETTY_PRINT) }}</pre>
                  @endif
                </div>
              </div>
            </div>
          @endif

          <!-- Challenge & Solution Matrix -->
          @if($project->challenges->count() > 0)
            <div>
              <div class="case-study-section-heading">CHALLENGE & IMPLEMENTATION MATRIX</div>
              <div class="problem-solution-cards">
                @foreach($project->challenges as $item)
                  <div class="prob-sol-card">
                    <div class="prob-sol-tag challenge">THE CHALLENGE</div>
                    <p style="font-size:0.95rem; color:var(--text-primary); font-weight:700;">{{ $item->challenge }}</p>
                    <div style="margin-top:1.25rem;">
                      <div class="prob-sol-tag solution">MY SOLUTION</div>
                      <p style="font-size:0.875rem; color:var(--text-secondary); line-height:1.6;">{{ $item->solution }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Screenshot Gallery -->
          <div>
            <div class="case-study-section-heading">SYSTEM INTERFACE & ARTIFACTS</div>
            <div class="gallery-grid">
              <div class="gallery-item" onclick="window.openLightbox('{{ $project->title }} - Production Admin Management Dashboard')">
                <svg viewBox="0 0 500 300" style="width:100%; height:230px; background:#18181B;">
                  <rect x="20" y="20" width="460" height="260" rx="8" fill="#27272A" />
                  <rect x="40" y="40" width="100" height="220" rx="4" fill="#3F3F46" />
                  <rect x="160" y="40" width="300" height="40" rx="4" fill="#3F3F46" />
                  <rect x="160" y="95" width="140" height="75" rx="4" fill="#52525B" />
                  <rect x="320" y="95" width="140" height="75" rx="4" fill="#52525B" />
                  <rect x="160" y="185" width="300" height="75" rx="4" fill="#3F3F46" />
                  <text x="180" y="65" fill="#E4E4E7" font-family="monospace" font-size="12" font-weight="bold">{{ strtoupper($project->title) }} DASHBOARD</text>
                </svg>
                <div class="gallery-item-caption">Operations & Workflow Interface (Click to view)</div>
              </div>
              <div class="gallery-item" onclick="window.openLightbox('{{ $project->title }} - REST API Endpoint Schema')">
                <svg viewBox="0 0 500 300" style="width:100%; height:230px; background:#111113;">
                  <rect x="20" y="20" width="460" height="260" rx="8" fill="#1C1C20" />
                  <circle cx="45" cy="45" r="5" fill="#EF4444" />
                  <circle cx="65" cy="45" r="5" fill="#F59E0B" />
                  <circle cx="85" cy="45" r="5" fill="#10B981" />
                  <text x="45" y="85" fill="#38BDF8" font-family="monospace" font-size="11">> routes/api.php</text>
                  <text x="45" y="115" fill="#9CA3AF" font-family="monospace" font-size="11">Route::middleware(['auth:sanctum'])->group(function() {</text>
                  <text x="65" y="145" fill="#FBBF24" font-family="monospace" font-size="11">  Route::apiResource('{{ $project->slug }}', ApiController::class);</text>
                  <text x="45" y="175" fill="#9CA3AF" font-family="monospace" font-size="11">});</text>
                </svg>
                <div class="gallery-item-caption">API Architecture & Routing Definition (Click to view)</div>
              </div>
            </div>
          </div>

          <!-- Next Project Navigation -->
          @if(isset($nextProject) && $nextProject)
            <div style="border-top:1px solid var(--border-primary); padding-top:3rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem;">
              <div>
                <div style="font-family:var(--font-mono); font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.12em;">NEXT CASE STUDY</div>
                <h3 style="font-size:2rem; font-weight:800; text-transform:uppercase; margin-top:0.25rem;">{{ $nextProject->title }}</h3>
              </div>
              <a href="{{ route('projects.show', $nextProject) }}" class="btn btn-primary">
                VIEW NEXT PROJECT <span class="btn-arrow">↗</span>
              </a>
            </div>
          @endif

        </div>
      </div>
    </div>
  </section>
@endsection
