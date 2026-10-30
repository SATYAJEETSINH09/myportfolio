@extends('admin.layouts.app')

@section('title', 'Edit Project - ' . $project->title)
@section('page-title', 'Edit Project')

@section('content')
<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('admin.projects.index') }}" class="adm-btn adm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Projects</span>
        </a>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="adm-btn adm-btn-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                <span>View Live</span>
            </a>
            <button type="submit" class="adm-btn adm-btn-primary">
                <span>Save Changes</span>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </button>
        </div>
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
                        <input type="text" id="title" name="title" class="adm-input" value="{{ old('title', $project->title) }}" required>
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="slug">URL Slug <span class="required">*</span></label>
                        <input type="text" id="slug" name="slug" class="adm-input" value="{{ old('slug', $project->slug) }}" required>
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="project_number">Project Number</label>
                        <input type="text" id="project_number" name="project_number" class="adm-input" value="{{ old('project_number', $project->project_number) }}">
                    </div>

                    <div class="adm-col-8 adm-form-group">
                        <label class="adm-label" for="tagline">Tagline / Subheading</label>
                        <input type="text" id="tagline" name="tagline" class="adm-input" value="{{ old('tagline', $project->tagline) }}">
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="category">Category <span class="required">*</span></label>
                        <input type="text" id="category" name="category" class="adm-input" value="{{ old('category', $project->category) }}" required>
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="project_type">Project Type</label>
                        <input type="text" id="project_type" name="project_type" class="adm-input" value="{{ old('project_type', $project->project_type) }}">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="role">My Role</label>
                        <input type="text" id="role" name="role" class="adm-input" value="{{ old('role', $project->role) }}">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="client">Client / Company</label>
                        <input type="text" id="client" name="client" class="adm-input" value="{{ old('client', $project->client) }}">
                    </div>

                    <div class="adm-col-4 adm-form-group">
                        <label class="adm-label" for="year">Year / Duration</label>
                        <input type="text" id="year" name="year" class="adm-input" value="{{ old('year', $project->year) }}">
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="short_description">Short Summary</label>
                        <textarea id="short_description" name="short_description" class="adm-textarea" style="min-height: 70px;">{{ old('short_description', $project->short_description) }}</textarea>
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="description">Detailed Description & Architecture</label>
                        <textarea id="description" name="description" class="adm-textarea" style="min-height: 140px;">{{ old('description', $project->description) }}</textarea>
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
                        <textarea id="challenge" name="challenge" class="adm-textarea" style="min-height: 90px;">{{ old('challenge', $project->challenge) }}</textarea>
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="solution">Engineered Solution</label>
                        <textarea id="solution" name="solution" class="adm-textarea" style="min-height: 90px;">{{ old('solution', $project->solution) }}</textarea>
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
                    @forelse($project->features as $feature)
                        <div class="adm-repeater-item">
                            <div style="flex: 1; display: flex; flex-direction: column; gap: 0.5rem;">
                                <input type="text" name="features_titles[]" class="adm-input" value="{{ $feature->title }}" placeholder="Feature title...">
                                <textarea name="features_descriptions[]" class="adm-textarea" style="min-height: 60px;" placeholder="Feature description...">{{ $feature->description }}</textarea>
                            </div>
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                        </div>
                    @empty
                        <div class="adm-repeater-item">
                            <div style="flex: 1; display: flex; flex-direction: column; gap: 0.5rem;">
                                <input type="text" name="features_titles[]" class="adm-input" placeholder="Feature title...">
                                <textarea name="features_descriptions[]" class="adm-textarea" style="min-height: 60px;" placeholder="Feature description..."></textarea>
                            </div>
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Metrics -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Performance Metrics / Impact Numbers</h2>
                    <button type="button" class="adm-btn adm-btn-secondary adm-btn-sm" onclick="addMetricRow()">+ Add Metric</button>
                </div>

                <div id="metricsContainer" class="adm-repeater-box">
                    @if(!empty($project->metrics) && is_array($project->metrics))
                        @foreach($project->metrics as $metric)
                            <div class="adm-repeater-item">
                                <input type="text" name="metrics_labels[]" class="adm-input" style="flex: 1;" value="{{ $metric['label'] ?? '' }}" placeholder="Label">
                                <input type="text" name="metrics_values[]" class="adm-input" style="flex: 1;" value="{{ $metric['val'] ?? '' }}" placeholder="Value">
                                <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                            </div>
                        @endforeach
                    @else
                        <div class="adm-repeater-item">
                            <input type="text" name="metrics_labels[]" class="adm-input" style="flex: 1;" placeholder="Label (e.g. Throughput)">
                            <input type="text" name="metrics_values[]" class="adm-input" style="flex: 1;" placeholder="Value (e.g. 10k/min)">
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                        </div>
                    @endif
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
                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed & Production</option>
                        <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="archived" {{ old('status', $project->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="sort_order">Display Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="adm-input" value="{{ old('sort_order', $project->sort_order) }}">
                </div>

                <div class="adm-form-group" style="margin-bottom: 0.5rem;">
                    <label class="adm-switch-wrap">
                        <div class="adm-switch">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                            <span class="adm-slider"></span>
                        </div>
                        <div>
                            <div style="font-weight: 600; font-size: 0.88rem;">Feature on Homepage</div>
                            <div style="font-size: 0.72rem; color: var(--adm-text-dim);">Highlighted in hero showcase</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Cover Image -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Cover Image</h2>
                </div>

                @if($project->cover_image)
                    <div style="margin-bottom: 1rem;">
                        <img src="{{ Str::startsWith($project->cover_image, 'http') ? $project->cover_image : (Str::startsWith($project->cover_image, 'projects/') ? asset('storage/' . $project->cover_image) : asset($project->cover_image)) }}" alt="{{ $project->title }}" style="width: 100%; max-height: 160px; object-fit: cover; border-radius: var(--adm-radius-sm); border: 1px solid var(--adm-border);">
                    </div>
                @endif

                <div class="adm-form-group">
                    <label class="adm-label">Change Cover File</label>
                    <input type="file" name="cover_image_file" class="adm-input" accept="image/*">
                </div>

                <div class="adm-form-group" style="margin-top: 1rem;">
                    <label class="adm-label" for="cover_image">Or Cover Image URL / Path</label>
                    <input type="text" id="cover_image" name="cover_image" class="adm-input" value="{{ old('cover_image', $project->cover_image) }}">
                </div>
            </div>

            <!-- Technologies -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Technologies Used</h2>
                    <button type="button" class="adm-btn adm-btn-secondary adm-btn-sm" onclick="addTechTag()">+ Add Tech</button>
                </div>

                <div id="techContainer" style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @forelse($project->technologies as $tech)
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" name="technologies[]" class="adm-input" value="{{ $tech->name }}">
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.parentElement.remove()">✕</button>
                        </div>
                    @empty
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" name="technologies[]" class="adm-input" placeholder="e.g. Laravel 11">
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.parentElement.remove()">✕</button>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- External Links -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">External Links</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1rem;">
                    <label class="adm-label" for="live_url">Live Deployment URL</label>
                    <input type="url" id="live_url" name="live_url" class="adm-input" value="{{ old('live_url', $project->live_url) }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="github_url">GitHub Repository URL</label>
                    <input type="url" id="github_url" name="github_url" class="adm-input" value="{{ old('github_url', $project->github_url) }}">
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
        <input type="text" name="metrics_labels[]" class="adm-input" style="flex: 1;" placeholder="Label">
        <input type="text" name="metrics_values[]" class="adm-input" style="flex: 1;" placeholder="Value">
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
