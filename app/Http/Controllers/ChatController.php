<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Process simulated AI portfolio assistant queries.
     */
    public function message(Request $request): JsonResponse
    {
        $request->validate([
            'message' => ['required', 'string', 'max:500'],
        ]);

        $query = strtolower(trim($request->input('message')));

        $reply = $this->resolveResponse($query);

        return response()->json([
            'success' => true,
            'response' => $reply,
        ]);
    }

    protected function resolveResponse(string $query): string
    {
        if (str_contains($query, 'project') || str_contains($query, 'work') || str_contains($query, 'dare play')) {
            $titles = Project::pluck('title')->implode(', ');
            return "Satyajeetsinh has built several production systems including: **{$titles}**. You can explore their detailed case studies in the Selected Work section!";
        }

        if (str_contains($query, 'skill') || str_contains($query, 'tech') || str_contains($query, 'stack') || str_contains($query, 'laravel')) {
            $backend = Skill::byCategory('Backend')->pluck('name')->implode(', ');
            return "His core backend stack includes **{$backend}**, with tools like **Docker, Git, and Postman** for reliable deployment and testing.";
        }

        if (str_contains($query, 'experience') || str_contains($query, 'company') || str_contains($query, 'binstellar')) {
            return "Satyajeetsinh currently works as a **Backend Developer at Binstellar Technologies Pvt. Ltd.** (2025–Present), building Laravel REST APIs, admin systems, and database relationships.";
        }

        if (str_contains($query, 'available') || str_contains($query, 'hire') || str_contains($query, 'freelance') || str_contains($query, 'contact') || str_contains($query, 'email')) {
            $email = Setting::get('email', 'satyajeetsinh.dodiya@gmail.com');
            return "Yes! Satyajeetsinh is **available for select opportunities and freelance projects**. You can reach him directly at **{$email}** or using the contact form.";
        }

        return "Satyajeetsinh specializes in Laravel backend architecture, REST API design, database performance, and building production web applications. Would you like to check out his **Selected Projects**, **Technical Toolkit**, or **Get in Touch**?";
    }
}
