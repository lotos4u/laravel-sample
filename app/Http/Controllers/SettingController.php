<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\EntityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'setting';
    }

    public function theme(Request $request)
    {
        $name = $request->input('theme_name');
        $theme = Setting::getUserTheme();
        $theme->value = $name;
        $theme->save();
        GeneralHelper::addInfo(__('messages.theme_changed'));
        return back()->withInput();
    }
}
