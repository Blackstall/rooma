<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomA - Your Real Estate Marketplace</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Header -->
    <nav class="bg-white shadow-sm fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <h2 class="text-3xl font-bold text-primary-600">rooma</h2>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center space-x-8">
                    <a href="{{ route('properties.index') }}" class="text-gray-700 hover:text-primary-600 transition-colors">
                        Listings
                    </a>
                    <a href="#agents" class="text-gray-700 hover:text-primary-600 transition-colors">
                        Agents
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-600 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-primary-500 text-white px-6 py-2 rounded-full hover:bg-primary-600 transition-colors">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="pt-24 pb-12 bg-gradient-to-b from-primary-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl md:text-6xl">
                    Find Your Perfect 
                    <span class="text-primary-600">Property</span>
                </h1>
                
                <!-- Search Bar -->
                <div class="mt-8 max-w-2xl mx-auto">
                    <form class="flex gap-4">
                        <input type="text" placeholder="Location, property type..." class="flex-1 rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                        <button class="bg-primary-500 text-white px-8 py-3 rounded-lg hover:bg-primary-600 transition-colors">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Listings -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Featured Properties</h2>
            
            @if($featuredProperties->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredProperties as $property)
                        <!-- Property Card -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <img src="{{ $property->featured_image ?? '/placeholder-property.jpg' }}" 
                                 alt="{{ $property->title }}" 
                                 class="h-48 w-full object-cover">
                            
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $property->title }}</h3>
                                    <span class="bg-primary-100 text-primary-600 px-3 py-1 rounded-full text-sm">
                                        {{ $property->type }}
                                    </span>
                                </div>
                                
                                <p class="text-primary-600 text-xl font-bold mb-4">
                                    ${{ number_format($property->price) }}
                                </p>
                                
                                <div class="flex items-center space-x-4 text-gray-600">
                                    <span class="flex items-center">
                                        <!-- Bed Icon -->
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        {{ $property->bedrooms }}
                                    </span>
                                    <span class="flex items-center">
                                        <!-- Bath Icon -->
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        {{ $property->bathrooms }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No featured properties available at the moment.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-600">&copy; {{ date('Y') }} rooma. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>