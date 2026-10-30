@extends('admin.layouts.app')

@section('title', 'Work Experience & History')
@section('page-title', 'Work Experience & History')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="color: var(--adm-text-muted); font-size: 0.88rem;">Manage your career timeline, achievements, and technology stack highlights.</p>
    <a href="{{ route('admin.experiences.create') }}" class="adm-btn adm-btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        <span>Add Experience</span>
    </a>
</div>

<div class="adm-table-wrap">
    <table class="adm-table">
        <thead>
            <tr>
                <th>Company & Position</th>
                <th>Period</th>
                <th>Tech Stack</th>
                <th>Key Points</th>
                <th>Current</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($experiences as $exp)
                <tr>
                    <td>
                        <div style="font-weight: 700; font-size: 0.95rem;">{{ $exp->position }}</div>
                        <div style="font-size: 0.8rem; color: var(--adm-primary); font-weight: 600;">{{ $exp->company }}</div>
                        @if($exp->location)
                            <div style="font-size: 0.72rem; color: var(--adm-text-dim);">{{ $exp->location }}</div>
                        @endif
                    </td>
                    <td style="font-size: 0.82rem; font-family: var(--adm-font-mono);">
                        {{ $exp->period }}
                    </td>
                    <td>
                        <div style="font-size: 0.82rem; color: var(--adm-text-muted); max-width: 200px;">
                            {{ $exp->stack ?? '—' }}
                        </div>
                    </td>
                    <td>
                        <span class="adm-badge indigo">{{ $exp->points->count() }} achievements</span>
                    </td>
                    <td>
                        @if($exp->is_current)
                            <span class="adm-badge emerald">Present Role</span>
                        @else
                            <span class="adm-badge gray">Past</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <div style="display: inline-flex; gap: 0.5rem;">
                            <a href="{{ route('admin.experiences.edit', $exp) }}" class="adm-btn adm-btn-secondary adm-btn-sm">Edit</a>
                            <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Delete this experience entry?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2.5rem; color: var(--adm-text-dim);">
                        No experience milestones added yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
