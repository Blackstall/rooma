@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('agent.partials.nav')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <!-- Chat Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-xl font-bold">Chat with {{ $chat->customer->name }}</h1>
                @if(!$chat->deal_closed)
                    <form action="{{ route('agent.chat.close', $chat) }}" method="POST">
                        @csrf
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            Mark as Closed
                        </button>
                    </form>
                @endif
            </div>

            <!-- Messages -->
            <div class="h-96 overflow-y-auto mb-6 p-4 bg-gray-50 rounded-lg">
                @foreach($messages as $message)
                    <div class="mb-4 {{ $message->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                        <div class="inline-block p-3 rounded-lg max-w-md 
                            {{ $message->user_id === auth()->id() ? 'bg-primary-500 text-white' : 'bg-gray-100' }}">
                            {{ $message->content }}
                            <p class="text-xs mt-1 {{ $message->user_id === auth()->id() ? 'text-primary-100' : 'text-gray-500' }}">
                                {{ $message->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            @if(!$chat->deal_closed)
                <form action="{{ route('agent.chat.message.store', $chat) }}" method="POST">
                    @csrf
                    <div class="flex gap-4">
                        <input type="text" name="content" class="flex-1 rounded-lg border-gray-300" placeholder="Type your message...">
                        <button class="bg-primary-500 text-white px-6 py-2 rounded-lg hover:bg-primary-600">
                            Send
                        </button>
                    </div>
                </form>
            @else
                <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                    This deal is closed. No further messages can be sent.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection