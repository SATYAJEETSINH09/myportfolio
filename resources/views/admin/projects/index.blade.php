@extends('admin.layouts.app')

@section('title', 'Projects Showcase')
@section('page-title', 'Projects Showcase')

@section('content')
<div class="space-y-6">
    <!-- Top Header: Title, Breadcrumb & Primary Action Button -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Projects Management</h1>
            <nav class="flex items-center gap-2 mt-1 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#D96E17] transition-colors">Home</a>
                <span class="text-gray-400 dark:text-gray-600">&gt;</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Projects</span>
            </nav>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.projects.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#D96E17] hover:bg-[#c95f14] text-white text-sm font-semibold shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Add New Project</span>
            </a>
        </div>
    </div>

    <!-- Sub-Navigation Tabs (Pills Bar) -->
    <div class="inline-flex max-w-full rounded-md bg-gray-100 dark:bg-gray-800/60 p-1 items-center gap-1 overflow-x-auto no-scrollbar">
        <!-- All Projects Tab -->
        <a href="{{ route('admin.projects.index') }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ !request('featured') && !request('status')
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <span>All Projects</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ !request('featured') && !request('status') ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $totalCount ?? $projects->total() }}
            </span>
        </a>

        <!-- Featured Tab -->
        <a href="{{ route('admin.projects.index', array_merge(request()->query(), ['featured' => '1', 'status' => '', 'page' => 1])) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('featured') == '1'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <span>Featured</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('featured') == '1' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $featuredCount ?? 0 }}
            </span>
        </a>

        <!-- Completed Tab -->
        <a href="{{ route('admin.projects.index', array_merge(request()->query(), ['status' => 'completed', 'featured' => '', 'page' => 1])) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('status') === 'completed'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span>Completed</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('status') === 'completed' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $completedCount ?? 0 }}
            </span>
        </a>

        <!-- In Progress Tab -->
        <a href="{{ route('admin.projects.index', array_merge(request()->query(), ['status' => 'in_progress', 'featured' => '', 'page' => 1])) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('status') === 'in_progress'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>In Progress</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('status') === 'in_progress' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $inProgressCount ?? 0 }}
            </span>
        </a>
    </div>

    <!-- Main Card Container with Datatable -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] shadow-xs overflow-hidden"
         x-data="{
            selectAll: false,
            selected: [],
            filterOpen: false,
            columnsOpen: false,
            visibleCols: {
                cover: true,
                category: true,
                tech: true,
                featured: true,
                status: true
            },
            toggleAll() {
                this.selectAll = !this.selectAll;
                if (this.selectAll) {
                    this.selected = Array.from(document.querySelectorAll('.row-chk')).map(el => el.value);
                } else {
                    this.selected = [];
                }
            }
         }">

        <!-- TailAdmin Table Header Toolbar -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between p-4 bg-white dark:bg-white/[0.03] border-b border-gray-200 dark:border-white/10 gap-3">
            <!-- Left: Table Title -->
            <div class="flex items-center gap-2">
                <h3 class="text-base font-bold text-gray-900 dark:text-white tracking-tight">Projects</h3>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    {{ $projects->total() }}
                </span>
            </div>

            <!-- Right: Search, Filter, Export, Columns, Per-page -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Search Input with Search Icon -->
                <form method="GET" action="{{ route('admin.projects.index') }}" class="relative flex items-center w-full sm:w-60">
                    @foreach(request()->except(['search', 'page']) as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search projects..."
                           class="w-full pl-9 pr-3 py-1.5 text-xs rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-[#D96E17] focus:ring-1 focus:ring-[#D96E17]">
                    @if(request('search'))
                        <a href="{{ route('admin.projects.index', request()->except('search')) }}" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-gray-400 hover:text-gray-600">
                            &times;
                        </a>
                    @endif
                </form>

                <!-- Filter Popover Button -->
                <div class="relative">
                    <button type="button" @click="filterOpen = !filterOpen; columnsOpen = false"
                            class="inline-flex items-center justify-center p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                            title="Filter Options">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </button>

                    <!-- Filter Dropdown Popover -->
                    <div x-show="filterOpen" @click.away="filterOpen = false" x-cloak
                         class="absolute right-0 mt-2 w-72 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl p-4 z-50">
                        <form method="GET" action="{{ route('admin.projects.index') }}" class="space-y-3">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <div class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 pb-2">Filter Projects</div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                                <select name="category" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-1.5 text-xs text-gray-900 dark:text-white">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select name="status" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-1.5 text-xs text-gray-900 dark:text-white">
                                    <option value="">All Statuses</option>
                                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <a href="{{ route('admin.projects.index') }}" class="text-xs text-gray-500 hover:text-gray-800 dark:text-gray-400">Reset</a>
                                <button type="submit" class="px-3 py-1.5 bg-[#D96E17] text-white rounded-lg text-xs font-semibold hover:bg-[#c95f14]">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Export Table Button (CSV Download) -->
                <button type="button" @click="exportTableToCSV('projects_export.csv')"
                        class="inline-flex items-center justify-center p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                        title="Export to CSV">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </button>

                <!-- Column Visibility Dropdown -->
                <div class="relative">
                    <button type="button" @click="columnsOpen = !columnsOpen; filterOpen = false"
                            class="inline-flex items-center justify-center p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                            title="Toggle Columns">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                    </button>

                    <div x-show="columnsOpen" @click.away="columnsOpen = false" x-cloak
                         class="absolute right-0 mt-2 w-48 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl p-3 z-50 space-y-2">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-700 pb-1">Visible Columns</div>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.cover" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Cover Image</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.category" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Category</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.tech" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Tech Stack</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.featured" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Featured</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.status" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Status</span>
                        </label>
                    </div>
                </div>

                <!-- Per Page Select Dropdown -->
                <form method="GET" action="{{ route('admin.projects.index') }}" class="inline">
                    @foreach(request()->except(['per_page', 'page']) as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <select name="per_page" onchange="this.form.submit()"
                            class="rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-2.5 py-1.5 text-xs text-gray-700 dark:text-gray-300 focus:outline-none focus:border-[#D96E17]">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800 bg-gray-50/75 dark:bg-gray-800/40 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        <th class="py-3 px-4 w-10">
                            <input type="checkbox" @click="toggleAll()" :checked="selectAll" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                        </th>
                        <th class="py-3 px-3 w-14 font-mono">NO.</th>
                        <th class="py-3.5 px-4 w-16" x-show="visibleCols.cover">Cover</th>
                        <th class="py-3.5 px-4">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Project Details</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.category">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Category</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.tech">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Tech Stack</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.featured">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Featured</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.status">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Status</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4 text-right action-col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @forelse($projects as $index => $proj)
                        <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition">
                            <td class="py-3.5 px-4">
                                <input type="checkbox" value="{{ $proj->id }}" x-model="selected" class="row-chk rounded text-[#D96E17] focus:ring-[#D96E17]">
                            </td>
                            <td class="py-3.5 px-3 font-mono text-xs text-gray-400">
                                {{ ($projects->currentPage() - 1) * $projects->perPage() + $index + 1 }}
                            </td>
                            <td class="py-3.5 px-4" x-show="visibleCols.cover">
                                <div class="w-12 h-9 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700 shrink-0">
                                    @if($proj->cover_image)
                                        <img src="{{ Str::startsWith($proj->cover_image, 'http') ? $proj->cover_image : (Str::startsWith($proj->cover_image, 'projects/') ? asset('storage/' . $proj->cover_image) : asset($proj->cover_image)) }}"
                                             alt="{{ $proj->title }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-[9px] text-gray-400 font-mono">None</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <a href="{{ route('admin.projects.edit', $proj) }}" class="font-bold text-gray-900 dark:text-white hover:text-[#D96E17] transition-colors block">
                                    {{ $proj->title }}
                                </a>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1 max-w-sm">
                                    {{ $proj->tagline ?? $proj->role }}
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap" x-show="visibleCols.category">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                                    {{ $proj->category }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4" x-show="visibleCols.tech">
                                <div class="flex flex-wrap gap-1 max-w-xs">
                                    @foreach($proj->technologies->take(3) as $tech)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                            {{ $tech->name }}
                                        </span>
                                    @endforeach
                                    @if($proj->technologies->count() > 3)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] text-gray-400">
                                            +{{ $proj->technologies->count() - 3 }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap" x-show="visibleCols.featured">
                                @if($proj->featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                        Featured
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-400 dark:text-gray-500">
                                        Standard
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap" x-show="visibleCols.status">
                                @if($proj->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                        Completed
                                    </span>
                                @elseif($proj->status === 'in_progress')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                                        In Progress
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                        {{ ucfirst($proj->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap action-col">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('projects.show', $proj->slug) }}" target="_blank"
                                       class="p-1.5 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                       title="Live Preview">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $proj) }}"
                                       class="px-2.5 py-1 text-xs font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $proj) }}" method="POST"
                                          onsubmit="return confirm('Delete this project?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-2.5 py-1 text-xs font-medium text-rose-600 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:hover:bg-rose-950/50 rounded-lg transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                                No projects found matching the current filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TailAdmin Table Footer -->
        <div class="flex flex-col sm:flex-row items-center justify-between p-4 border-t border-gray-200 dark:border-white/10 text-xs text-gray-500 dark:text-gray-400 gap-3">
            <div>
                Showing <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $projects->firstItem() ?? 0 }}</span>
                to <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $projects->lastItem() ?? 0 }}</span>
                of <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $projects->total() ?? 0 }}</span> results
            </div>
            <div>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
