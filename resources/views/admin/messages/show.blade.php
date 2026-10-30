@extends('admin.layouts.app')

@section('title', 'Message from ' . $message->name)
@section('page-title', 'Inquiry Details')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <a href="{{ route('admin.messages.index') }}" class="adm-btn adm-btn-secondary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        <span>Back to Inquiries</span>
    </a>
    <div style="display: flex; gap: 0.75rem;">
        <a href="mailto:{{ $message->email }}?subject={{ urlencode('Re: ' . $message->project_type . ' Inquiry') }}" class="adm-btn adm-btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span>Reply via Email</span>
        </a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="adm-btn adm-btn-danger">Delete</button>
        </form>
    </div>
</div>

<div class="adm-form-grid">
    <div class="adm-col-8">
        <div class="adm-card">
            <div class="adm-card-header">
                <h2 class="adm-card-title">Message Body</h2>
                <span class="adm-badge gray" style="font-family: var(--adm-font-mono);">Received: {{ $message->created_at->format('M d, Y · H:i A') }}</span>
            </div>

            <div style="font-size: 0.95rem; line-height: 1.7; color: var(--adm-text-main); white-space: pre-wrap; background: #0d1117; border: 1px solid var(--adm-border); border-radius: var(--adm-radius-sm); padding: 1.5rem;">
{{ $message->message }}
            </div>
        </div>
    </div>

    <div class="adm-col-4">
        <div class="adm-card">
            <div class="adm-card-header">
                <h2 class="adm-card-title">Sender Information</h2>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div>
                    <div class="adm-label">Client Name</div>
                    <div style="font-weight: 700; font-size: 1.05rem; margin-top: 0.2rem;">{{ $message->name }}</div>
                </div>

                <div>
                    <div class="adm-label">Email Address</div>
                    <div style="margin-top: 0.2rem;">
                        <a href="mailto:{{ $message->email }}" style="color: #818cf8; text-decoration: none; font-family: var(--adm-font-mono); font-size: 0.9rem;">{{ $message->email }}</a>
                    </div>
                </div>

                <div>
                    <div class="adm-label">Project Scope / Type</div>
                    <div style="margin-top: 0.35rem;">
                        <span class="adm-badge indigo">{{ $message->project_type }}</span>
                    </div>
                </div>

                <div>
                    <div class="adm-label">Estimated Budget</div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: var(--adm-emerald); margin-top: 0.2rem;">
                        {{ $message->budget ?? 'Not Specified' }}
                    </div>
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid var(--adm-border);">
                    <form action="{{ route('admin.messages.toggle', $message) }}" method="POST">
                        @csrf
                        <button type="submit" class="adm-btn adm-btn-secondary" style="width: 100%;">
                            Mark as {{ $message->status === 'unread' ? 'Read' : 'Unread' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
