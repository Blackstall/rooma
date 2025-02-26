<?php

// app/Http/Controllers/AgentDashboardController.php
namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Chat;
use App\Models\Property;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agent = auth()->user();

        // Dashboard Stats
        $stats = [
            'total_properties' => $agent->properties()->count(),
            'active_leads' => Lead::where('agent_id', $agent->id)->where('status', '!=', 'closed')->count(),
            'closed_deals' => Lead::where('agent_id', $agent->id)->where('status', 'closed')->count(),
            'estimated_sales' => $agent->properties()->sum('price'), // Or your custom logic
        ];

        // Recent Leads
        $leads = Lead::with(['customer', 'property'])
            ->where('agent_id', $agent->id)
            ->latest()
            ->take(5)
            ->get();

        // Recent Chats
        $chats = Chat::with(['customer', 'property'])
            ->where('agent_id', $agent->id)
            ->latest()
            ->take(5)
            ->get();

        return view('agent.dashboard', compact('stats', 'leads', 'chats'));
    }
}