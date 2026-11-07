@extends('admin.layouts.app')

@section('title', 'Inbound Messages & Leads')
@section('page-title', 'Inbound Messages & Leads')

@section('content')
<div class="space-y-6">
    <!-- Top Header: Title, Breadcrumb -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Inbound Inquiries & Leads</h1>
            <nav class="flex items-center gap-2 mt-1 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#D96E17] transition-colors">Home</a>
                <span class="text-gray-400 dark:text-gray-600">&gt;</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Inquiries</span>
            </nav>
        </div>
    </div>

    <!-- Sub-Navigation Tabs (Pills Bar) -->
    <div class="inline-flex max-w-full rounded-md bg-gray-100 dark:bg-gray-800/60 p-1 items-center gap-1 overflow-x-auto no-scrollbar">
        <!-- All Inquiries -->
        <a href="{{ route('admin.messages.index') }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ !request('status')
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span>All Messages</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ !request('status') ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $totalCount ?? $messages->total() }}
            </span>
        </a>

        <!-- Unread Tab -->
        <a href="{{ route('admin.messages.index', array_merge(request()->query(), ['status' => 'unread', 'page' => 1])) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('status') === 'unread'
               ? 'bg-white dark:bg-gray-700 text-rose-600 dark:text-rose-400 border-2 border-rose-300 dark:border-rose-700/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
            <span>Unread</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('status') === 'unread' ? 'bg-rose-500 text-white' : 'bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400' }}">
                {{ $unreadCount ?? 0 }}
            </span>
        </a>

        <!-- Read Tab -->
        <a href="{{ route('admin.messages.index', array_merge(request()->query(), ['status' => 'read', 'page' => 1])) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('status') === 'read'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span>Read</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('status') === 'read' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $readCount ?? 0 }}
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
                status: true,
                email: true,
                type: true,
                budget: true,
                message: true,
                received: true
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
                <h3 class="text-base font-bold text-gray-900 dark:text-white tracking-tight">Inquiries</h3>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    {{ $messages->total() }}
                </span>
            </div>

            <!-- Right: Search, Filter, Export, Columns, Per-page -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Search Input with Search Icon -->
                <form method="GET" action="{{ route('admin.messages.index') }}" class="relative flex items-center w-full sm:w-60">
                    @foreach(request()->except(['search', 'page']) as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search sender, email, project..."
                           class="w-full pl-9 pr-3 py-1.5 text-xs rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-[#D96E17] focus:ring-1 focus:ring-[#D96E17]">
                    @if(request('search'))
                        <a href="{{ route('admin.messages.index', request()->except('search')) }}" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-gray-400 hover:text-gray-600">
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
                        <form method="GET" action="{{ route('admin.messages.index') }}" class="space-y-3">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <div class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 pb-2">Filter Inquiries</div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select name="status" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-1.5 text-xs text-gray-900 dark:text-white">
                                    <option value="">All Statuses</option>
                                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <a href="{{ route('admin.messages.index') }}" class="text-xs text-gray-500 hover:text-gray-800 dark:text-gray-400">Reset</a>
                                <button type="submit" class="px-3 py-1.5 bg-[#D96E17] text-white rounded-lg text-xs font-semibold hover:bg-[#c95f14]">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Export Table Button (CSV Download) -->
                <button type="button" @click="exportTableToCSV('inquiries_export.csv')"
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
                            <input type="checkbox" x-model="visibleCols.status" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Status</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.email" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Email</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.type" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Project Type</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.budget" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Budget</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.message" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Message</span>
                        </label>
                        <label class="flex items-center gap-2 text-xs text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" x-model="visibleCols.received" class="rounded text-[#D96E17] focus:ring-[#D96E17]">
                            <span>Received</span>
                        </label>
                    </div>
                </div>

                <!-- Per Page Select Dropdown -->
                <form method="GET" action="{{ route('admin.messages.index') }}" class="inline">
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
                        <th class="py-3.5 px-4" x-show="visibleCols.status">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Status</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Sender Name</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.email">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Email</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.type">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Project Type</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.budget">
                            <span>Budget</span>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.message">
                            <span>Message Snippet</span>
                        </th>
                        <th class="py-3.5 px-4" x-show="visibleCols.received">
                            <div class="inline-flex items-center gap-1 cursor-pointer select-none hover:text-gray-700 dark:hover:text-white">
                                <span>Received</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4 text-right action-col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @forelse($messages as $index => $msg)
                        <tr class="transition {{ $msg->status === 'unread' ? 'bg-[#D96E17]/5 dark:bg-[#D96E17]/10 font-semibold' : 'hover:bg-gray-50/60 dark:hover:bg-white/[0.02]' }}">
                            <td class="py-3.5 px-4">
                                <input type="checkbox" value="{{ $msg->id }}" x-model="selected" class="row-chk rounded text-[#D96E17] focus:ring-[#D96E17]">
                            </td>
                            <td class="py-3.5 px-3 font-mono text-xs text-gray-400">
                                {{ ($messages->currentPage() - 1) * $messages->perPage() + $index + 1 }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap" x-show="visibleCols.status">
                                @if($msg->status === 'unread')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">
                                        Unread
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-400 dark:text-gray-500">
                                        Read
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="font-bold text-gray-900 dark:text-white">{{ $msg->name }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-xs whitespace-nowrap" x-show="visibleCols.email">
                                <a href="mailto:{{ $msg->email }}" class="text-[#D96E17] hover:underline">
                                    {{ $msg->email }}
                                </a>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap" x-show="visibleCols.type">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                                    {{ $msg->project_type ?? 'General' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-600 dark:text-gray-300 whitespace-nowrap" x-show="visibleCols.budget">
                                {{ $msg->budget ?? '—' }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-500 dark:text-gray-400 max-w-xs truncate" x-show="visibleCols.message">
                                {{ $msg->message }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap" x-show="visibleCols.received">
                                {{ optional($msg->created_at)->diffForHumans() ?? 'Just now' }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap action-col">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('admin.messages.show', $msg) }}"
                                       class="px-2.5 py-1 text-xs font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg transition">
                                        View
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST"
                                          onsubmit="return confirm('Delete this inquiry?');" class="inline">
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
                            <td colspan="10" class="py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                                No contact inquiries found matching the criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TailAdmin Table Footer -->
        <div class="flex flex-col sm:flex-row items-center justify-between p-4 border-t border-gray-200 dark:border-white/10 text-xs text-gray-500 dark:text-gray-400 gap-3">
            <div>
                Showing <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $messages->firstItem() ?? 0 }}</span>
                to <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $messages->lastItem() ?? 0 }}</span>
                of <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $messages->total() ?? 0 }}</span> results
            </div>
            <div>
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
