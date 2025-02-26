<?php

// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(Chat $chat)
    {
        // Ensure the authenticated user is part of the chat
        $this->authorize('view', $chat);
        
        return view('chats.show', [
            'chat' => $chat->load('messages'),
            'property' => $chat->property
        ]);
    }

    public function storeMessage(Request $request, Chat $chat)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        
        $chat->messages()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return back();
    }

    public function closeDeal(Chat $chat)
    {
        // Ensure only the agent can close the deal
        $this->authorize('close', $chat);
        
        $chat->update(['deal_closed' => true]);
        return back()->with('success', 'Deal marked as closed!');
    }
}