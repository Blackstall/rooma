<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsApprovedAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && 
            auth()->user()->role === 'agent' && 
            auth()->user()->is_approved) {
            return $next($request);
        }

        return redirect()->route('agent.pending');
    }
}
