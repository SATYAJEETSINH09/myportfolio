<?php

namespace App\Http\Controllers;

use App\Models\NavigationItem;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of all projects.
     */
    public function index(): View
    {
        $settings = Setting::pluck('value', 'key')->all();
        $navItems = NavigationItem::active()->get();

        $projects = Project::with(['technologies', 'features', 'images', 'challenges'])
            ->ordered()
            ->paginate(9);

        return view('projects.index', compact('projects', 'settings', 'navItems'));
    }

    /**
     * Display the specified project case study.
     */
    public function show(Project $project): View
    {
        $project->load(['technologies', 'features', 'images', 'challenges']);

        $settings = Setting::pluck('value', 'key')->all();
        $navItems = NavigationItem::active()->get();

        // Next project lookup
        $nextProject = Project::where('sort_order', '>', $project->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first() ?? Project::orderBy('sort_order', 'asc')->first();

        return view('projects.show', compact('project', 'nextProject', 'settings', 'navItems'));
    }
}
