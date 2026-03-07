<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionMiddleware
{
    public function handle(Request $request, Closure $next, ...$positions)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $userPosition = strtolower($user->position->name);

        if (!in_array($userPosition, $positions)) {
            abort(403);
        }

        return $next($request);
    }
}