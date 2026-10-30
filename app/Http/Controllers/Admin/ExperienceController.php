<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Display a listing of experiences.
     */
    public function index(): View
    {
        $experiences = Experience::with('points')
            ->orderBy('sort_order', 'asc')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new experience.
     */
    public function create(): View
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created experience in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:100'],
            'stack' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:150'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'is_current' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'points' => ['nullable', 'array'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $experience = Experience::create($validated);

        if (!empty($request->points)) {
            foreach ($request->points as $i => $pointText) {
                if (!empty(trim($pointText))) {
                    $experience->points()->create([
                        'text' => trim($pointText),
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience record added successfully.');
    }

    /**
     * Show the form for editing the specified experience.
     */
    public function edit(Experience $experience): View
    {
        $experience->load('points');
        return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified experience in storage.
     */
    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:100'],
            'stack' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:150'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'is_current' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'points' => ['nullable', 'array'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $experience->update($validated);

        $experience->points()->delete();
        if (!empty($request->points)) {
            foreach ($request->points as $i => $pointText) {
                if (!empty(trim($pointText))) {
                    $experience->points()->create([
                        'text' => trim($pointText),
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience record updated successfully.');
    }

    /**
     * Remove the specified experience from storage.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience record deleted successfully.');
    }
}
