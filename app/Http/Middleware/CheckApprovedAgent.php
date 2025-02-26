<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApprovedAgent
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->isApprovedAgent()) {
            return $next($request);
        }

        return redirect()->route('agent.pending');
    }
}