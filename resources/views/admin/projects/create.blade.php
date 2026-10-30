@extends('admin.layouts.app')

@section('title', 'Create New Project')
@section('page-title', 'Create New Project')

@section('content')
<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('admin.projects.index') }}" class="adm-btn adm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Projects</span>
        </a>
        <button type="submit" class="adm-btn adm-btn-primary">
            <span>Publish Project</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>

    <div class="adm-form-grid">
        <!-- Main Form Column (8) -->
        <div class="adm-col-8" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Core Details -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Project Overview</h2>
                </div>

                <div class="adm-form-grid">
                    <div class="adm-col-8 adm-form-group">
                        <label class="adm-label" for="title">Project Title <span class="required">*</span></label>
                        <input type="text" id="title" name="title" class="adm-input" value="{{ old('title') }}" required placeholder="e.g. Dare Play Backend Platform">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="project_number">Project Number</label>
                        <input type="text" id="project_number" name="project_number" class="adm-input" value="{{ old('project_number', '01') }}" placeholder="01, 02...">
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="tagline">Tagline / Subheading</label>
                        <input type="text" id="tagline" name="tagline" class="adm-input" value="{{ old('tagline') }}" placeholder="e.g. Scalable Activity Management & High Throughput Notifications">
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="category">Category <span class="required">*</span></label>
                        <input type="text" id="category" name="category" class="adm-input" value="{{ old('category', 'Backend Architecture') }}" required placeholder="e.g. Fintech, SaaS, API Platform">
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="project_type">Project Type</label>
                        <input type="text" id="project_type" name="project_type" class="adm-input" value="{{ old('project_type', 'REST API & Web Platform') }}" placeholder="e.g. Web + Mobile API">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="role">My Role</label>
                        <input type="text" id="role" name="role" class="adm-input" value="{{ old('role', 'Lead Backend Developer') }}" placeholder="e.g. Full Stack Architect">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="client">Client / Company</label>
                        <input type="text" id="client" name="client" class="adm-input" value="{{ old('client') }}" placeholder="e.g. Global Tech Enterprise">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="year">Year / Duration</label>
                        <input type="text" id="year" name="year" class="adm-input" value="{{ old('year', '2025–2026') }}" placeholder="e.g. 2025–2026">
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="short_description">Short Summary (Shown on Cards)</label>
                        <textarea id="short_description" name="short_description" class="adm-textarea" style="min-height: 70px;" placeholder="Brief summary for listings...">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="description">Detailed Description & Architecture</label>
                        <textarea id="description" name="description" class="adm-textarea" style="min-height: 140px;" placeholder="Comprehensive breakdown of architecture and engineering decisions...">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Engineering Challenges & Solutions -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Case Study: Challenge & Solution</h2>
                </div>

                <div class="adm-form-grid">
                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="challenge">Primary Architectural Challenge</label>
                        <textarea id="challenge" name="challenge" class="adm-textarea" style="min-height: 90px;" placeholder="What was the technical bottleneck or scaling obstacle?">{{ old('challenge') }}</textarea>
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="solution">Engineered Solution</label>
                        <textarea id="solution" name="solution" class="adm-textarea" style="min-height: 90px;" placeholder="How did you solve it (e.g. Redis queues, caching, database indexing)?">{{ old('solution') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Features Repeater -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Key Features</h2>
                    <button type="button" class="adm-btn adm-btn-secondary adm-btn-sm" onclick="addFeatureRow()">+ Add Feature</button>
                </div>
                
                <div id="featuresContainer" class="adm-repeater-box">
                    <div class="adm-repeater-item">
                        <div style="flex: 1; display: flex; flex-direction: column; gap: 0.5rem;">
                            <input type="text" name="features_titles[]" class="adm-input" placeholder="Feature title (e.g. Real-Time Push Notifications)">
                            <textarea name="features_descriptions[]" class="adm-textarea" style="min-height: 60px;" placeholder="Feature description..."></textarea>
                        </div>
                        <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                    </div>
                </div>
            </div>

            <!-- Metrics -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Performance Metrics / Impact Numbers</h2>
                    <button type="button" class="adm-btn adm-btn-secondary adm-btn-sm" onclick="addMetricRow()">+ Add Metric</button>
                </div>

                <div id="metricsContainer" class="adm-repeater-box">
                    <div class="adm-repeater-item">
                        <input type="text" name="metrics_labels[]" class="adm-input" style="flex: 1;" placeholder="Label (e.g. API Latency)">
                        <input type="text" name="metrics_values[]" class="adm-input" style="flex: 1;" placeholder="Value (e.g. <45ms)">
                        <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options Column (4) -->
        <div class="adm-col-4" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Publishing & Status -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Status & Visibility</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="status">Project Status</label>
                    <select id="status" name="status" class="adm-select">
                        <option value="completed" selected>Completed & Production</option>
                        <option value="in_progress">In Progress</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="sort_order">Display Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="adm-input" value="{{ old('sort_order', 0) }}">
                </div>

                <div class="adm-form-group" style="margin-bottom: 0.5rem;">
                    <label class="adm-switch-wrap">
                        <div class="adm-switch">
                            <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                            <span class="adm-slider"></span>
                        </div>
                        <div>
                            <div style="font-weight: 600; font-size: 0.88rem;">Feature on Homepage</div>
                            <div style="font-size: 0.72rem; color: var(--adm-text-dim);">Highlighted in hero showcase</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Cover Image Upload -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Cover Image</h2>
                </div>

                <div class="adm-form-group">
                    <label class="adm-label">Upload Cover File</label>
                    <input type="file" name="cover_image_file" class="adm-input" accept="image/*">
                    <span class="adm-help">Recommended ratio: 16:9 or 4:3 (PNG, JPG, WebP)</span>
                </div>

                <div class="adm-form-group" style="margin-top: 1rem;">
                    <label class="adm-label" for="cover_image">Or Cover Image URL / Path</label>
                    <input type="text" id="cover_image" name="cover_image" class="adm-input" value="{{ old('cover_image') }}" placeholder="projects/dare-play.png">
                </div>
            </div>

            <!-- Technologies -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Technologies Used</h2>
                    <button type="button" class="adm-btn adm-btn-secondary adm-btn-sm" onclick="addTechTag()">+ Add Tech</button>
                </div>

                <div id="techContainer" style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" name="technologies[]" class="adm-input" placeholder="e.g. Laravel 11, Redis, Docker, PostgreSQL">
                        <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.parentElement.remove()">✕</button>
                    </div>
                </div>
            </div>

            <!-- External Links -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">External Links</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1rem;">
                    <label class="adm-label" for="live_url">Live Deployment URL</label>
                    <input type="url" id="live_url" name="live_url" class="adm-input" value="{{ old('live_url') }}" placeholder="https://example.com">
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="github_url">GitHub Repository URL</label>
                    <input type="url" id="github_url" name="github_url" class="adm-input" value="{{ old('github_url') }}" placeholder="https://github.com/...">
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function addFeatureRow() {
    const container = document.getElementById('featuresContainer');
    const div = document.createElement('div');
    div.className = 'adm-repeater-item';
    div.innerHTML = `
        <div style="flex: 1; display: flex; flex-direction: column; gap: 0.5rem;">
            <input type="text" name="features_titles[]" class="adm-input" placeholder="Feature title...">
            <textarea name="features_descriptions[]" class="adm-textarea" style="min-height: 60px;" placeholder="Feature description..."></textarea>
        </div>
        <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
    `;
    container.appendChild(div);
}

function addMetricRow() {
    const container = document.getElementById('metricsContainer');
    const div = document.createElement('div');
    div.className = 'adm-repeater-item';
    div.innerHTML = `
        <input type="text" name="metrics_labels[]" class="adm-input" style="flex: 1;" placeholder="Label (e.g. Throughput)">
        <input type="text" name="metrics_values[]" class="adm-input" style="flex: 1;" placeholder="Value (e.g. 10k/min)">
        <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
    `;
    container.appendChild(div);
}

function addTechTag() {
    const container = document.getElementById('techContainer');
    const div = document.createElement('div');
    div.style.cssText = 'display: flex; gap: 0.5rem;';
    div.innerHTML = `
        <input type="text" name="technologies[]" class="adm-input" placeholder="Technology name...">
        <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.parentElement.remove()">✕</button>
    `;
    container.appendChild(div);
}
</script>
@endpush
@endsection
