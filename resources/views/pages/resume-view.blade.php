@extends('layouts.portfolio')

@section('title', 'Curriculum Vitae — ' . ($settings['site_name'] ?? 'Satyajeetsinh Dodiya'))
@section('meta_description', 'Curriculum Vitae and professional background of Satyajeetsinh Dodiya, Laravel Backend Developer.')

@push('styles')
<style>
  .cv-page {
    max-width: 860px;
    margin: 8.5rem auto 5rem;
    padding: 3rem;
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: 12px;
  }
  @media print {
    body { background: #fff !important; color: #000 !important; }
    .cv-page { border: none !important; margin: 0 !important; padding: 0 !important; }
    header, footer, .chat-fab, .cursor-dot, .cursor-ring { display: none !important; }
  }
</style>
@endpush

@section('content')
  <div class="container">
    <div class="cv-page">
      <div style="margin-bottom:1.5rem;">
        <a href="{{ route('portfolio.home') }}" class="btn-text" style="font-size:0.8125rem;">
          ← BACK TO PORTFOLIO
        </a>
      </div>
      <div style="display:flex; justify-content:space-between; align-items:flex-start; border-bottom:2px solid var(--border-primary); padding-bottom:2rem; margin-bottom:2rem; flex-wrap:wrap; gap:1.5rem;">
        <div>
          <div class="section-label" style="margin-bottom:0.5rem;">CURRICULUM VITAE</div>
          <h1 style="font-family:var(--font-display); font-size:2.5rem; text-transform:uppercase; margin-bottom:0.5rem;">
            {{ $settings['site_name'] ?? 'SATYAJEETSINH DODIYA' }}
          </h1>
          <div style="font-family:var(--font-mono); color:var(--text-secondary); font-size:0.95rem;">
            {{ $settings['role'] ?? 'Laravel Backend Developer' }} · {{ $settings['location'] ?? 'Ahmedabad, Gujarat, India' }}
          </div>
          <div style="font-family:var(--font-mono); color:var(--text-muted); font-size:0.875rem; margin-top:0.25rem;">
            Email: {{ $settings['email'] ?? 'satyajeetsinh.dodiya@gmail.com' }} · Phone: {{ $settings['phone'] ?? '+91 84888 64288' }}
          </div>
        </div>
        <div style="display:flex; gap:0.75rem;">
          <button class="btn btn-secondary btn-sm" onclick="window.print()">PRINT / PDF ↓</button>
          <a href="{{ route('portfolio.home') }}#contact" class="btn btn-primary btn-sm">GET IN TOUCH ↗</a>
        </div>
      </div>

      <div style="margin-bottom:2.5rem;">
        <h2 style="font-family:var(--font-mono); font-size:1.1rem; color:var(--text-primary); border-bottom:1px solid var(--border-primary); padding-bottom:0.5rem; margin-bottom:1rem;">
          // 01. EXECUTIVE SUMMARY
        </h2>
        <p style="font-size:1rem; line-height:1.7; color:var(--text-secondary);">
          {{ $settings['bio'] ?? 'Laravel Backend Developer with hands-on experience in building scalable RESTful APIs, database schema design, and microservice integrations using Laravel, PHP, and MySQL. Proven track record in high-traffic applications including gaming platforms, pharmacy management, and healthcare slot booking systems.' }}
        </p>
      </div>

      <div style="margin-bottom:2.5rem;">
        <h2 style="font-family:var(--font-mono); font-size:1.1rem; color:var(--text-primary); border-bottom:1px solid var(--border-primary); padding-bottom:0.5rem; margin-bottom:1rem;">
          // 02. TECHNICAL SKILLS
        </h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:1.25rem; font-size:0.9rem;">
          <div>
            <div style="font-weight:700; color:var(--text-primary); font-family:var(--font-mono); margin-bottom:0.35rem;">Backend & Frameworks</div>
            <div style="color:var(--text-secondary);">PHP 8.2+, Laravel 10/11, REST APIs, Eloquent ORM, MVC Architecture</div>
          </div>
          <div>
            <div style="font-weight:700; color:var(--text-primary); font-family:var(--font-mono); margin-bottom:0.35rem;">Databases & Caching</div>
            <div style="color:var(--text-secondary);">MySQL, PostgreSQL, Redis, Query Optimization, Database Indexing</div>
          </div>
          <div>
            <div style="font-weight:700; color:var(--text-primary); font-family:var(--font-mono); margin-bottom:0.35rem;">Security & Auth</div>
            <div style="color:var(--text-secondary);">Laravel Sanctum, JWT, RBAC, OAuth2, Rate Limiting, CORS</div>
          </div>
          <div>
            <div style="font-weight:700; color:var(--text-primary); font-family:var(--font-mono); margin-bottom:0.35rem;">DevOps & Tools</div>
            <div style="color:var(--text-secondary);">Git, GitHub, Docker, Postman, Linux Server Setup, Nginx, CI/CD</div>
          </div>
        </div>
      </div>

      <div style="margin-bottom:2.5rem;">
        <h2 style="font-family:var(--font-mono); font-size:1.1rem; color:var(--text-primary); border-bottom:1px solid var(--border-primary); padding-bottom:0.5rem; margin-bottom:1rem;">
          // 03. PROFESSIONAL EXPERIENCE
        </h2>
        <div style="margin-bottom:1.75rem;">
          <div style="display:flex; justify-content:space-between; align-items:baseline; flex-wrap:wrap;">
            <div style="font-weight:700; font-size:1.05rem; color:var(--text-primary);">Backend Developer — Binstellar Technologies Pvt. Ltd.</div>
            <div style="font-family:var(--font-mono); font-size:0.85rem; color:var(--text-muted);">March 2025 — Present · India</div>
          </div>
          <ul style="margin-top:0.75rem; padding-left:1.25rem; color:var(--text-secondary); line-height:1.7; font-size:0.925rem;">
            <li>Built and maintained RESTful APIs in Laravel powering live education and healthcare platforms.</li>
            <li>Implemented JWT-based authentication and role-based authorization to secure multi-user access.</li>
            <li>Designed and developed scalable admin panel modules for data management and reporting.</li>
            <li>Optimized MySQL queries and database indexing, improving API response times.</li>
            <li>Tested and validated API endpoints using Postman prior to frontend integration.</li>
            <li>Collaborated with frontend engineers and cross-functional teams on API integration, following Laravel and Git best practices.</li>
          </ul>
        </div>
      </div>

      <div>
        <h2 style="font-family:var(--font-mono); font-size:1.1rem; color:var(--text-primary); border-bottom:1px solid var(--border-primary); padding-bottom:0.5rem; margin-bottom:1rem;">
          // 04. EDUCATION & ACADEMIC BACKGROUND
        </h2>
        <div style="margin-bottom:1.25rem;">
          <div style="display:flex; justify-content:space-between; align-items:baseline; flex-wrap:wrap; margin-bottom:0.25rem;">
            <div style="font-weight:700; color:var(--text-primary);">Bachelor of Engineering in Computer Engineering (CGPA: 7.52)</div>
            <div style="font-family:var(--font-mono); font-size:0.85rem; color:var(--text-muted);">2020 — 2025 · Modasa, India</div>
          </div>
          <div style="font-size:0.85rem; color:var(--text-secondary);">Government Engineering College, Modasa · Core studies in Database Systems, Operating Systems, Data Structures & Software Engineering.</div>
        </div>
        <div>
          <div style="display:flex; justify-content:space-between; align-items:baseline; flex-wrap:wrap; margin-bottom:0.25rem;">
            <div style="font-weight:700; color:var(--text-primary);">Class XII (GSEB) — 64%</div>
            <div style="font-family:var(--font-mono); font-size:0.85rem; color:var(--text-muted);">2020 · Dhandhuka, India</div>
          </div>
          <div style="font-size:0.85rem; color:var(--text-secondary);">Shree D.A. Vidhya Mandir · Gujarat Secondary and Higher Secondary Education Board (GSEB).</div>
        </div>
      </div>
    </div>
  </div>
@endsection
