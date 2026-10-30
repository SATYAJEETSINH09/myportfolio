@extends('admin.layouts.app')

@section('title', 'Overview Dashboard')
@section('page-title', 'Overview Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="adm-stats-grid">
    <div class="adm-stat-card">
        <span class="adm-stat-label">Total Projects</span>
        <div class="adm-stat-val">{{ $stats['projects_count'] }}</div>
        <div class="adm-stat-sub">{{ $stats['featured_projects_count'] }} featured showcase</div>
    </div>

    <div class="adm-stat-card emerald">
        <span class="adm-stat-label">Articles Published</span>
        <div class="adm-stat-val">{{ $stats['published_posts_count'] }}</div>
        <div class="adm-stat-sub">{{ $stats['posts_count'] }} total drafted & live</div>
    </div>

    <div class="adm-stat-card amber">
        <span class="adm-stat-label">Inbound Inquiries</span>
        <div class="adm-stat-val">{{ $stats['messages_count'] }}</div>
        <div class="adm-stat-sub">{{ $stats['unread_messages_count'] }} unread new leads</div>
    </div>

    <div class="adm-stat-card sky">
        <span class="adm-stat-label">Skills & Tech</span>
        <div class="adm-stat-val">{{ $stats['skills_count'] }}</div>
        <div class="adm-stat-sub">{{ $stats['experiences_count'] }} career milestones</div>
    </div>
</div>

<!-- Two Column Section -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Recent Messages / Inquiries -->
    <div class="adm-card">
        <div class="adm-card-header">
            <h2 class="adm-card-title">Recent Inquiries & Leads</h2>
            <a href="{{ route('admin.messages.index') }}" class="adm-btn adm-btn-secondary adm-btn-sm">View All</a>
        </div>

        @if($recentMessages->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($recentMessages as $msg)
                    <div style="padding: 0.85rem; background: #0d1117; border: 1px solid var(--adm-border); border-radius: var(--adm-radius-sm); display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <div style="font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                                {{ $msg->name }}
                                @if($msg->status === 'unread')
                                    <span class="adm-badge rose">New</span>
                                @endif
                            </div>
                            <div style="font-size: 0.78rem; color: var(--adm-text-dim); margin-top: 0.15rem;">
                                {{ $msg->email }} · <span style="color: var(--adm-primary);">{{ $msg->project_type }}</span>
                            </div>
                            <div style="font-size: 0.82rem; color: var(--adm-text-muted); margin-top: 0.35rem; line-height: 1.3;">
                                {{ Str::limit($msg->message, 80) }}
                            </div>
                        </div>
                        <a href="{{ route('admin.messages.show', $msg) }}" class="adm-btn adm-btn-secondary adm-btn-sm" style="flex-shrink: 0;">Open</a>
                    </div>
                @endforeach
            </div>
        @else
            <div style="padding: 2rem; text-align: center; color: var(--adm-text-dim);">
                No inquiries received yet.
            </div>
        @endif
    </div>

    <!-- Quick Action / Projects -->
    <div class="adm-card">
        <div class="adm-card-header">
            <h2 class="adm-card-title">Active Projects</h2>
            <a href="{{ route('admin.projects.create') }}" class="adm-btn adm-btn-primary adm-btn-sm">+ New Project</a>
        </div>

        @if($recentProjects->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($recentProjects as $proj)
                    <div style="padding: 0.85rem; background: #0d1117; border: 1px solid var(--adm-border); border-radius: var(--adm-radius-sm); display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                                {{ $proj->title }}
                                @if($proj->featured)
                                    <span class="adm-badge emerald">Featured</span>
                                @endif
                            </div>
                            <div style="font-size: 0.78rem; color: var(--adm-text-dim);">
                                {{ $proj->category }} · {{ $proj->year ?? 'Current' }}
                            </div>
                        </div>
                        <a href="{{ route('admin.projects.edit', $proj) }}" class="adm-btn adm-btn-secondary adm-btn-sm">Edit</a>
                    </div>
                @endforeach
            </div>
        @else
            <div style="padding: 2rem; text-align: center; color: var(--adm-text-dim);">
                No projects added yet.
            </div>
        @endif
    </div>
</div>
@endsection
