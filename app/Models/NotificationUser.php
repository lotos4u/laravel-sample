<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $table = 'notification_user';


    public function status()
    {
        return $this->belongsTo('App\Models\NotificationStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function notification()
    {
        return $this->belongsTo('App\Models\Notification');
    }

}
