<!-- 08 / CONTACT SECTION (Editorial Composition) -->
<section class="section section-contact" id="contact" style="border-bottom:none;">
  <div class="container">
    <div class="section-label reveal-on-scroll">08 / CONTACT</div>

    <div class="contact-editorial-layout">
      <!-- Left Column: Big Editorial Heading, Details & Socials -->
      <div class="contact-editorial-left reveal-on-scroll">
        <div class="contact-heading-group">
          <h2 class="contact-main-heading">
            <span class="contact-heading-line">HAVE A PROJECT</span>
            <span class="contact-heading-line">IN MIND?</span>
          </h2>
          <div class="contact-sub-statement">
            LET'S BUILD SOMETHING USEFUL.
          </div>
        </div>

        <p class="contact-description">
          {{ $settings['availability_status'] ?? 'Available for freelance projects, backend development and full-time opportunities.' }}
        </p>

        <div class="contact-details-grid">
          <div class="contact-meta-item">
            <span class="contact-meta-label">EMAIL DIRECTLY</span>
            <a href="mailto:{{ $settings['email'] ?? 'satyajeetsinh.dodiya@gmail.com' }}" class="contact-meta-link">
              {{ $settings['email'] ?? 'satyajeetsinh.dodiya@gmail.com' }}
            </a>
          </div>

          <div class="contact-meta-item">
            <span class="contact-meta-label">LOCATION</span>
            <span class="contact-meta-val">{{ $settings['location'] ?? 'Ahmedabad, Gujarat, India' }}</span>
          </div>

          <div class="contact-meta-item">
            <span class="contact-meta-label">WORKING HOURS</span>
            <span class="contact-meta-val">{{ $settings['working_hours'] ?? '09:30 — 19:30 IST · Mon — Sat' }}</span>
          </div>
        </div>

        <div class="contact-socials">
          <span class="contact-meta-label" style="margin-bottom:0.75rem;">CONNECT</span>
          <div class="contact-social-links">
            <a href="{{ $settings['github_url'] ?? 'https://github.com/satyajeetsinh-dodiya' }}" target="_blank" rel="noopener noreferrer" class="contact-social-link">
              GitHub <span class="btn-arrow">↗</span>
            </a>
            <a href="{{ $settings['linkedin_url'] ?? 'https://linkedin.com/in/satyajeetsinh-dodiya' }}" target="_blank" rel="noopener noreferrer" class="contact-social-link">
              LinkedIn <span class="btn-arrow">↗</span>
            </a>
            <a href="mailto:{{ $settings['email'] ?? 'satyajeetsinh.dodiya@gmail.com' }}" class="contact-social-link">
              Email <span class="btn-arrow">↗</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Thin Vertical Divider Line -->
      <div class="contact-vertical-divider" aria-hidden="true"></div>

      <!-- Right Column: Minimal Editorial Form -->
      <div class="contact-editorial-right reveal-on-scroll delay-200">
        <div class="contact-form-header">
          <span class="contact-form-tag">START A CONVERSATION</span>
        </div>

        <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="contact-minimal-form" novalidate>
          @csrf
          <div class="minimal-form-field">
            <label for="contact-name" class="minimal-form-label">NAME *</label>
            <input type="text" name="name" id="contact-name" class="minimal-form-input" placeholder="Your name" required autocomplete="name">
            <span class="minimal-input-focus-line"></span>
          </div>

          <div class="minimal-form-field">
            <label for="contact-email" class="minimal-form-label">EMAIL *</label>
            <input type="email" name="email" id="contact-email" class="minimal-form-input" placeholder="your@email.com" required autocomplete="email">
            <span class="minimal-input-focus-line"></span>
          </div>

          <div class="minimal-form-field">
            <label for="contact-type" class="minimal-form-label">PROJECT TYPE</label>
            <select name="project_type" id="contact-type" class="minimal-form-input minimal-form-select" required>
              <option value="" disabled selected>Select project type</option>
              <option value="api">REST API & Backend Architecture</option>
              <option value="laravel">Full Laravel Web Application</option>
              <option value="database">Database Schema & Performance Tuning</option>
              <option value="fulltime">Full-time Backend Opportunity</option>
              <option value="other">Other Collaboration</option>
            </select>
            <span class="minimal-input-focus-line"></span>
          </div>

          <div class="minimal-form-field">
            <label for="contact-budget" class="minimal-form-label">BUDGET</label>
            <input type="text" name="budget" id="contact-budget" class="minimal-form-input" placeholder="Optional (e.g. $1,500+ / INR)">
            <span class="minimal-input-focus-line"></span>
          </div>

          <div class="minimal-form-field">
            <label for="contact-message" class="minimal-form-label">PROJECT DETAILS *</label>
            <textarea name="message" id="contact-message" class="minimal-form-input minimal-form-textarea" placeholder="Tell me about your project, timeline and goals..." required rows="4"></textarea>
            <span class="minimal-input-focus-line"></span>
          </div>

          <div class="minimal-form-submit-wrap">
            <button type="submit" id="contact-submit-btn" class="btn btn-primary contact-submit-btn">
              SEND MESSAGE <span class="btn-arrow">↗</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
