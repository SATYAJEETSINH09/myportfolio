@extends('admin.layouts.app')

@section('title', 'Projects Showcase')
@section('page-title', 'Projects Showcase')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap;">
    <!-- Filters & Search -->
    <form method="GET" action="{{ route('admin.projects.index') }}" style="display: flex; gap: 0.75rem; flex: 1; max-width: 600px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title, category, role..." class="adm-input" style="max-width: 300px;">
        <select name="category" class="adm-select" style="max-width: 180px;" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <button type="submit" class="adm-btn adm-btn-secondary">Filter</button>
        @if(request('search') || request('category'))
            <a href="{{ route('admin.projects.index') }}" class="adm-btn adm-btn-secondary">Clear</a>
        @endif
    </form>

    <a href="{{ route('admin.projects.create') }}" class="adm-btn adm-btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        <span>Add New Project</span>
    </a>
</div>

<div class="adm-table-wrap">
    <table class="adm-table">
        <thead>
            <tr>
                <th style="width: 70px;">Cover</th>
                <th>Project Details</th>
                <th>Category</th>
                <th>Technologies</th>
                <th>Featured</th>
                <th>Status</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $proj)
                <tr>
                    <td>
                        @if($proj->cover_image)
                            <img src="{{ Str::startsWith($proj->cover_image, 'http') ? $proj->cover_image : (Str::startsWith($proj->cover_image, 'projects/') ? asset('storage/' . $proj->cover_image) : asset($proj->cover_image)) }}" alt="{{ $proj->title }}" style="width: 50px; height: 38px; object-fit: cover; border-radius: var(--adm-radius-sm); border: 1px solid var(--adm-border);">
                        @else
                            <div style="width: 50px; height: 38px; background: #1e293b; border-radius: var(--adm-radius-sm); display: flex; align-items: center; justify-content: center; font-size: 0.65rem; color: var(--adm-text-dim);">No Img</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 700; font-size: 0.92rem;">{{ $proj->title }}</div>
                        <div style="font-size: 0.76rem; color: var(--adm-text-dim);">
                            {{ $proj->tagline ?? $proj->role }}
                        </div>
                    </td>
                    <td>
                        <span class="adm-badge gray">{{ $proj->category }}</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.25rem; flex-wrap: wrap; max-width: 240px;">
                            @foreach($proj->technologies->take(3) as $tech)
                                <span class="adm-badge indigo" style="font-size: 0.68rem; padding: 0.1rem 0.4rem;">{{ $tech->name }}</span>
                            @endforeach
                            @if($proj->technologies->count() > 3)
                                <span class="adm-badge gray" style="font-size: 0.68rem;">+{{ $proj->technologies->count() - 3 }}</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($proj->featured)
                            <span class="adm-badge emerald">Featured</span>
                        @else
                            <span class="adm-badge gray">Standard</span>
                        @endif
                    </td>
                    <td>
                        @if($proj->status === 'completed')
                            <span class="adm-badge emerald">Completed</span>
                        @elseif($proj->status === 'in_progress')
                            <span class="adm-badge amber">In Progress</span>
                        @else
                            <span class="adm-badge gray">{{ ucfirst($proj->status) }}</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <div style="display: inline-flex; gap: 0.5rem;">
                            <a href="{{ route('projects.show', $proj->slug) }}" target="_blank" class="adm-btn adm-btn-secondary adm-btn-sm" title="Preview Live">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('admin.projects.edit', $proj) }}" class="adm-btn adm-btn-secondary adm-btn-sm">Edit</a>
                            <form action="{{ route('admin.projects.destroy', $proj) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2.5rem; color: var(--adm-text-dim);">
                        No projects found matching your search.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $projects->links() }}
</div>
@endsection
