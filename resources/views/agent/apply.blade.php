<!-- resources/views/agent/apply.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900">Apply as Agent</h1>
        <form action="{{ route('agent.apply.store') }}" method="POST" class="mt-6 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">License Number</label>
                <input type="text" name="license_number" required class="mt-1 block w-full rounded-lg border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Company Name</label>
                <input type="text" name="company" required class="mt-1 block w-full rounded-lg border-gray-300">
            </div>
            <button type="submit" class="bg-primary-500 text-white px-6 py-2 rounded-lg hover:bg-primary-600">
                Submit Application
            </button>
        </form>
    </div>
</div>
@endsection