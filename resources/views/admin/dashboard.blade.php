@extends('admin.layouts.app')

@section('title', 'Overview Dashboard')
@section('page-title', 'Overview Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Top Greeting Banner -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Admin Dashboard</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Welcome back, {{ auth()->user()->name ?? 'Satyajeetsinh' }}! Here is your portfolio engine overview.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20 shadow-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                System Online
            </span>
        </div>
    </div>

    <!-- TailAdmin Stat Cards Grid (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Total Projects -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] flex items-center justify-between shadow-xs hover:border-gray-300 dark:hover:border-gray-700 transition">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Projects</p>
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['projects_count'] }}</h3>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">
                        {{ $stats['featured_projects_count'] }} featured
                    </span>
                    <span class="text-gray-300 dark:text-gray-700">·</span>
                    <a href="{{ route('admin.projects.index') }}" class="text-xs font-semibold text-[#D96E17] hover:underline">
                        Manage &rarr;
                    </a>
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
        </div>

        <!-- Card 2: Published Articles -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] flex items-center justify-between shadow-xs hover:border-gray-300 dark:hover:border-gray-700 transition">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Blog Articles</p>
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['published_posts_count'] }}</h3>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs font-medium text-purple-600 dark:text-purple-400">
                        {{ $stats['posts_count'] }} total drafted
                    </span>
                    <span class="text-gray-300 dark:text-gray-700">·</span>
                    <a href="{{ route('admin.posts.index') }}" class="text-xs font-semibold text-[#D96E17] hover:underline">
                        View &rarr;
                    </a>
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
        </div>

        <!-- Card 3: Inbound Inquiries -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] flex items-center justify-between shadow-xs hover:border-gray-300 dark:hover:border-gray-700 transition">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Inbound Leads</p>
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['messages_count'] }}</h3>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs font-medium {{ $stats['unread_messages_count'] > 0 ? 'text-rose-600 dark:text-rose-400 font-bold' : 'text-gray-500 dark:text-gray-400' }}">
                        {{ $stats['unread_messages_count'] }} unread
                    </span>
                    <span class="text-gray-300 dark:text-gray-700">·</span>
                    <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-[#D96E17] hover:underline">
                        Inbox &rarr;
                    </a>
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <!-- Card 4: Tech Stack & Skills -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] flex items-center justify-between shadow-xs hover:border-gray-300 dark:hover:border-gray-700 transition">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Skills & Tech</p>
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['skills_count'] }}</h3>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">
                        {{ $stats['experiences_count'] }} milestones
                    </span>
                    <span class="text-gray-300 dark:text-gray-700">·</span>
                    <a href="{{ route('admin.skills.index') }}" class="text-xs font-semibold text-[#D96E17] hover:underline">
                        Stack &rarr;
                    </a>
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            </div>
        </div>
    </div>

    <!-- Two-Column Section: Inquiries & Projects -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Inquiries -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-6 shadow-xs flex flex-col">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Recent Inquiries & Leads</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Potential clients and messages from the contact form</p>
                </div>
                <a href="{{ route('admin.messages.index') }}"
                   class="px-3 py-1.5 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg transition">
                    View All
                </a>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-800 flex-1 mt-2">
                @forelse($recentMessages as $msg)
                    <div class="py-3.5 flex items-start justify-between gap-3 first:pt-2">
                        <div class="flex items-start gap-3 min-w-0">
                            <div class="w-8 h-8 rounded-full bg-[#D96E17]/10 text-[#D96E17] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $msg->name }}</span>
                                    @if($msg->status === 'unread')
                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">
                                            NEW
                                        </span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">
                                    {{ $msg->email }} · <span class="text-[#D96E17] font-medium">{{ $msg->project_type ?? 'General' }}</span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-1 mt-1">
                                    {{ $msg->message }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('admin.messages.show', $msg) }}"
                           class="px-2.5 py-1 text-xs font-medium text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800/80 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg transition shrink-0">
                            Open
                        </a>
                    </div>
                @empty
                    <div class="py-12 text-center text-xs text-gray-400 dark:text-gray-500">
                        No inquiries received yet. They will appear here when submitted.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Active Projects -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-6 shadow-xs flex flex-col">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Active Projects</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Production systems, APIs, and case study showcases</p>
                </div>
                <a href="{{ route('admin.projects.create') }}"
                   class="px-3 py-1.5 text-xs font-semibold text-white bg-[#D96E17] hover:bg-[#c95f14] rounded-lg transition flex items-center gap-1.5 shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Project
                </a>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-800 flex-1 mt-2">
                @forelse($recentProjects as $proj)
                    <div class="py-3 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 overflow-hidden shrink-0 flex items-center justify-center border border-gray-200 dark:border-gray-700/60">
                                @if($proj->cover_image)
                                    <img src="{{ Str::startsWith($proj->cover_image, 'http') ? $proj->cover_image : (Str::startsWith($proj->cover_image, 'projects/') ? asset('storage/' . $proj->cover_image) : asset($proj->cover_image)) }}"
                                         alt="{{ $proj->title }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $proj->title }}</h4>
                                    @if($proj->featured)
                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                                            FEATURED
                                        </span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 truncate">
                                    {{ $proj->category }} · {{ $proj->year ?? 'Current' }}
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.projects.edit', $proj) }}"
                           class="px-2.5 py-1 text-xs font-medium text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800/80 dark:text-gray-300 dark:hover:bg-gray-700 rounded-lg transition shrink-0">
                            Edit
                        </a>
                    </div>
                @empty
                    <div class="py-12 text-center text-xs text-gray-400 dark:text-gray-500">
                        No projects created yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts Card -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-6 shadow-xs">
        <h3 class="text-base font-bold text-gray-900 dark:text-white">Quick Management Shortcuts</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Jump directly to your portfolio content editors</p>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4">
            <a href="{{ route('admin.experiences.index') }}" class="p-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-gray-50/60 dark:bg-gray-800/40 hover:border-[#D96E17]/40 hover:bg-white dark:hover:bg-gray-800 transition group">
                <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">Career Experience</div>
                <div class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">Timeline & roles</div>
            </a>

            <a href="{{ route('admin.skills.index') }}" class="p-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-gray-50/60 dark:bg-gray-800/40 hover:border-[#D96E17]/40 hover:bg-white dark:hover:bg-gray-800 transition group">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">Tech Skills</div>
                <div class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">Backend & tools</div>
            </a>

            <a href="{{ route('admin.services.index') }}" class="p-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-gray-50/60 dark:bg-gray-800/40 hover:border-[#D96E17]/40 hover:bg-white dark:hover:bg-gray-800 transition group">
                <div class="w-8 h-8 rounded-lg bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">Services</div>
                <div class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">Offerings & features</div>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="p-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-gray-50/60 dark:bg-gray-800/40 hover:border-[#D96E17]/40 hover:bg-white dark:hover:bg-gray-800 transition group">
                <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">Site Settings</div>
                <div class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">SEO & Social links</div>
            </a>
        </div>
    </div>
</div>
@endsection
