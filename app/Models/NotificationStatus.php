<?php

namespace App\Models;

class NotificationStatus extends BasicTranslatable
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
