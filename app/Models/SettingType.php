<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SettingType extends BasicTranslatable
{
    protected $fillable = [
        'name',
        'default',
    ];

    public function variants()
    {
        return $this->hasMany('App\Models\SettingVariant', 'type_id');
    }

    public function settings()
    {
        return $this->hasMany('App\Models\Setting', 'type_id');
    }
}
