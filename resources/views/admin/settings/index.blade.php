@extends('admin.layouts.app')

@section('title', 'Global Site Settings')
@section('page-title', 'Site Settings & Preferences')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <p style="color: var(--adm-text-muted); font-size: 0.88rem;">Configure site metadata, personal biography, social networks, and downloadable resume.</p>
        <button type="submit" class="adm-btn adm-btn-primary">
            <span>Save All Settings</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>

    <div class="adm-form-grid">
        <!-- Personal & Hero Profile -->
        <div class="adm-col-8" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Profile & Bio Configuration</h2>
                </div>

                <div class="adm-form-grid">
                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="site_name">Display Full Name</label>
                        <input type="text" id="site_name" name="site_name" class="adm-input" value="{{ $settings['site_name'] ?? 'Satyajeetsinh Dodiya' }}">
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="short_name">Short Name / Monogram</label>
                        <input type="text" id="short_name" name="short_name" class="adm-input" value="{{ $settings['short_name'] ?? 'SD.' }}">
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="role">Primary Professional Headline</label>
                        <input type="text" id="role" name="role" class="adm-input" value="{{ $settings['role'] ?? 'Laravel Backend Developer & System Architect' }}">
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="bio">Biography / Executive Summary</label>
                        <textarea id="bio" name="bio" class="adm-textarea" style="min-height: 100px;">{{ $settings['bio'] ?? '' }}</textarea>
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="availability_status">Availability Status Badge</label>
                        <input type="text" id="availability_status" name="availability_status" class="adm-input" value="{{ $settings['availability_status'] ?? 'Available for select projects' }}">
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="working_hours">Working Hours</label>
                        <input type="text" id="working_hours" name="working_hours" class="adm-input" value="{{ $settings['working_hours'] ?? '09:30 — 19:30 IST · Mon — Sat' }}">
                    </div>
                </div>
            </div>

            <!-- Social Networks & External Links -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Social Links & Developer Handles</h2>
                </div>

                <div class="adm-form-grid">
                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="github_url">GitHub URL</label>
                        <input type="url" id="github_url" name="github_url" class="adm-input" value="{{ $settings['github_url'] ?? '' }}" placeholder="https://github.com/...">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="linkedin_url">LinkedIn URL</label>
                        <input type="url" id="linkedin_url" name="linkedin_url" class="adm-input" value="{{ $settings['linkedin_url'] ?? '' }}" placeholder="https://linkedin.com/in/...">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="twitter_url">Twitter / X URL</label>
                        <input type="url" id="twitter_url" name="twitter_url" class="adm-input" value="{{ $settings['twitter_url'] ?? '' }}" placeholder="https://twitter.com/...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar / Contact & Resume -->
        <div class="adm-col-4" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Resume Document Upload -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Curriculum Vitae (PDF)</h2>
                </div>

                @if(!empty($settings['resume_file']))
                    <div style="font-size: 0.82rem; margin-bottom: 1rem; color: var(--adm-text-muted); display: flex; align-items: center; justify-content: space-between;">
                        <span>Current: <span style="font-family: var(--adm-font-mono); color: #818cf8;">{{ basename($settings['resume_file']) }}</span></span>
                        <a href="{{ route('resume.download') }}" target="_blank" class="adm-btn adm-btn-secondary adm-btn-sm">Test</a>
                    </div>
                @endif

                <div class="adm-form-group">
                    <label class="adm-label">Upload Updated PDF</label>
                    <input type="file" name="resume_pdf" class="adm-input" accept=".pdf">
                    <span class="adm-help">Max file size: 10MB (PDF format only)</span>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Contact Channels</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1rem;">
                    <label class="adm-label" for="email">Public Email</label>
                    <input type="email" id="email" name="email" class="adm-input" value="{{ $settings['email'] ?? 'satyajeetsinh.dodiya@gmail.com' }}">
                </div>

                <div class="adm-form-group" style="margin-bottom: 1rem;">
                    <label class="adm-label" for="phone">Phone / WhatsApp</label>
                    <input type="text" id="phone" name="phone" class="adm-input" value="{{ $settings['phone'] ?? '+91 98765 43210' }}">
                </div>

                <div class="adm-form-group" style="margin-bottom: 1rem;">
                    <label class="adm-label" for="location">Location / City</label>
                    <input type="text" id="location" name="location" class="adm-input" value="{{ $settings['location'] ?? 'Ahmedabad, Gujarat, India' }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="copyright_text">Footer Copyright Text</label>
                    <input type="text" id="copyright_text" name="copyright_text" class="adm-input" value="{{ $settings['copyright_text'] ?? '© 2026 Satyajeetsinh Dodiya. All rights reserved.' }}">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
