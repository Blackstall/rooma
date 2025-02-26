@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    @include('agent.partials.nav')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Total Properties</h3>
                <p class="text-2xl font-bold text-primary-600">{{ $stats['total_properties'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Active Leads</h3>
                <p class="text-2xl font-bold text-primary-600">{{ $stats['active_leads'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Closed Deals</h3>
                <p class="text-2xl font-bold text-primary-600">{{ $stats['closed_deals'] }}</p>
            </div>
        </div>

        <!-- Recent Leads -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Leads</h2>
            <div class="space-y-4">
                @foreach($leads as $lead)
                    <div class="border-b pb-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold">{{ $lead->customer->name }}</h3>
                                <p class="text-gray-600">{{ $lead->property->title }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm 
                                {{ $lead->status === 'closed' ? 'bg-green-100 text-green-800' : 'bg-primary-100 text-primary-600' }}">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Chats -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Chats</h2>
            <div class="space-y-4">
                @foreach($chats as $chat)
                    <a href="{{ route('agent.chat.show', $chat) }}" class="block border-b pb-4 hover:bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold">{{ $chat->customer->name }}</h3>
                                <p class="text-gray-600">{{ $chat->property->title }}</p>
                            </div>
                            @if($chat->deal_closed)
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                    Closed
                                </span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection