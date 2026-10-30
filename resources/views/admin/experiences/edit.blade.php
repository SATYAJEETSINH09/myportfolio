@extends('admin.layouts.app')

@section('title', 'Edit Experience - ' . $experience->position)
@section('page-title', 'Edit Career Milestone')

@section('content')
<form action="{{ route('admin.experiences.update', $experience) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('admin.experiences.index') }}" class="adm-btn adm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Timeline</span>
        </a>
        <button type="submit" class="adm-btn adm-btn-primary">
            <span>Save Milestone Changes</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>

    <div class="adm-form-grid">
        <div class="adm-col-8" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Role Information</h2>
                </div>

                <div class="adm-form-grid">
                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="position">Job Position / Title <span class="required">*</span></label>
                        <input type="text" id="position" name="position" class="adm-input" value="{{ old('position', $experience->position) }}" required>
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="company">Company / Organization <span class="required">*</span></label>
                        <input type="text" id="company" name="company" class="adm-input" value="{{ old('company', $experience->company) }}" required>
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="period">Display Period <span class="required">*</span></label>
                        <input type="text" id="period" name="period" class="adm-input" value="{{ old('period', $experience->period) }}" required>
                    </div>

                    <div class="adm-col-6 adm-form-group">
                        <label class="adm-label" for="location">Location</label>
                        <input type="text" id="location" name="location" class="adm-input" value="{{ old('location', $experience->location) }}">
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="stack">Core Technologies Used</label>
                        <input type="text" id="stack" name="stack" class="adm-input" value="{{ old('stack', $experience->stack) }}">
                    </div>

                    <div class="adm-col-12 adm-form-group">
                        <label class="adm-label" for="description">Summary Overview</label>
                        <textarea id="description" name="description" class="adm-textarea" style="min-height: 80px;">{{ old('description', $experience->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Bullet Points Achievements -->
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Key Responsibilities & Achievements</h2>
                    <button type="button" class="adm-btn adm-btn-secondary adm-btn-sm" onclick="addPointRow()">+ Add Bullet Point</button>
                </div>

                <div id="pointsContainer" class="adm-repeater-box">
                    @forelse($experience->points as $point)
                        <div class="adm-repeater-item">
                            <input type="text" name="points[]" class="adm-input" style="flex: 1;" value="{{ $point->text }}">
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                        </div>
                    @empty
                        <div class="adm-repeater-item">
                            <input type="text" name="points[]" class="adm-input" style="flex: 1;" placeholder="Bullet point achievement...">
                            <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="adm-col-4" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Settings</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="sort_order">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="adm-input" value="{{ old('sort_order', $experience->sort_order) }}">
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-switch-wrap">
                        <div class="adm-switch">
                            <input type="checkbox" name="is_current" value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
                            <span class="adm-slider"></span>
                        </div>
                        <div>
                            <div style="font-weight: 600; font-size: 0.88rem;">Current Active Role</div>
                            <div style="font-size: 0.72rem; color: var(--adm-text-dim);">Currently working here</div>
                        </div>
                    </label>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1rem;">
                    <label class="adm-label" for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="adm-input" value="{{ old('start_date', $experience->start_date ? \Carbon\Carbon::parse($experience->start_date)->format('Y-m-d') : '') }}">
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="adm-input" value="{{ old('end_date', $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y-m-d') : '') }}">
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function addPointRow() {
    const container = document.getElementById('pointsContainer');
    const div = document.createElement('div');
    div.className = 'adm-repeater-item';
    div.innerHTML = `
        <input type="text" name="points[]" class="adm-input" style="flex: 1;" placeholder="Bullet point achievement...">
        <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" onclick="this.closest('.adm-repeater-item').remove()">✕</button>
    `;
    container.appendChild(div);
}
</script>
@endpush
@endsection
