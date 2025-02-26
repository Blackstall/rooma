<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentApplicationController extends Controller
{
    public function create()
    {
        return view('agent.apply');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_number' => 'required|unique:agents',
            'company' => 'required|string|max:255',
        ]);

        // Create agent profile (pending approval)
        auth()->user()->agent()->create([
            'license_number' => $request->license_number,
            'company' => $request->company,
        ]);

        // Update user role to "agent" (still unapproved)
        auth()->user()->update(['role' => 'agent']);

        return redirect()->route('agent.pending');
    }
}
