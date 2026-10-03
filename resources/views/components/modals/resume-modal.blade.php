<!-- Resume Preview Modal -->
<div class="modal-overlay" id="resume-modal" role="dialog" aria-modal="true" aria-label="Resume Preview">
  <div class="modal-container" style="max-width:820px;">
    <button class="modal-close-btn" id="close-resume-modal" aria-label="Close Resume">✕</button>
    <div class="case-study-hero">
      <div class="section-label">CURRICULUM VITAE</div>
      <h2 style="font-size:2.25rem; text-transform:uppercase;">{{ $settings['site_name'] ?? 'SATYAJEETSINH DODIYA' }}</h2>
      <div style="font-family:var(--font-mono); color:var(--text-secondary); margin-bottom:1.25rem;">
        {{ $settings['role'] ?? 'Laravel Backend Developer' }} · {{ $settings['location'] ?? 'Ahmedabad, India' }} · {{ $settings['email'] ?? 'satyajeetsinh.dodiya@gmail.com' }}
      </div>
      <div style="display:flex; gap:1rem; flex-wrap:wrap;">
        <a href="{{ route('resume.download') }}" class="btn btn-primary btn-sm">DOWNLOAD PDF ↓</a>
        <button class="btn btn-secondary btn-sm" onclick="window.print()">PRINT / SAVE ↓</button>
      </div>
    </div>
    <div class="case-study-body" style="padding:2.5rem; font-family:var(--font-mono); font-size:0.875rem;">
      <div style="margin-bottom:2rem;">
        <div style="font-weight:700; color:var(--text-primary); border-bottom:1px solid var(--border-primary); padding-bottom:0.5rem; margin-bottom:1rem;">
          // SUMMARY
        </div>
        <p style="font-family:var(--font-sans); font-size:1rem; color:var(--text-secondary);">
          {{ $settings['bio'] ?? 'Backend developer with hands-on production experience designing REST APIs, database schemas, and microservice integrations with Laravel, PHP, and MySQL.' }}
        </p>
      </div>

      <div style="margin-bottom:2rem;">
        <div style="font-weight:700; color:var(--text-primary); border-bottom:1px solid var(--border-primary); padding-bottom:0.5rem; margin-bottom:1rem;">
          // CORE SKILLS
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.5rem; color:var(--text-secondary);">
          <div>• Backend: Laravel, PHP 8.x, MySQL, REST API</div>
          <div>• Auth: Laravel Sanctum, JWT, RBAC</div>
          <div>• Services: Redis, Firebase FCM, Payment Gateways</div>
          <div>• Frontend: JavaScript (ES6+), Livewire, CSS3</div>
        </div>
      </div>

      <div>
        <div style="font-weight:700; color:var(--text-primary); border-bottom:1px solid var(--border-primary); padding-bottom:0.5rem; margin-bottom:1rem;">
          // WORK EXPERIENCE
        </div>
        <div style="margin-bottom:1.25rem;">
          <div style="font-weight:700; color:var(--text-primary);">Backend Developer — Binstellar Technologies Pvt. Ltd. (2025 — Present)</div>
          <div style="color:var(--text-secondary); margin-top:0.35rem;">
            • Engineered Laravel REST APIs for multi-school activity platforms (Dare Play).<br>
            • Built secure pharmacy verification flows (GoMeds247) and slot locking algorithms (Klean Health).<br>
            • Integrated Redis queues and Firebase FCM for real-time notifications.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
