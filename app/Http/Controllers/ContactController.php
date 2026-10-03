<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Store a new contact message and return response (JSON for AJAX or redirect).
     */
    public function store(StoreContactRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();

        $message = ContactMessage::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Thank you, {$message->name}! Your message has been received.",
                'data' => [
                    'id' => $message->id,
                ],
            ], 201);
        }

        return back()->with('success', "Thank you, {$message->name}! Your message has been received.");
    }
}
