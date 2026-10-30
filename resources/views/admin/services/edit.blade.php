@extends('admin.layouts.app')

@section('title', 'Edit Service - ' . $service->title)
@section('page-title', 'Edit Service')

@section('content')
<form action="{{ route('admin.services.update', $service) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('admin.services.index') }}" class="adm-btn adm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Services</span>
        </a>
        <button type="submit" class="adm-btn adm-btn-primary">
            <span>Save Service Changes</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>

    <div class="adm-card" style="max-width: 700px;">
        <div class="adm-card-header">
            <h2 class="adm-card-title">Service Details</h2>
        </div>

        <div class="adm-form-grid">
            <div class="adm-col-4 adm-form-group">
                <label class="adm-label" for="number">Number <span class="required">*</span></label>
                <input type="text" id="number" name="number" class="adm-input" value="{{ old('number', $service->number) }}" required>
            </div>

            <div class="adm-col-8 adm-form-group">
                <label class="adm-label" for="title">Service Title <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="adm-input" value="{{ old('title', $service->title) }}" required>
            </div>

            <div class="adm-col-12 adm-form-group">
                <label class="adm-label" for="description">Detailed Description <span class="required">*</span></label>
                <textarea id="description" name="description" class="adm-textarea" style="min-height: 120px;" required>{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="adm-col-6 adm-form-group">
                <label class="adm-label" for="sort_order">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" class="adm-input" value="{{ old('sort_order', $service->sort_order) }}">
            </div>

            <div class="adm-col-6 adm-form-group" style="justify-content: flex-end;">
                <label class="adm-switch-wrap">
                    <div class="adm-switch">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                        <span class="adm-slider"></span>
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 0.88rem;">Active on Site</div>
                    </div>
                </label>
            </div>
        </div>
    </div>
</form>
@endsection
