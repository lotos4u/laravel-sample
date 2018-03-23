<?php

namespace App\Http\Controllers;

use App\Models\SettingType;
use Illuminate\Http\Request;
use App\Traits\EntityController;

class SettingVariantController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'setting_variant';
    }
}
