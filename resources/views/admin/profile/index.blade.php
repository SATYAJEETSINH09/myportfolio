@extends('admin.layouts.app')

@section('title', 'Admin Account & Security')
@section('page-title', 'Admin Profile & Security')

@section('content')
<form action="{{ route('admin.profile.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <p style="color: var(--adm-text-muted); font-size: 0.88rem;">Update your administrator account name, login email address, and security password.</p>
        <button type="submit" class="adm-btn adm-btn-primary">
            <span>Save Profile</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>

    <div class="adm-form-grid">
        <!-- Account Info -->
        <div class="adm-col-6">
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Account Credentials</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="name">Full Name <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="adm-input" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="email">Admin Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" class="adm-input" value="{{ old('email', $user->email) }}" required>
                </div>
            </div>
        </div>

        <!-- Security Password -->
        <div class="adm-col-6">
            <div class="adm-card">
                <div class="adm-card-header">
                    <h2 class="adm-card-title">Change Password</h2>
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="adm-input" placeholder="Enter only if changing password">
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="adm-input" placeholder="Minimum 8 characters">
                </div>

                <div class="adm-form-group">
                    <label class="adm-label" for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="adm-input" placeholder="Repeat new password">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
