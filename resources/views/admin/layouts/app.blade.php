<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | Portfolio Studio</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">
    <div class="adm-layout">
        <!-- Sidebar -->
        <aside class="adm-sidebar" id="admSidebar">
            <a href="{{ route('admin.dashboard') }}" class="adm-brand">
                <div class="adm-brand-badge">SD</div>
                <div>
                    <div class="adm-brand-title">Portfolio Studio</div>
                    <div class="adm-brand-sub">Admin Engine</div>
                </div>
            </a>

            <nav class="adm-nav">
                <div class="adm-nav-heading">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="adm-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard</span>
                </a>

                <div class="adm-nav-heading">Content Management</div>
                <a href="{{ route('admin.projects.index') }}" class="adm-nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span>Projects</span>
                </a>

                <a href="{{ route('admin.posts.index') }}" class="adm-nav-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <span>Blog Articles</span>
                </a>

                <a href="{{ route('admin.experiences.index') }}" class="adm-nav-item {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>Experience</span>
                </a>

                <a href="{{ route('admin.skills.index') }}" class="adm-nav-item {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    <span>Tech Skills</span>
                </a>

                <a href="{{ route('admin.services.index') }}" class="adm-nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span>Services</span>
                </a>

                <div class="adm-nav-heading">Communication</div>
                @php
                    $unreadInbox = \App\Models\ContactMessage::where('status', 'unread')->count();
                @endphp
                <a href="{{ route('admin.messages.index') }}" class="adm-nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>Inquiries</span>
                    @if($unreadInbox > 0)
                        <span class="adm-nav-badge">{{ $unreadInbox }}</span>
                    @endif
                </a>

                <div class="adm-nav-heading">System & Settings</div>
                <a href="{{ route('admin.settings.index') }}" class="adm-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>Site Settings</span>
                </a>

                <a href="{{ route('admin.profile.index') }}" class="adm-nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>My Profile</span>
                </a>
            </nav>

            <div class="adm-sidebar-footer">
                <div class="adm-user-info">
                    <div class="adm-user-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                    <div>
                        <div class="adm-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="adm-user-role">Super Admin</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="adm-main">
            <!-- Header -->
            <header class="adm-header">
                <div class="adm-header-left">
                    <button class="adm-mobile-toggle" id="mobileMenuBtn" aria-label="Toggle Menu">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h1 class="adm-page-title">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="adm-header-right">
                    <a href="{{ route('portfolio.home') }}" target="_blank" class="adm-btn adm-btn-secondary adm-btn-sm">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        <span>View Live Site</span>
                    </a>

                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm" title="Log Out">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Body -->
            <main class="adm-content">
                @if(session('success'))
                    <div class="adm-alert adm-alert-success">
                        <span>{{ session('success') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;cursor:pointer;">✕</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="adm-alert adm-alert-error">
                        <span>{{ session('error') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;cursor:pointer;">✕</button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="adm-alert adm-alert-info">
                        <span>{{ session('info') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;cursor:pointer;">✕</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="adm-alert adm-alert-error" style="display:block;">
                        <div style="font-weight:700;margin-bottom:0.35rem;">Please correct the following errors:</div>
                        <ul style="padding-left:1.25rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Admin Scripts -->
    <script>
        // Mobile Sidebar Toggle
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('admSidebar');
        if (mobileBtn && sidebar) {
            mobileBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
