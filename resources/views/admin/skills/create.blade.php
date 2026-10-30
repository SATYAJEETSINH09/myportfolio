@extends('admin.layouts.app')

@section('title', 'Add Technical Skill')
@section('page-title', 'Add Skill')

@section('content')
<form action="{{ route('admin.skills.store') }}" method="POST">
    @csrf

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('admin.skills.index') }}" class="adm-btn adm-btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Skills</span>
        </a>
        <button type="submit" class="adm-btn adm-btn-primary">
            <span>Save Skill</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>

    <div class="adm-card" style="max-width: 700px;">
        <div class="adm-card-header">
            <h2 class="adm-card-title">Skill Information</h2>
        </div>

        <div class="adm-form-grid">
            <div class="adm-col-6 adm-form-group">
                <label class="adm-label" for="category">Category <span class="required">*</span></label>
                <input type="text" id="category" name="category" list="catList" class="adm-input" value="{{ old('category', 'Backend Architecture') }}" required placeholder="e.g. Backend, Databases, Cloud">
                <datalist id="catList">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">
                    @endforeach
                </datalist>
            </div>

            <div class="adm-col-6 adm-form-group">
                <label class="adm-label" for="name">Skill / Tool Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="adm-input" value="{{ old('name') }}" required placeholder="e.g. Laravel 11 / 12">
            </div>

            <div class="adm-col-6 adm-form-group">
                <label class="adm-label" for="badge">Proficiency Badge / Tag</label>
                <input type="text" id="badge" name="badge" class="adm-input" value="{{ old('badge') }}" placeholder="e.g. Core Specialist, Expert, Advanced">
            </div>

            <div class="adm-col-6 adm-form-group">
                <label class="adm-label" for="sort_order">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" class="adm-input" value="{{ old('sort_order', 0) }}">
            </div>

            <div class="adm-col-12 adm-form-group">
                <label class="adm-label" for="description">Short Description / Key Capabilities</label>
                <textarea id="description" name="description" class="adm-textarea" style="min-height: 80px;" placeholder="e.g. Eloquent ORM, Queues & Workers, RESTful API design, Service Layer architecture">{{ old('description') }}</textarea>
            </div>
        </div>
    </div>
</form>
@endsection
