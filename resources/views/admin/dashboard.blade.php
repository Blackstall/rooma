<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>

        <!-- Pending Agents -->
        <div class="mt-6">
            <h2 class="text-xl font-bold text-gray-900">Pending Agent Applications</h2>
            <div class="mt-4 space-y-4">
                @foreach($pendingAgents as $agent)
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $agent->name }}</h3>
                        <p class="text-gray-600">{{ $agent->agent->company }}</p>
                        <div class="mt-4 flex gap-4">
                            <form action="{{ route('admin.agent.approve', $agent) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg">Approve</button>
                            </form>
                            <form action="{{ route('admin.agent.reject', $agent) }}" method="POST">
                                @csrf
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Reject</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection