<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Switch locale and redirect back
     *
     * @return \Illuminate\Http\Response
     */
    public function locale($locale)
    {
        if (array_key_exists($locale, config('app.locales'))) {
            Session::put('applocale', $locale);
        }
        return Redirect::back();
    }
}
