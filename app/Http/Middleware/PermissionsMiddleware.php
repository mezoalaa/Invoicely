<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionsMiddleware
{
    // public function handle($request, Closure $next, $permission)
    // {
    //     if (Auth::check()) {
    //         // Debug the user and permission check
    //         dd(Auth::User(), Auth::user()->can($permission));
    //     }

    //     // If not authenticated, return 403 error
    //     return response()->view('errors.403', [], 403);
    // }
}
