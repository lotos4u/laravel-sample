<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Locale
{
    public function handle($request, Closure $next)
    {
        if (Session::has('applocale') && array_key_exists(Session::get('applocale'), config('app.locales'))) {
            App::setLocale(Session::get('applocale'));

        } elseif (Auth::user()) { // This is optional as Laravel will automatically set the fallback language if there is none specified
//            echo "<br>ID=" . Auth::user()->id . "<br>";die;
        } else {
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}