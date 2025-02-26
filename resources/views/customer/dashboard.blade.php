<!-- resources/views/customer/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600">You are a customer. Browse properties or apply to become an agent.</p>

        <!-- Apply as Agent Button -->
        <div class="mt-6">
            <a href="{{ route('agent.apply') }}" class="bg-primary-500 text-white px-6 py-2 rounded-lg hover:bg-primary-600">
                Apply as Agent
            </a>
        </div>
    </div>
</div>
@endsection