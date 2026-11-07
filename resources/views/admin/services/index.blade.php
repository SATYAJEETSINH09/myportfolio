@extends('admin.layouts.app')

@section('title', 'Services Offered')
@section('page-title', 'Services Offered')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Services & Engineering Offerings</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Manage technical consulting, API engineering packages, and client solutions</p>
        </div>
        <a href="{{ route('admin.services.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-[#D96E17] hover:bg-[#c95f14] text-white text-sm font-semibold shadow-xs transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Add Service</span>
        </a>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800 bg-gray-50/75 dark:bg-gray-800/40 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        <th class="py-3.5 px-4 w-20">Number</th>
                        <th class="py-3.5 px-4">Service Title</th>
                        <th class="py-3.5 px-4">Description</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Order</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                    @forelse($services as $svc)
                        <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition">
                            <td class="py-3.5 px-4 font-mono font-bold text-xs text-[#D96E17]">
                                {{ $svc->number }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-gray-900 dark:text-white">
                                {{ $svc->title }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-600 dark:text-gray-400 max-w-md truncate">
                                {{ $svc->description }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($svc->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-400">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-mono text-xs text-gray-500">
                                {{ $svc->sort_order }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('admin.services.edit', $svc) }}"
                                       class="px-2.5 py-1 text-xs font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $svc) }}" method="POST"
                                          onsubmit="return confirm('Delete this service?');" class="inline">
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
                            <td colspan="6" class="py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                                No services created yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
