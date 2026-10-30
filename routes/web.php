<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Production-ready routes for Satyajeetsinh Dodiya's Laravel Portfolio
*/

// Homepage
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.home');

// Projects Showcase & Case Studies
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

// Engineering Notes / Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// Resume / Curriculum Vitae Dedicated Page & PDF Download
Route::get('/resume', [ResumeController::class, 'show'])->name('resume.show');
Route::get('/resume/download', [ResumeController::class, 'download'])->name('resume.download');
Route::get('/cv', [ResumeController::class, 'show'])->name('resume.cv');

// Contact Form Submission (AJAX/JSON & Standard POST)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// AI Portfolio Assistant Endpoint
Route::post('/chat', [ChatController::class, 'message'])->name('chat.message');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Portfolio Studio)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Authentication
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Authenticated Admin Dashboard & Modules
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Projects Showcase
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);

        // Blog / Engineering Notes
        Route::resource('posts', \App\Http\Controllers\Admin\BlogController::class);

        // Career Experiences & Timeline
        Route::resource('experiences', \App\Http\Controllers\Admin\ExperienceController::class);

        // Technical Skills
        Route::resource('skills', \App\Http\Controllers\Admin\SkillController::class);

        // Services
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

        // Inbound Inquiries / Messages
        Route::get('/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/toggle', [\App\Http\Controllers\Admin\MessageController::class, 'toggleStatus'])->name('messages.toggle');
        Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');

        // Site Settings
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

        // Admin Profile & Password
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    });
});
