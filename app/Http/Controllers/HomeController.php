<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [

        ];
        return view('main.dashboard', $data);
    }

    /**
     * Show the Entering page
     *
     * @return \Illuminate\Http\Response
     */
    public function enter()
    {
        return view('auth.composite');
    }

    public function test()
    {
        $user = Auth::user();
        $id = $user->id;
        $settings = Setting::getUserTheme($id);
        echo '<pre>' . print_r($settings->toArray(), true) . '</pre>';
    }
}
