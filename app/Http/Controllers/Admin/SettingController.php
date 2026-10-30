<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display all settings organized by tabs.
     */
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $input = $request->except(['_token', '_method', 'resume_pdf']);

        // Handle text settings
        foreach ($input as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }

        // Handle Resume PDF file upload
        if ($request->hasFile('resume_pdf')) {
            $request->validate([
                'resume_pdf' => ['file', 'mimes:pdf', 'max:10240'], // 10MB max
            ]);

            $path = $request->file('resume_pdf')->storeAs('resume', 'Satyajeetsinh_Dodiya_Resume.pdf', 'public');
            Setting::updateOrCreate(
                ['key' => 'resume_file'],
                ['value' => $path]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
