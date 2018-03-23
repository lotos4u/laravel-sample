<?php

namespace App\Http\Middleware;

use App\Helpers\UserDataHelper;
use App\Models\User;
use Closure;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Zizaco\Entrust\Middleware\EntrustPermission;

class UserDataMiddleware
{
    public function handle($request, Closure $next)
    {
        if (User::getUserFromGuard()) {
            $data = UserDataHelper::getUserSharedData(true);
            if (!Session::has('applocale')) {
                $user_locale_from_settings = $data['user_settings']['locale']['value'];
                Session::put('applocale', $user_locale_from_settings);
            }
        }
        return $next($request);
    }
}