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
