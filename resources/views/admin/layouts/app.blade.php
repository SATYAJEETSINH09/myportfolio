<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') — Portfolio Studio</title>

    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')

    <!-- Pre-render theme & sidebar scripts to avoid flash -->
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('theme') || 'light';
                const isDark = savedTheme === 'dark';
                document.documentElement.classList.toggle('dark', isDark);

                if (window.innerWidth >= 1280 && localStorage.getItem('sidebar-expanded') === 'false') {
                    document.documentElement.classList.add('sidebar-collapsed');
                }
            } catch (e) {}
        })();
    </script>

    <style>
        [x-cloak] { display: none !important; }
        @media (min-width: 1280px) {
            html.sidebar-collapsed #sidebar { width: 76px !important; }
            html.sidebar-collapsed .main-content-card { margin-left: 76px !important; }
            html.sidebar-collapsed #sidebar .menu-item-text,
            html.sidebar-collapsed #sidebar h2 span,
            html.sidebar-collapsed #sidebar h2 svg,
            html.sidebar-collapsed #sidebar .sidebar-logo-expanded { display: none !important; }
            html.sidebar-collapsed #sidebar .sidebar-logo-collapsed { display: block !important; }
            html.sidebar-collapsed #sidebar .sidebar-logo-container { justify-content: center !important; }
            html.sidebar-collapsed #sidebar .menu-item { justify-content: center !important; }
            html.sidebar-collapsed #sidebar .adm-nav-badge { display: none !important; }
        }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <!-- Theme Store & Sidebar State -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                theme: localStorage.getItem('theme') || 'light',
                init() {
                    this.updateTheme();
                },
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const isDark = this.theme === 'dark';
                    html.classList.toggle('dark', isDark);
                }
            });

            Alpine.store('sidebar', {
                isExpanded: (window.innerWidth >= 1280) ? (localStorage.getItem('sidebar-expanded') !== 'false') : false,
                isMobileOpen: false,
                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    if (window.innerWidth >= 1280) {
                        localStorage.setItem('sidebar-expanded', this.isExpanded);
                        document.documentElement.classList.toggle('sidebar-collapsed', !this.isExpanded);
                    }
                },
                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                },
                setMobileOpen(val) {
                    this.isMobileOpen = val;
                }
            });
        });
    </script>
</head>

<body class="bg-[#F8FAFC] dark:bg-[#0c1017] text-gray-900 dark:text-gray-100 font-sans antialiased overflow-hidden h-screen"
    x-data="{
        userDropdownOpen: false
    }">

    <div class="h-screen max-h-screen overflow-hidden flex flex-col xl:flex-row bg-[#F8FAFC] dark:bg-[#0c1017]">
        <!-- Mobile Backdrop -->
        <div x-cloak x-show="$store.sidebar.isMobileOpen"
            @click="$store.sidebar.setMobileOpen(false)"
            class="fixed inset-0 z-[99990] bg-gray-900/60 backdrop-blur-[2px] xl:hidden transition-opacity">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed flex flex-col mt-0 top-0 left-0 bg-[#F7F7F7] dark:bg-gray-900 text-gray-900 dark:text-gray-100 h-screen h-[100dvh] max-h-[100dvh] transition-all duration-300 ease-in-out z-[100000] border-r border-gray-200 dark:border-gray-800 xl:border-r-0 xl:bg-[#F7F7F7] dark:xl:bg-gray-900 focus:outline-none w-[250px]"
            :class="{
                '-translate-x-full xl:translate-x-0': !$store.sidebar.isMobileOpen,
                'translate-x-0 shadow-2xl': $store.sidebar.isMobileOpen,
                'xl:w-[250px]': $store.sidebar.isExpanded,
                'xl:w-[76px]': !$store.sidebar.isExpanded
            }">

            <!-- Sidebar Header / Logo -->
            <div class="h-16 flex items-center px-5 border-b border-gray-200 dark:border-gray-800 shrink-0 sidebar-logo-container">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#D96E17] to-[#fd853a] flex items-center justify-center text-white font-black text-sm shadow-sm flex-shrink-0">
                        SD
                    </div>
                    <div class="sidebar-logo-expanded">
                        <div class="font-bold text-sm text-gray-900 dark:text-white leading-tight">Portfolio Studio</div>
                        <div class="text-[10px] uppercase tracking-wider font-semibold text-gray-400 dark:text-gray-500">Admin Engine</div>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 min-h-0 flex flex-col overflow-y-auto duration-300 no-scrollbar px-3 py-4 space-y-6">
                <!-- Overview Group -->
                <div>
                    <h2 class="px-3 text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">
                        <span>Overview</span>
                    </h2>
                    <div class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.dashboard') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            <span class="menu-item-text">Dashboard</span>
                        </a>
                    </div>
                </div>

                <!-- Content Management Group -->
                <div>
                    <h2 class="px-3 text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">
                        <span>Content</span>
                    </h2>
                    <div class="space-y-1">
                        <a href="{{ route('admin.projects.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.projects.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span class="menu-item-text">Projects</span>
                        </a>

                        <a href="{{ route('admin.posts.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.posts.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            <span class="menu-item-text">Blog Articles</span>
                        </a>

                        <a href="{{ route('admin.experiences.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.experiences.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="menu-item-text">Experience</span>
                        </a>

                        <a href="{{ route('admin.skills.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.skills.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            <span class="menu-item-text">Tech Skills</span>
                        </a>

                        <a href="{{ route('admin.services.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.services.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            <span class="menu-item-text">Services</span>
                        </a>
                    </div>
                </div>

                <!-- Communication Group -->
                <div>
                    <h2 class="px-3 text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">
                        <span>Communication</span>
                    </h2>
                    @php
                        $unreadInboxCount = rescue(fn() => \App\Models\ContactMessage::where('status', 'unread')->count(), 0);
                    @endphp
                    <div class="space-y-1">
                        <a href="{{ route('admin.messages.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.messages.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="menu-item-text">Inquiries</span>
                            @if($unreadInboxCount > 0)
                                <span class="ml-auto px-2 py-0.5 rounded-full text-[11px] font-bold bg-rose-500 text-white adm-nav-badge">
                                    {{ $unreadInboxCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Settings Group -->
                <div>
                    <h2 class="px-3 text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">
                        <span>System</span>
                    </h2>
                    <div class="space-y-1">
                        <a href="{{ route('admin.settings.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.settings.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="menu-item-text">Site Settings</span>
                        </a>

                        <a href="{{ route('admin.profile.index') }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors menu-item {{ request()->routeIs('admin.profile.*') ? 'bg-[#D96E17] text-white dark:bg-[#D96E17] dark:text-white font-semibold shadow-xs' : 'text-gray-700 dark:text-gray-300 hover:bg-[#D96E17]/10 hover:text-[#D96E17] dark:hover:bg-[#D96E17]/15 dark:hover:text-[#fd853a]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="menu-item-text">My Profile</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar User Quick Info -->
            <div class="p-3 border-t border-gray-200 dark:border-gray-800 shrink-0">
                <div class="flex items-center gap-3 px-2 py-1.5">
                    <div class="w-9 h-9 rounded-full bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold flex items-center justify-center text-xs shrink-0 border border-brand-500/20">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="min-w-0 flex-1 menu-item-text">
                        <div class="text-xs font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-[11px] text-gray-400 dark:text-gray-500 truncate">Super Admin</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="main-content-card flex-1 min-w-0 min-h-0 transition-all duration-300 ease-in-out bg-white dark:bg-[#0c1017] xl:border-gray-300 dark:border-slate-800/80 xl:border xl:rounded-2xl xl:mt-2 xl:mb-2 xl:mr-2 xl:h-[calc(100dvh-1rem)] xl:max-h-[calc(100dvh-1rem)] xl:overflow-hidden xl:shadow-sm flex flex-col h-full max-h-full overflow-hidden xl:ml-[250px]"
            :class="{
                'xl:ml-[250px]': $store.sidebar.isExpanded,
                'xl:ml-[76px]': !$store.sidebar.isExpanded,
                'ml-0': $store.sidebar.isMobileOpen
            }">

            <!-- App Header -->
            <header class="sticky top-0 shrink-0 flex w-full bg-white border-gray-200 z-50 dark:border-gray-800 dark:bg-gray-900 border-b">
                <div class="flex items-center justify-between w-full px-4 py-3 xl:px-6 h-16">
                    <!-- Left: Desktop Toggle / Mobile Toggle & Title -->
                    <div class="flex items-center gap-3">
                        <!-- Desktop Collapse Toggle -->
                        <button class="hidden xl:flex items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 rounded-lg dark:border-gray-800 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition"
                            @click="$store.sidebar.toggleExpanded()" aria-label="Toggle Sidebar">
                            <svg width="18" height="14" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.583 1C0.583 0.586 0.92 0.25 1.333 0.25H14.667C15.08 0.25 15.417 0.586 15.417 1C15.417 1.414 15.08 1.75 14.667 1.75L1.333 1.75C0.92 1.75 0.583 1.414 0.583 1ZM0.583 11C0.583 10.586 0.92 10.25 1.333 10.25L14.667 10.25C15.08 10.25 15.417 10.586 15.417 11C15.417 11.414 15.08 11.75 14.667 11.75L1.333 11.75C0.92 11.75 0.583 11.414 0.583 11ZM1.333 5.25C0.92 5.25 0.583 5.586 0.583 6C0.583 6.414 0.92 6.75 1.333 6.75L7.999 6.75C8.414 6.75 8.75 6.414 8.75 6C8.75 5.586 8.414 5.25 7.999 5.25L1.333 5.25Z" fill="currentColor"/>
                            </svg>
                        </button>

                        <!-- Mobile Hamburger Toggle -->
                        <button class="flex xl:hidden items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 rounded-lg dark:border-gray-800 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                            @click="$store.sidebar.toggleMobileOpen()" aria-label="Toggle Mobile Menu">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>

                        <div class="hidden sm:block">
                            <h1 class="text-base font-semibold text-gray-900 dark:text-white leading-tight">
                                @yield('page-title', 'Portfolio Engine')
                            </h1>
                        </div>
                    </div>

                    <!-- Right Actions -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <!-- View Live Site Link -->
                        <a href="{{ route('portfolio.home') }}" target="_blank"
                           class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg transition">
                            <span>Live Site</span>
                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>

                        <!-- Dark / Light Theme Toggle -->
                        <button type="button"
                                @click="$store.theme.toggle()"
                                class="flex items-center justify-center w-10 h-10 text-gray-500 border border-gray-200 rounded-lg dark:border-gray-800 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition"
                                :title="$store.theme.theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                            <!-- Sun (shown in dark mode) -->
                            <svg x-show="$store.theme.theme === 'dark'" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <!-- Moon (shown in light mode) -->
                            <svg x-show="$store.theme.theme !== 'dark'" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>

                        <!-- User Profile Dropdown -->
                        <div class="relative" @click.away="userDropdownOpen = false">
                            <button @click="userDropdownOpen = !userDropdownOpen"
                                    type="button"
                                    class="flex items-center gap-2 text-gray-700 dark:text-gray-300 focus:outline-none p-1 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#D96E17] to-[#fd853a] text-white font-bold flex items-center justify-center text-xs">
                                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="hidden md:block text-xs font-semibold text-gray-900 dark:text-white">
                                    {{ auth()->user()->name ?? 'Admin' }}
                                </span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': userDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="userDropdownOpen"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-xl p-2 z-50"
                                 style="display: none;">
                                <div class="px-3 py-2 border-b border-gray-100 dark:border-gray-800">
                                    <div class="text-xs font-bold text-gray-900 dark:text-white">{{ auth()->user()->name ?? 'Admin' }}</div>
                                    <div class="text-[11px] text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email ?? 'admin@satyajeet.dev' }}</div>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5 rounded-lg transition">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Edit Profile
                                    </a>
                                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5 rounded-lg transition">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Settings
                                    </a>
                                </div>
                                <div class="pt-1 border-t border-gray-100 dark:border-gray-800">
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/20 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content Area -->
            <main class="flex-1 min-h-0 overflow-y-auto overflow-x-hidden no-scrollbar bg-[#F8FAFC] dark:bg-[#0c1017]">
                <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800/60 text-emerald-800 dark:text-emerald-300 text-sm font-medium">
                            <svg class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800/60 text-rose-800 dark:text-rose-300 text-sm font-medium">
                            <svg class="w-5 h-5 flex-shrink-0 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if(isset($errors) && $errors->any())
                        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800/60 text-rose-800 dark:text-rose-300 text-sm">
                            <div class="font-semibold mb-1">Please fix the following issues:</div>
                            <ul class="list-disc list-inside space-y-0.5 text-xs">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    <script>
        function exportTableToCSV(filename = 'export.csv') {
            const table = document.querySelector('table');
            if (!table) return;
            let csv = [];
            const rows = table.querySelectorAll('tr');
            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll('td:not(.action-col), th:not(.action-col)');
                for (let j = 0; j < cols.length; j++) {
                    let text = cols[j].innerText.replace(/"/g, '""').replace(/\r?\n/g, ' ').trim();
                    row.push('"' + text + '"');
                }
                if (row.length > 0) csv.push(row.join(','));
            }
            const csvFile = new Blob(["\uFEFF" + csv.join("\n")], { type: 'text/csv;charset=utf-8;' });
            const downloadLink = document.createElement('a');
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>
</body>
</html>
