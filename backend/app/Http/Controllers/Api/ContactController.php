<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\NewContactMessage;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request): JsonResponse
    {
        $message = ContactMessage::create([
            ...$request->validated(),
            'ip_address' => $request->ip(),
        ]);

        Log::info('Contact form submitted', ['id' => $message->id, 'email' => $message->email]);

        Mail::to(config('mail.admin_address', 'admin@agroforward.ru'))
            ->send(new NewContactMessage($message));

        return response()->json([
            'message' => 'Сообщение отправлено успешно',
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        $messages = ContactMessage::query()
            ->orderByDesc('created_at')
            ->paginate($request->integer('per_page', 20));

        return response()->json($messages);
    }

    public function show(ContactMessage $contactMessage): JsonResponse
    {
        if (!$contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }

        return response()->json($contactMessage);
    }

    public function destroy(ContactMessage $contactMessage): JsonResponse
    {
        $contactMessage->delete();

        return response()->json(['message' => 'Удалено']);
    }
}
