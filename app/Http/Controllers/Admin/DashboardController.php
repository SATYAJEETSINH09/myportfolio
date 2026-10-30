<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with real-time statistics.
     */
    public function index(): View
    {
        $stats = [
            'projects_count' => Project::count(),
            'featured_projects_count' => Project::where('featured', true)->count(),
            'posts_count' => BlogPost::count(),
            'published_posts_count' => BlogPost::where('status', 'published')->count(),
            'messages_count' => ContactMessage::count(),
            'unread_messages_count' => ContactMessage::where('status', 'unread')->count(),
            'skills_count' => Skill::count(),
            'experiences_count' => Experience::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(4)->get();
        $recentPosts = BlogPost::latest()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects', 'recentPosts'));
    }
}
