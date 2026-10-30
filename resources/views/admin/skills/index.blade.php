@extends('admin.layouts.app')

@section('title', 'Technical Skills & Badges')
@section('page-title', 'Technical Skills & Badges')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="color: var(--adm-text-muted); font-size: 0.88rem;">Manage technical competencies, stack categories (Backend, Architecture, Cloud), and proficiency badges.</p>
    <a href="{{ route('admin.skills.create') }}" class="adm-btn adm-btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        <span>Add New Skill</span>
    </a>
</div>

@forelse($skillsByCategory as $category => $skills)
    <div class="adm-card" style="margin-bottom: 1.5rem;">
        <div class="adm-card-header">
            <h2 class="adm-card-title">{{ $category }} <span style="font-size: 0.78rem; font-weight: 400; color: var(--adm-text-dim);">({{ $skills->count() }} skills)</span></h2>
        </div>

        <div class="adm-table-wrap" style="border: none;">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Skill Name</th>
                        <th>Badge / Level</th>
                        <th>Description / Capabilities</th>
                        <th>Order</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                        <tr>
                            <td>
                                <div style="font-weight: 700; font-size: 0.92rem;">{{ $skill->name }}</div>
                            </td>
                            <td>
                                @if($skill->badge)
                                    <span class="adm-badge indigo">{{ $skill->badge }}</span>
                                @else
                                    <span class="adm-badge gray">Standard</span>
                                @endif
                            </td>
                            <td style="font-size: 0.82rem; color: var(--adm-text-muted); max-width: 320px;">
                                {{ $skill->description ?? '—' }}
                            </td>
                            <td style="font-family: var(--adm-font-mono); font-size: 0.82rem;">
                                {{ $skill->sort_order }}
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="adm-btn adm-btn-secondary adm-btn-sm">Edit</a>
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete skill?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@empty
    <div class="adm-card" style="text-align: center; padding: 3rem; color: var(--adm-text-dim);">
        No skills added yet. Click "Add New Skill" to get started.
    </div>
@endforelse
@endsection
