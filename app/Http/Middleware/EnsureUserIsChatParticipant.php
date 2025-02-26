<?php

// app/Http/Middleware/EnsureUserIsChatParticipant.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Chat;

class EnsureUserIsChatParticipant
{
    public function handle(Request $request, Closure $next)
    {
        $chat = $request->route('chat');
        
        if (!$chat instanceof Chat) {
            $chat = Chat::findOrFail($chat);
        }

        if (auth()->id() !== $chat->agent_id && auth()->id() !== $chat->customer_id) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}