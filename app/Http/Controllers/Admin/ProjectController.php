<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectChallenge;
use App\Models\ProjectFeature;
use App\Models\ProjectImage;
use App\Models\ProjectTechnology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request): View
    {
        $query = Project::with(['technologies', 'features']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $projects = $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        $categories = Project::select('category')->distinct()->pluck('category');

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug'],
            'project_number' => ['nullable', 'string', 'max:20'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'year' => ['nullable', 'string', 'max:50'],
            'role' => ['nullable', 'string', 'max:100'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'client' => ['nullable', 'string', 'max:150'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'challenge' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'status' => ['required', 'string', 'in:completed,in_progress,archived'],
            'sort_order' => ['nullable', 'integer'],
            'metrics_labels' => ['nullable', 'array'],
            'metrics_values' => ['nullable', 'array'],
            'features_titles' => ['nullable', 'array'],
            'features_descriptions' => ['nullable', 'array'],
            'technologies' => ['nullable', 'array'],
            'challenges_text' => ['nullable', 'array'],
            'solutions_text' => ['nullable', 'array'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle cover image file upload
        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('projects', 'public');
            $validated['cover_image'] = $path;
        }

        $validated['featured'] = $request->boolean('featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Process metrics
        $metrics = [];
        if (!empty($request->metrics_labels)) {
            foreach ($request->metrics_labels as $i => $label) {
                if (!empty($label) && isset($request->metrics_values[$i])) {
                    $metrics[] = [
                        'label' => $label,
                        'val' => $request->metrics_values[$i],
                    ];
                }
            }
        }
        $validated['metrics'] = !empty($metrics) ? $metrics : null;

        $project = Project::create($validated);

        // Save Technologies
        if ($request->filled('technologies')) {
            foreach ($request->technologies as $techName) {
                if (!empty(trim($techName))) {
                    $project->technologies()->create([
                        'name' => trim($techName),
                    ]);
                }
            }
        }

        // Save Features
        if (!empty($request->features_titles)) {
            foreach ($request->features_titles as $i => $fTitle) {
                if (!empty(trim($fTitle))) {
                    $project->features()->create([
                        'title' => trim($fTitle),
                        'description' => $request->features_descriptions[$i] ?? null,
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        }

        // Save Challenges / Solutions
        if (!empty($request->challenges_text)) {
            foreach ($request->challenges_text as $i => $cText) {
                if (!empty(trim($cText))) {
                    $project->challenges()->create([
                        'challenge' => trim($cText),
                        'solution' => $request->solutions_text[$i] ?? '',
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        }

        // Save Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $imgFile) {
                $imgPath = $imgFile->store('projects/gallery', 'public');
                $project->images()->create([
                    'image' => $imgPath,
                    'alt_text' => $project->title,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        $project->load(['technologies', 'features', 'challenges', 'images']);
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:projects,slug,' . $project->id],
            'project_number' => ['nullable', 'string', 'max:20'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'year' => ['nullable', 'string', 'max:50'],
            'role' => ['nullable', 'string', 'max:100'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'client' => ['nullable', 'string', 'max:150'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'challenge' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'status' => ['required', 'string', 'in:completed,in_progress,archived'],
            'sort_order' => ['nullable', 'integer'],
            'metrics_labels' => ['nullable', 'array'],
            'metrics_values' => ['nullable', 'array'],
            'features_titles' => ['nullable', 'array'],
            'features_descriptions' => ['nullable', 'array'],
            'technologies' => ['nullable', 'array'],
            'challenges_text' => ['nullable', 'array'],
            'solutions_text' => ['nullable', 'array'],
        ]);

        if ($request->hasFile('cover_image_file')) {
            if ($project->cover_image && !Str::startsWith($project->cover_image, ['http', 'projects/default'])) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $path = $request->file('cover_image_file')->store('projects', 'public');
            $validated['cover_image'] = $path;
        }

        $validated['featured'] = $request->boolean('featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Process metrics
        $metrics = [];
        if (!empty($request->metrics_labels)) {
            foreach ($request->metrics_labels as $i => $label) {
                if (!empty($label) && isset($request->metrics_values[$i])) {
                    $metrics[] = [
                        'label' => $label,
                        'val' => $request->metrics_values[$i],
                    ];
                }
            }
        }
        $validated['metrics'] = !empty($metrics) ? $metrics : null;

        $project->update($validated);

        // Update Technologies
        $project->technologies()->delete();
        if ($request->filled('technologies')) {
            foreach ($request->technologies as $techName) {
                if (!empty(trim($techName))) {
                    $project->technologies()->create([
                        'name' => trim($techName),
                    ]);
                }
            }
        }

        // Update Features
        $project->features()->delete();
        if (!empty($request->features_titles)) {
            foreach ($request->features_titles as $i => $fTitle) {
                if (!empty(trim($fTitle))) {
                    $project->features()->create([
                        'title' => trim($fTitle),
                        'description' => $request->features_descriptions[$i] ?? null,
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        }

        // Update Challenges
        $project->challenges()->delete();
        if (!empty($request->challenges_text)) {
            foreach ($request->challenges_text as $i => $cText) {
                if (!empty(trim($cText))) {
                    $project->challenges()->create([
                        'challenge' => trim($cText),
                        'solution' => $request->solutions_text[$i] ?? '',
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        }

        // Additional Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $imgFile) {
                $imgPath = $imgFile->store('projects/gallery', 'public');
                $project->images()->create([
                    'image' => $imgPath,
                    'alt_text' => $project->title,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        if ($project->cover_image && !Str::startsWith($project->cover_image, ['http'])) {
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
