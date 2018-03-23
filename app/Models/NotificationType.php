<?php

namespace App\Models;

class NotificationType extends BasicTranslatable
{
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

//    public function toSearchableArray()
//    {
//        $array = $this->toArray();
//
//        return $array;
//    }
}
