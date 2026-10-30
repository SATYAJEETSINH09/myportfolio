@extends('admin.layouts.app')

@section('title', 'Services Offered')
@section('page-title', 'Services Offered')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <p style="color: var(--adm-text-muted); font-size: 0.88rem;">Manage client services, architectural consulting packages, and engineering offerings.</p>
    <a href="{{ route('admin.services.create') }}" class="adm-btn adm-btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        <span>Add Service</span>
    </a>
</div>

<div class="adm-table-wrap">
    <table class="adm-table">
        <thead>
            <tr>
                <th style="width: 80px;">Number</th>
                <th>Service Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Order</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $svc)
                <tr>
                    <td style="font-family: var(--adm-font-mono); font-weight: 700; color: var(--adm-primary);">
                        {{ $svc->number }}
                    </td>
                    <td>
                        <div style="font-weight: 700; font-size: 0.95rem;">{{ $svc->title }}</div>
                    </td>
                    <td style="font-size: 0.82rem; color: var(--adm-text-muted); max-width: 400px;">
                        {{ Str::limit($svc->description, 100) }}
                    </td>
                    <td>
                        @if($svc->is_active)
                            <span class="adm-badge emerald">Active</span>
                        @else
                            <span class="adm-badge gray">Inactive</span>
                        @endif
                    </td>
                    <td style="font-family: var(--adm-font-mono); font-size: 0.82rem;">
                        {{ $svc->sort_order }}
                    </td>
                    <td style="text-align: right;">
                        <div style="display: inline-flex; gap: 0.5rem;">
                            <a href="{{ route('admin.services.edit', $svc) }}" class="adm-btn adm-btn-secondary adm-btn-sm">Edit</a>
                            <form action="{{ route('admin.services.destroy', $svc) }}" method="POST" onsubmit="return confirm('Delete this service?');" style="display:inline;">
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
                        No services added yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
