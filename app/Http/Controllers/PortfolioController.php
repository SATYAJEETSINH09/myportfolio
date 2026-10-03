<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Experience;
use App\Models\NavigationItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display the main portfolio homepage.
     */
    public function index(): View
    {
        $settings = Setting::pluck('value', 'key')->all();

        $navItems = NavigationItem::active()->get();

        // Featured and all projects with eager loading
        $featuredProject = Project::with(['technologies', 'features', 'images', 'challenges'])
            ->where('featured', true)
            ->first();

        $projects = Project::with(['technologies', 'features', 'images', 'challenges'])
            ->ordered()
            ->get();

        $skills = Skill::orderBy('sort_order')->get()->groupBy('category');

        $experiences = Experience::with('points')
            ->ordered()
            ->get();

        $services = Service::active()->get();

        $blogPosts = BlogPost::published()
            ->take(5)
            ->get();

        return view('pages.portfolio', compact(
            'settings',
            'navItems',
            'featuredProject',
            'projects',
            'skills',
            'experiences',
            'services',
            'blogPosts'
        ));
    }
}
