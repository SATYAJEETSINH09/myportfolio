<header class="navbar" id="navbar">
  <div class="container navbar-inner">
    <a href="{{ route('portfolio.home') }}" class="brand-logo" aria-label="{{ $settings['site_name'] ?? 'Satyajeetsinh Dodiya' }} Home">
      {{ $settings['short_name'] ?? 'SD.' }}
    </a>

    <nav aria-label="Primary Navigation">
      <ul class="nav-links">
        @if(isset($navItems) && $navItems->count() > 0)
          @foreach($navItems as $item)
            <li><a href="{{ $item->url }}" class="nav-link" target="{{ $item->target }}">{{ $item->label }}</a></li>
          @endforeach
        @else
          <li><a href="#work" class="nav-link">Work</a></li>
          <li><a href="#about" class="nav-link">About</a></li>
          <li><a href="#expertise" class="nav-link">Expertise</a></li>
          <li><a href="#toolkit" class="nav-link">Toolkit</a></li>
          <li><a href="#experience" class="nav-link">Experience</a></li>
          <li><a href="#services" class="nav-link">Services</a></li>
          <li><a href="#notes" class="nav-link">Notes</a></li>
          <li><a href="#contact" class="nav-link">Contact</a></li>
        @endif
      </ul>
    </nav>

    <div class="nav-actions">
      @include('components.theme-toggle')
      <a href="{{ route('resume.show') }}" class="btn btn-secondary btn-sm" aria-label="View Curriculum Vitae">
        RESUME
      </a>
      <a href="#contact" class="btn btn-primary btn-sm">
        LET'S TALK <span class="btn-arrow">↗</span>
      </a>
      <button class="mobile-nav-toggle" id="mobile-nav-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
        ☰
      </button>
    </div>
  </div>
</header>

<!-- Fullscreen Mobile Navigation Menu -->
<div class="mobile-menu-overlay" id="mobile-menu-overlay" aria-hidden="true">
  <ul class="mobile-nav-list">
    <li><a href="#work" class="mobile-nav-link"><span>Selected Work</span> <span class="num">02</span></a></li>
    <li><a href="#about" class="mobile-nav-link"><span>About</span> <span class="num">01</span></a></li>
    <li><a href="#expertise" class="mobile-nav-link"><span>Expertise</span> <span class="num">03</span></a></li>
    <li><a href="#toolkit" class="mobile-nav-link"><span>Toolkit</span> <span class="num">04</span></a></li>
    <li><a href="#experience" class="mobile-nav-link"><span>Experience</span> <span class="num">05</span></a></li>
    <li><a href="#services" class="mobile-nav-link"><span>Services</span> <span class="num">06</span></a></li>
    <li><a href="#notes" class="mobile-nav-link"><span>Notes</span> <span class="num">07</span></a></li>
    <li><a href="#contact" class="mobile-nav-link"><span>Contact</span> <span class="num">08</span></a></li>
  </ul>
  <div style="display:flex; gap:1rem; flex-direction:column;">
    <a href="{{ route('resume.show') }}" class="btn btn-secondary" style="width:100%; justify-content:center;">VIEW CV / RESUME</a>
    <a href="#contact" class="btn btn-primary" style="width:100%; justify-content:center;">LET'S TALK <span class="btn-arrow">↗</span></a>
  </div>
</div>
