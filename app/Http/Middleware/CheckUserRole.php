<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    protected $role;

    public function __construct()
    {
        // Constructor with no parameters
    }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Retrieve the user's role from the session
        $userRole = session('role');
        //  dd($userRole, $roles);
        // Check if the user has one of the required roles
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Redirect or respond with an error message
        return response()->json(['error' => 'Unauthorized Access'], 401);
    }
}
