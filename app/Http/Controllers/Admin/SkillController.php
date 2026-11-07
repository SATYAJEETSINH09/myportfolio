<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Display a listing of skills.
     */
    public function index(Request $request): View
    {
        $query = Skill::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('badge', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $allCategories = Skill::select('category')->distinct()->pluck('category');
        $totalCount = Skill::count();

        $skills = $query->orderBy('category')->orderBy('sort_order', 'asc')->get();
        $skillsByCategory = $skills->groupBy('category');

        return view('admin.skills.index', compact('skillsByCategory', 'allCategories', 'totalCount'));
    }

    /**
     * Show the form for creating a new skill.
     */
    public function create(): View
    {
        $categories = Skill::select('category')->distinct()->pluck('category');
        return view('admin.skills.create', compact('categories'));
    }

    /**
     * Store a newly created skill in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'badge' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill added successfully.');
    }

    /**
     * Show the form for editing the specified skill.
     */
    public function edit(Skill $skill): View
    {
        $categories = Skill::select('category')->distinct()->pluck('category');
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    /**
     * Update the specified skill in storage.
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'badge' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified skill from storage.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}
