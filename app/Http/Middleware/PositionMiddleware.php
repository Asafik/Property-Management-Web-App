<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionMiddleware
{
    public function handle(Request $request, Closure $next, ...$positionIds)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        // langsung pakai position_id
        if (!in_array($user->position_id, $positionIds)) {
            abort(403);
        }

        return $next($request);
    }
}
