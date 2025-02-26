<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function approveAgent(User $user)
    {
        $user->update(['is_approved' => true]);
        return back()->with('success', 'Agent approved!');
    }
    
    public function rejectAgent(User $user)
    {
        $user->update(['role' => 'customer']);
        $user->agent()->delete();
        return back()->with('success', 'Agent application rejected.');
    }
}
