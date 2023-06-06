<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiToken = $request->header('Authorization');
        if (!$apiToken) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $user = User::where('api_token', $apiToken)->first();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Set the authenticated user on the request
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
