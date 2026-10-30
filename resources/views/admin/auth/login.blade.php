<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In | Portfolio Studio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">
    <div class="adm-login-wrap">
        <div class="adm-login-card">
            <div class="adm-login-header">
                <div class="adm-brand-badge" style="margin: 0 auto 1rem; width: 48px; height: 48px; font-size: 1.25rem;">SD</div>
                <h1 style="font-size: 1.4rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 0.35rem;">Admin Engine</h1>
                <p style="color: var(--adm-text-muted); font-size: 0.85rem;">Sign in to manage your portfolio, case studies & inquiries</p>
            </div>

            @if(session('info'))
                <div class="adm-alert adm-alert-info" style="font-size:0.8rem; margin-bottom: 1.25rem;">
                    {{ session('info') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="adm-alert adm-alert-error" style="font-size:0.8rem; margin-bottom: 1.25rem;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="adm-input" value="{{ old('email', 'admin@satyajeet.dev') }}" required autofocus placeholder="admin@example.com">
                </div>

                <div class="adm-form-group" style="margin-bottom: 1.25rem;">
                    <label class="adm-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="adm-input" required placeholder="••••••••">
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                    <label class="adm-switch-wrap" style="font-size: 0.82rem; color: var(--adm-text-muted);">
                        <input type="checkbox" name="remember" value="1" style="accent-color: var(--adm-primary);">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="adm-btn adm-btn-primary" style="width: 100%; padding: 0.75rem;">
                    <span>Authenticate & Access Studio</span>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <div style="margin-top: 1.75rem; text-align: center; font-size: 0.78rem; color: var(--adm-text-dim);">
                Default Seeded Login: <span style="font-family: var(--adm-font-mono); color: var(--adm-text-muted);">admin@satyajeet.dev / admin123</span>
            </div>
        </div>
    </div>
</body>
</html>
