<?php

namespace App\Http\Controllers;

use App\Models\NavigationItem;
use App\Models\Setting;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResumeController extends Controller
{
    /**
     * Display the dedicated full Curriculum Vitae page.
     */
    public function show(): View
    {
        $settings = Setting::pluck('value', 'key')->all();
        $navItems = NavigationItem::active()->get();

        return view('pages.resume-view', compact('settings', 'navItems'));
    }

    /**
     * Download or view the configured resume PDF.
     */
    public function download(): BinaryFileResponse|Response
    {
        $resumeFile = Setting::get('resume_file', 'resume/Satyajeetsinh_Dodiya_Resume.pdf');

        if (Storage::disk('public')->exists($resumeFile)) {
            return response()->download(Storage::disk('public')->path($resumeFile), 'Satyajeetsinh_Dodiya_Resume.pdf');
        }

        // Return inline readable printable curriculum vitae fallback
        $settings = Setting::pluck('value', 'key')->all();
        $navItems = NavigationItem::active()->get();
        return response()->view('pages.resume-view', compact('settings', 'navItems'));
    }
}
