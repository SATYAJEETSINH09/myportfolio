@extends('admin.layouts.app')

@section('title', 'Articles Management')
@section('page-title', 'Articles Management')

@section('content')
<div class="space-y-6">
    <!-- Top Header: Title, Breadcrumb & Primary Action Button -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Articles Management</h1>
            <nav class="flex items-center gap-2 mt-1 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#D96E17] transition-colors">Home</a>
                <span class="text-gray-400 dark:text-gray-600">&gt;</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Articles</span>
            </nav>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.posts.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#D96E17] hover:bg-[#c95f14] text-white text-sm font-semibold shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Write New Article</span>
            </a>
        </div>
    </div>

    <!-- Sub-Navigation Tabs (Pills Bar) -->
    <div class="inline-flex max-w-full rounded-md bg-gray-100 dark:bg-gray-800/60 p-1 items-center gap-1 overflow-x-auto no-scrollbar">
        <!-- All Articles Tab -->
        <a href="{{ route('admin.posts.index') }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ !request('status')
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            <span>All Articles</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ !request('status') ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $totalCount ?? $posts->total() }}
            </span>
        </a>

        <!-- Published Tab -->
        <a href="{{ route('admin.posts.index', array_merge(request()->query(), ['status' => 'published', 'page' => 1])) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('status') === 'published'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Published</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('status') === 'published' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $publishedCount ?? 0 }}
            </span>
        </a>

        <!-- Drafts Tab -->
        <a href="{{ route('admin.posts.index', array_merge(request()->query(), ['status' => 'draft', 'page' => 1])) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('status') === 'draft'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            <span>Drafts</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('status') === 'draft' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $draftCount ?? 0 }}
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
                category: true,
                author: true,
                status: true,
                date: true
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
                <h3 class="text-base font-bold text-gray-900 dark:text-white tracking-tight">Articles</h3>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    {{ $posts->total() }}
                </span>
            </div>

            <!-- Right: Search, Filter, Export, Columns, Per-page -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Search Input with Search Icon -->
                <form method="GET" action="{{ route('admin.posts.index') }}" class="relative flex items-center w-full sm:w-60">
                    @foreach(request()->except(['search', 'page']) as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search articles..."
                           class="w-full pl-9 pr-3 py-1.5 text-xs rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-[#D96E17] focus:ring-1 focus:ring-[#D96E17]">
                    @if(request('search'))
                        <a href="{{ route('admin.posts.index', request()->except('search')) }}" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-gray-400 hover:text-gray-600">
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
                        <form method="GET" action="{{ route('admin.posts.index') }}" class="space-y-3">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <div class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 pb-2">Filter Articles</div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select name="status" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-1.5 text-xs text-gray-900 dark:text-white">
                                    <option value="">All Statuses</option>
                                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                                <select name="category" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-1.5 text-xs text-gray-900 dark:text-white">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <a href="{{ route('admin.posts.index') }}" class="text-xs text-gray-500 hover:text-gray-800 dark:text-gray-400">Reset</a>
                                <button type="submit" class="px-3 py-1.5 bg-[#D96E17] text-white rounded-lg text-xs font-semibold hover:bg-[#c95f14]">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Export Table Button (CSV Download) -->
                <button type="button" @click="exportTableToCSV('articles_export.csv')"
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
                            <input type="checkbox" x-model="visibleCols.category" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Category</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.author" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Author</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.status" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Status</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.date" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Date</span>
                        </label>
                    </div>
                </div>

                <!-- Per Page Select Dropdown -->
                <form method="GET" action="{{ route('admin.posts.index') }}" class="inline">
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
                        <th class="py-3.5 px-4">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Title & Excerpt</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.category">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Category</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.author">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Author</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.status">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Status</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.date">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Date</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4 text-right action-col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @forelse($posts as $index => $post)
                        <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition">
                            <td class="py-3.5 px-4">
                                <input type="checkbox" value="{{ $post->id }}" x-model="selected" class="row-chk rounded text-[#D96E17] focus:ring-[#D96E17]">
                            </td>
                            <td class="py-3.5 px-3 font-mono text-xs text-gray-400">
                                {{ ($posts->currentPage() - 1) * $posts->perPage() + $index + 1 }}
                            </td>
                            <td class="py-3.5 px-4">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="font-bold text-gray-900 dark:text-white hover:text-[#D96E17] transition-colors block">
                                    {{ $post->title }}
                                </a>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1 max-w-lg">
                                    {{ $post->excerpt }}
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap" x-show="visibleCols.category">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                                    {{ $post->category ?? 'Backend' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-600 dark:text-gray-300 whitespace-nowrap" x-show="visibleCols.author">
                                {{ $post->author }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap" x-show="visibleCols.status">
                                @if($post->status === 'published')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200/50">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap" x-show="visibleCols.date">
                                {{ optional($post->published_at)->format('M d, Y') ?? $post->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap action-col">
                                <div class="inline-flex items-center gap-1.5">
                                    @if($post->status === 'published')
                                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                           class="p-1.5 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                           title="Live Preview">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                       class="px-2.5 py-1 text-xs font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                          onsubmit="return confirm('Delete this article?');" class="inline">
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
                            <td colspan="8" class="py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                                No blog articles found matching the current criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TailAdmin Table Footer -->
        <div class="flex flex-col sm:flex-row items-center justify-between p-4 border-t border-gray-200 dark:border-white/10 text-xs text-gray-500 dark:text-gray-400 gap-3">
            <div>
                Showing <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $posts->firstItem() ?? 0 }}</span>
                to <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $posts->lastItem() ?? 0 }}</span>
                of <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $posts->total() ?? 0 }}</span> results
            </div>
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
