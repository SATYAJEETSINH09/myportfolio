@extends('admin.layouts.app')

@section('title', 'Inbound Messages & Leads')
@section('page-title', 'Inbound Messages & Leads')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap;">
    <form method="GET" action="{{ route('admin.messages.index') }}" style="display: flex; gap: 0.75rem; flex: 1; max-width: 600px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search sender, email, project..." class="adm-input" style="max-width: 300px;">
        <select name="status" class="adm-select" style="max-width: 150px;" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread ({{ $unreadCount }})</option>
            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
        </select>
        <button type="submit" class="adm-btn adm-btn-secondary">Filter</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.messages.index') }}" class="adm-btn adm-btn-secondary">Clear</a>
        @endif
    </form>
</div>

<div class="adm-table-wrap">
    <table class="adm-table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Sender</th>
                <th>Email</th>
                <th>Project Type</th>
                <th>Budget</th>
                <th>Message Preview</th>
                <th>Received</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
                <tr style="{{ $msg->status === 'unread' ? 'background: rgba(99, 102, 241, 0.04);' : '' }}">
                    <td>
                        @if($msg->status === 'unread')
                            <span class="adm-badge rose">Unread</span>
                        @else
                            <span class="adm-badge gray">Read</span>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 700; font-size: 0.92rem;">{{ $msg->name }}</div>
                    </td>
                    <td style="font-family: var(--adm-font-mono); font-size: 0.82rem;">
                        <a href="mailto:{{ $msg->email }}" style="color: #818cf8; text-decoration: none;">{{ $msg->email }}</a>
                    </td>
                    <td>
                        <span class="adm-badge indigo">{{ $msg->project_type }}</span>
                    </td>
                    <td style="font-size: 0.82rem; color: var(--adm-text-muted);">
                        {{ $msg->budget ?? '—' }}
                    </td>
                    <td style="font-size: 0.82rem; color: var(--adm-text-muted); max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $msg->message }}
                    </td>
                    <td style="font-size: 0.78rem; color: var(--adm-text-dim); font-family: var(--adm-font-mono);">
                        {{ $msg->created_at->diffForHumans() }}
                    </td>
                    <td style="text-align: right;">
                        <div style="display: inline-flex; gap: 0.5rem;">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="adm-btn adm-btn-secondary adm-btn-sm">View</a>
                            <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete message?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2.5rem; color: var(--adm-text-dim);">
                        No contact messages found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $messages->links() }}
</div>
@endsection
