<?php

// app/Http/Controllers/WelcomeController.php
namespace App\Http\Controllers;

use App\Models\Property;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch featured properties
        $featuredProperties = Property::where('featured', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('welcome', compact('featuredProperties'));
    }
}