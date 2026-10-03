<!-- HERO SECTION -->
<section class="hero-section" id="hero">
  <div class="container">
    <div class="hero-grid">
      <!-- Left Column: Editorial Intro -->
      <div class="reveal-on-scroll">
        <div class="hero-eyebrow">
          <span class="status-pill">
            <span class="status-dot-pulse"></span>
            {{ strtoupper($settings['availability_status'] ?? 'AVAILABLE FOR SELECT PROJECTS') }}
          </span>
          <span style="font-family:var(--font-mono); font-size:0.75rem; color:var(--text-muted);">
            INDIA · {{ $settings['timezone'] ?? 'GMT+5:30' }}
          </span>
        </div>

        <h1 class="hero-title">
          <span class="title-line">SATYAJEETSINH</span>
          <span class="title-line highlight-outline">DODIYA</span>
        </h1>

        <div class="hero-role-badge">
          {{ strtoupper($settings['role'] ?? 'LARAVEL BACKEND DEVELOPER') }}
        </div>

        <p class="hero-description">
          {{ $settings['bio'] ?? 'I build scalable APIs, backend systems and production-ready web applications using Laravel, PHP and modern web technologies.' }}
        </p>

        <div class="hero-ctas">
          <a href="#work" class="btn btn-primary">
            VIEW MY WORK <span class="btn-arrow">↗</span>
          </a>
          <a href="#contact" class="btn btn-secondary">
            LET'S TALK <span class="btn-arrow">↗</span>
          </a>
          <a href="{{ route('resume.show') }}" class="btn btn-secondary">
            CURRICULUM VITAE <span class="btn-arrow">↗</span>
          </a>
        </div>

        <div class="hero-meta-strip">
          <span>● Production Focus</span>
          <span>● High Availability</span>
          <span>● Clean Architecture</span>
        </div>
      </div>

      <!-- Right Column: Interactive Developer Terminal -->
      <div class="hero-terminal-container reveal-on-scroll delay-200">
        <div class="terminal-card">
          <div class="terminal-header">
            <div class="terminal-dots">
              <span class="terminal-dot"></span>
              <span class="terminal-dot"></span>
              <span class="terminal-dot"></span>
            </div>
            <div class="terminal-title">satyajeetsinh.dev</div>
            <div class="terminal-actions">
              <button class="terminal-btn-action" id="copy-terminal-btn" title="Copy output">COPY</button>
            </div>
          </div>
          <div class="terminal-body" id="hero-terminal-body">
            <div class="terminal-line">
              <span class="terminal-prompt">></span>whoami
              <div class="terminal-output highlight">{{ $settings['site_name'] ?? 'Satyajeetsinh Dodiya' }}</div>
            </div>
            <div class="terminal-line">
              <span class="terminal-prompt">></span>role
              <div class="terminal-output">{{ $settings['role'] ?? 'Laravel Backend Developer' }}</div>
            </div>
            <div class="terminal-line">
              <span class="terminal-prompt">></span>stack
              <div class="terminal-output">Laravel · PHP · MySQL · REST API</div>
            </div>
            <div class="terminal-line">
              <span class="terminal-prompt">></span>status
              <div class="terminal-output terminal-status-online">● {{ $settings['availability_status'] ?? 'Available for opportunities' }}</div>
            </div>
            <div class="terminal-line" style="margin-bottom:0;">
              <span class="terminal-prompt">></span><span class="terminal-cursor"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scroll Indicator -->
  <div class="scroll-down-indicator" aria-hidden="true">
    <div class="scroll-mouse">
      <div class="scroll-wheel"></div>
    </div>
    <span>SCROLL</span>
  </div>
</section>

<!-- INFINITE MARQUEE TICKER -->
<div class="marquee-wrapper" aria-label="Technology Marquee">
  <div class="marquee-track">
    <span class="marquee-item">LARAVEL</span>
    <span class="marquee-item">PHP</span>
    <span class="marquee-item">MYSQL</span>
    <span class="marquee-item">REST API</span>
    <span class="marquee-item">LIVEWIRE</span>
    <span class="marquee-item">JAVASCRIPT</span>
    <span class="marquee-item">DOCKER</span>
    <span class="marquee-item">GIT</span>
    <span class="marquee-item">POSTMAN</span>
    <span class="marquee-item">LARAVEL SANCTUM</span>
    <span class="marquee-item">REDIS</span>
    <span class="marquee-item">FIREBASE FCM</span>
    <!-- Duplicated for seamless loop -->
    <span class="marquee-item">LARAVEL</span>
    <span class="marquee-item">PHP</span>
    <span class="marquee-item">MYSQL</span>
    <span class="marquee-item">REST API</span>
    <span class="marquee-item">LIVEWIRE</span>
    <span class="marquee-item">JAVASCRIPT</span>
    <span class="marquee-item">DOCKER</span>
    <span class="marquee-item">GIT</span>
    <span class="marquee-item">POSTMAN</span>
    <span class="marquee-item">LARAVEL SANCTUM</span>
    <span class="marquee-item">REDIS</span>
    <span class="marquee-item">FIREBASE FCM</span>
  </div>
</div>
