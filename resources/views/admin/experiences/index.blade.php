@extends('admin.layouts.app')

@section('title', 'Work Experience & History')
@section('page-title', 'Work Experience & History')

@section('content')
<div class="space-y-6">
    <!-- Top Header: Title, Breadcrumb & Primary Action Button -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Career Experience Management</h1>
            <nav class="flex items-center gap-2 mt-1 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#D96E17] transition-colors">Home</a>
                <span class="text-gray-400 dark:text-gray-600">&gt;</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Experience</span>
            </nav>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.experiences.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#D96E17] hover:bg-[#c95f14] text-white text-sm font-semibold shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Add Experience</span>
            </a>
        </div>
    </div>

    <!-- Sub-Navigation Tabs (Pills Bar) -->
    <div class="inline-flex max-w-full rounded-md bg-gray-100 dark:bg-gray-800/60 p-1 items-center gap-1 overflow-x-auto no-scrollbar">
        <!-- All Roles Tab -->
        <a href="{{ route('admin.experiences.index') }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ !request()->has('is_current')
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span>All Positions</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ !request()->has('is_current') ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $totalCount }}
            </span>
        </a>

        <!-- Present Role Tab -->
        <a href="{{ route('admin.experiences.index', ['is_current' => '1']) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('is_current') === '1'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span>Current Roles</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('is_current') === '1' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $currentCount }}
            </span>
        </a>

        <!-- Past Positions Tab -->
        <a href="{{ route('admin.experiences.index', ['is_current' => '0']) }}"
           class="whitespace-nowrap inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-150 select-none
           {{ request('is_current') === '0'
               ? 'bg-white dark:bg-gray-700 text-[#D96E17] dark:text-[#fd853a] border-2 border-gray-300/70 dark:border-gray-600/50 shadow-xs'
               : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border-2 border-transparent' }}">
            <span>Past Positions</span>
            <span class="inline-flex items-center justify-center rounded-full h-5 px-1.5 min-w-5 text-[10px] font-bold {{ request('is_current') === '0' ? 'bg-[#D96E17] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                {{ $pastCount }}
            </span>
        </a>
    </div>

    <!-- Main Card Container with Datatable -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] shadow-xs overflow-hidden"
         x-data="{
            selectAll: false,
            selected: [],
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
            <div class="flex items-center gap-2">
                <h3 class="text-base font-bold text-gray-900 dark:text-white tracking-tight">Timeline Entries</h3>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    {{ $experiences->count() }} roles
                </span>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <!-- Search Input -->
                <form method="GET" action="{{ route('admin.experiences.index') }}" class="relative flex items-center w-full sm:w-60">
                    @if(request()->has('is_current'))
                        <input type="hidden" name="is_current" value="{{ request('is_current') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search company, title, stack..."
                           class="w-full pl-9 pr-3 py-1.5 text-xs rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-[#D96E17] focus:ring-1 focus:ring-[#D96E17]">
                </form>

                <!-- Export Table Button (CSV Download) -->
                <button type="button" @click="exportTableToCSV('experience_export.csv')"
                        class="inline-flex items-center justify-center p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                        title="Export to CSV">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </button>
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
                                <span>Position & Company</span>
                                <span class="text-gray-400 text-[10px]">&#x21C5;</span>
                            </div>
                        </th>
                        <th class="py-3.5 px-4">Period</th>
                        <th class="py-3.5 px-4">Tech Stack</th>
                        <th class="py-3.5 px-4">Key Achievements</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right action-col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @forelse($experiences as $index => $exp)
                        <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition">
                            <td class="py-3.5 px-4">
                                <input type="checkbox" value="{{ $exp->id }}" x-model="selected" class="row-chk rounded text-[#D96E17] focus:ring-[#D96E17]">
                            </td>
                            <td class="py-3.5 px-3 font-mono text-xs text-gray-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-gray-900 dark:text-white">{{ $exp->position }}</div>
                                <div class="text-xs font-semibold text-[#D96E17] mt-0.5">{{ $exp->company }}</div>
                                @if($exp->location)
                                    <div class="text-[11px] text-gray-400 mt-0.5">{{ $exp->location }}</div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-mono text-xs text-gray-600 dark:text-gray-400 whitespace-nowrap">
                                {{ $exp->period }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-600 dark:text-gray-400 max-w-xs">
                                {{ $exp->stack ?? '—' }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                                    {{ $exp->points->count() }} contributions
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($exp->is_current)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                                        Present Role
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-400">
                                        Past
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap action-col">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('admin.experiences.edit', $exp) }}"
                                       class="px-2.5 py-1 text-xs font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST"
                                          onsubmit="return confirm('Delete this career milestone?');" class="inline">
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
                                No career experiences found matching the criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-200 dark:border-white/10 text-xs text-gray-500 dark:text-gray-400">
            Showing {{ $experiences->count() }} career milestone entries
        </div>
    </div>
</div>
@endsection
