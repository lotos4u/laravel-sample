<?php

namespace App\Models;

class UserStatus extends BasicTranslatable
{
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

//    public function toSearchableArray()
//    {
//        $array = $this->toArray();
//
//        return $array;
//    }
}
