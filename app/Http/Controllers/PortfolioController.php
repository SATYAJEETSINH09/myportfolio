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

        $educations = [
            [
                'degree' => 'Bachelor of Engineering in Computer Engineering',
                'field' => 'Computer Engineering',
                'institution' => 'Government Engineering College, Modasa',
                'location' => 'Modasa, India',
                'period' => '2020 — 2025',
                'grade' => 'CGPA: 7.52',
                'badge' => 'B.E. DEGREE · CGPA: 7.52',
                'badge_type' => 'college',
                'description' => 'Bachelor of Engineering in Computer Engineering from Government Engineering College, Modasa with 7.52 CGPA, focusing on system architecture, database engineering, and software development.',
                'skills' => ['Computer Engineering', 'DBMS & MySQL', 'Data Structures', 'OOP', 'Web Architecture', 'CGPA: 7.52'],
                'highlights' => [
                    'Graduated with CGPA 7.52 in Bachelor of Engineering (Computer Engineering).',
                    'Specialized in Database Management Systems (MySQL), Data Structures & Algorithms, and System Architecture.',
                    'Engineered capstone projects applying full-stack and backend engineering principles.',
                ],
            ],
            [
                'degree' => 'Higher Secondary Certificate — XII (GSEB)',
                'field' => 'Science & General Stream',
                'institution' => 'Shree D.A. Vidhya Mandir',
                'location' => 'Dhandhuka, India',
                'period' => '2020',
                'grade' => 'Score: 64%',
                'badge' => 'XII (GSEB) · 64%',
                'badge_type' => 'school',
                'description' => 'Completed Higher Secondary Certificate (Class XII) under Gujarat Secondary and Higher Secondary Education Board (GSEB) at Shree D.A. Vidhya Mandir with 64%.',
                'skills' => ['Mathematics', 'Computer Studies', 'Science & Logic', 'Score: 64%'],
                'highlights' => [
                    'Scored 64% in Class XII (GSEB) with strong grounding in mathematics and science.',
                    'Built foundational knowledge in discrete logic, algebra, and computational problem solving.',
                ],
            ],
        ];

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
            'educations',
            'services',
            'blogPosts'
        ));
    }
}
