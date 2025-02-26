<?php
// app/Http/Controllers/AgentController.php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function dashboard()
    {
        $agent = auth()->user()->agent;
        
        return view('agent.dashboard', [
            'properties' => Property::where('agent_id', auth()->id())->latest()->get(),
            'leads' => $agent->leads,
            'stats' => [
                'total_properties' => $agent->properties->count(),
                'active_leads' => $agent->leads->where('status', 'active')->count(),
                'closed_deals' => $agent->leads->where('status', 'closed')->count(),
            ]
        ]);
    }

    public function pendingApproval()
    {
        return view('agent.pending');
    }
}