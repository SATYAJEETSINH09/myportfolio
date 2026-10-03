<!-- MINIMAL EDITORIAL FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-brand-title">{{ $settings['short_name'] ?? 'SD.' }}</div>
        <div style="font-family:var(--font-mono); font-size:0.875rem; font-weight:700; color:var(--text-primary); margin-bottom:0.75rem;">
          {{ strtoupper($settings['site_name'] ?? 'SATYAJEETSINH DODIYA') }}
        </div>
        <p class="footer-brand-desc">
          {{ $settings['bio'] ?? 'Laravel Backend Developer crafting scalable REST APIs, reliable database architectures, and production web applications.' }}
        </p>
      </div>

      <div>
        <div class="footer-col-title">NAVIGATION</div>
        <ul class="footer-links">
          <li><a href="{{ route('portfolio.home') }}#work" class="footer-link">Selected Work</a></li>
          <li><a href="{{ route('portfolio.home') }}#about" class="footer-link">About Identity</a></li>
          <li><a href="{{ route('portfolio.home') }}#expertise" class="footer-link">Backend Expertise</a></li>
          <li><a href="{{ route('portfolio.home') }}#toolkit" class="footer-link">Technical Toolkit</a></li>
          <li><a href="{{ route('portfolio.home') }}#experience" class="footer-link">Career Experience</a></li>
          <li><a href="{{ route('portfolio.home') }}#services" class="footer-link">Services</a></li>
          <li><a href="{{ route('portfolio.home') }}#notes" class="footer-link">Engineering Notes</a></li>
          <li><a href="{{ route('portfolio.home') }}#contact" class="footer-link">Start Conversation</a></li>
        </ul>
      </div>

      <div>
        <div class="footer-col-title">CONNECT</div>
        <ul class="footer-links">
          <li><a href="{{ $settings['github_url'] ?? 'https://github.com/satyajeetsinh-dodiya' }}" target="_blank" rel="noopener noreferrer" class="footer-link">GitHub ↗</a></li>
          <li><a href="{{ $settings['linkedin_url'] ?? 'https://linkedin.com/in/satyajeetsinh-dodiya' }}" target="_blank" rel="noopener noreferrer" class="footer-link">LinkedIn ↗</a></li>
          <li><a href="mailto:{{ $settings['email'] ?? 'satyajeetsinh.dodiya@gmail.com' }}" class="footer-link">Email ↗</a></li>
          <li><a href="{{ route('resume.show') }}" class="footer-link">Curriculum Vitae ↗</a></li>
          <li><a href="{{ route('resume.download') }}" class="footer-link">Resume PDF ↓</a></li>
        </ul>
      </div>

      <div>
        <div class="footer-col-title">LOCATION & TIME</div>
        <div style="font-family:var(--font-mono); font-size:0.875rem; color:var(--text-primary); margin-bottom:0.5rem;">
          {{ $settings['location'] ?? 'Ahmedabad, India' }}
        </div>
        <div id="live-time-val" style="font-family:var(--font-mono); font-size:0.8125rem; color:var(--text-muted); margin-bottom:1.5rem;">
          --:--:-- IST (GMT+5:30)
        </div>
        <button class="btn btn-secondary btn-sm" id="back-to-top-btn" aria-label="Back to top">
          BACK TO TOP ↑
        </button>
      </div>
    </div>

    <div class="footer-bottom">
      <div>
        {{ $settings['copyright_text'] ?? '© 2026 Satyajeetsinh Dodiya. All rights reserved.' }}
      </div>
      <div>
        Crafted with Precision · Minimal Monochrome · Fast & Accessible
      </div>
    </div>
  </div>
</footer>
