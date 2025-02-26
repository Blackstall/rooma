<?php

// app/Http/Controllers/PropertyController.php
namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;

class PropertyController extends Controller
{
    // Add authorization to methods
    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        return view('properties.edit', compact('property'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $this->authorize('update', $property);
        // ... rest of the code
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        // ... rest of the code
    }

    // Add agent properties method
    public function agentProperties()
    {
        $properties = auth()->user()->properties()->paginate(10);
        return view('properties.agent-index', compact('properties'));
    }
}