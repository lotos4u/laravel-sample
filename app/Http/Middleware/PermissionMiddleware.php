<?php

namespace App\Http\Middleware;

use App\Helpers\UserDataHelper;
use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $guardName, $permissions)
    {
        if (Auth::guard($guardName)->guest() || !UserDataHelper::userCanAny($permissions)) {
            abort(403);
        }
        return $next($request);
    }
}