<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\SenderScope;
use App\Scopes\StatusScope;
use App\Scopes\TypeScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Notification extends BasicModel
{
    public $type_name;
    public $status_name;
    public $sender_name;

    protected $fillable = [
        'subject',
        'text',
        'type_id',
        'sender_id',
    ];

    protected $appends = [
        'type_name',
        'sender_name'
    ];

//    protected $with = [
//        'type',
//        'status',
//        'sender'
//    ];

    public function type()
    {
        return $this->belongsTo('App\Models\NotificationType');
    }

    public function sender()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function receivers()
    {
        return $this->belongsToMany('App\Models\User', 'notification_user', 'notification_id', 'user_id');
    }

    public static function boot()
    {
        parent::boot();
        self::addScopes([TypeScope::class, SenderScope::class]);
    }

//    public function getStatusNameAttribute()
//    {
//        return $this->attributes['status_name'] = $this->status->display_name;
//    }

    public function getTypeNameAttribute()
    {
        return $this->attributes['type_name'] = $this->type->display_name;
    }

    public function getSenderNameAttribute()
    {
        return $this->attributes['sender_name'] = $this->sender->name;
    }

    public static function getUserReceivedNotifications($user_id = false)
    {
        if (!$user_id) {
            $current_user = User::getUserFromGuard();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting notofications!');
        }
        $notifications = Notification::select('notifications.*', "notification_user.notification_id", "notification_user.user_id")
            ->leftJoin("notification_user", "notifications.id", "=", "notification_user.notification_id")
            ->where('notification_user.user_id', $user_id)
            ->get();
        return $notifications;
    }

    public static function getUserReceivedUnreadNotifications($user_id = false)
    {
        if (!$user_id) {
            $current_user = User::getUserFromGuard();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting notifications!');
        }
        $notifications = Notification::select('notifications.*', "notification_user.notification_id", "notification_user.user_id", 'notification_user.status_id', 'notification_statuses.name')
            ->leftJoin("notification_user", "notifications.id", "=", "notification_user.notification_id")
            ->leftJoin("notification_statuses", "notification_statuses.id", "=", "notification_user.status_id")
            ->where('notification_user.user_id', $user_id)
            ->where('notification_statuses.name', '<>', 'received')
            ->get();
        return $notifications;
    }


    public static function getUserSentNotifications($user_id = false)
    {
        if (!$user_id) {
            $current_user = User::getUserFromGuard();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting notofications!');
        }
        $notifications = Notification::select('notifications.*')
            ->where('notifications.sender_id', $user_id)
            ->get();
        return $notifications;
    }

    public static function getUserNotifications($user_id = false)
    {
        if (!$user_id) {
            $current_user = User::getUserFromGuard();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting notofications!');
        }
        $notifications = Notification::select('notifications.*', "notification_user.notification_id", "notification_user.user_id")
            ->leftJoin("notification_user", "notifications.id", "=", "notification_user.notification_id")
            ->where('notifications.sender_id', $user_id)
            ->orWhere('notification_user.user_id', $user_id)
            ->get();
        return $notifications;
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $plural = $config['plural'];
        $fixed = $query
//            ->leftJoin("notification_statuses", "{$plural}.status_id", "=", "notification_statuses.id")
//            ->leftJoin("notification_status_translations", "notification_statuses.id", "=", "notification_status_translations.notification_status_id")
            ->leftJoin("users", "{$plural}.sender_id", "=", "users.id")
            ->leftJoin("notification_types", "{$plural}.type_id", "=", "notification_types.id")
            ->leftJoin("notification_type_translations", "notification_types.id", "=", "notification_type_translations.notification_type_id")
            ->select(
                "{$plural}.*",
//                "notification_statuses.id as notification_statuses_id",
//                "notification_status_translations.display_name as status_name",
                "users.name as sender_name",
                "notification_type_translations.display_name as type_name"
            )
            ->where("notification_type_translations.locale", "=", App::getLocale())//            ->where("notification_status_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function scopeInternalApiNotificationTypeNotifications($query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['type_id'])) {
            throw new \Exception(__('errors.exception_no_related_notification_type_data'));
        }
        $type_id = $relationData['type_id'];
        $fixed = $query
            ->leftJoin("notification_statuses", "{$plural}.status_id", "=", "notification_statuses.id")
            ->leftJoin("notification_status_translations", "notification_statuses.id", "=", "notification_status_translations.notification_status_id")
            ->leftJoin("users", "{$plural}.sender_id", "=", "users.id")
            ->leftJoin("notification_types", "{$plural}.type_id", "=", "notification_types.id")
            ->leftJoin("notification_type_translations", "notification_types.id", "=", "notification_type_translations.notification_type_id")
            ->select(
                "{$plural}.*",
                "notification_statuses.id as notification_statuses_id",
                "notification_status_translations.display_name as status_name",
                "users.name as sender_name",
                "notification_type_translations.display_name as type_name"
            )
            ->where("type_id", "=", $type_id)
            ->where("notification_type_translations.locale", "=", App::getLocale())
            ->where("notification_status_translations.locale", "=", App::getLocale());
        return $fixed;
    }

    public function scopeInternalApiUserNotifications($query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['user_id'])) {
            throw new \Exception(__('errors.exception_no_related_user_data'));
        }
        $user_id = $relationData['user_id'];
        $fixed = $query
//            ->leftJoin("notification_statuses", "{$plural}.status_id", "=", "notification_statuses.id")
//            ->leftJoin("notification_status_translations", "notification_statuses.id", "=", "notification_status_translations.notification_status_id")
            ->leftJoin("users", "notifications.sender_id", "=", "users.id")
            ->leftJoin("notification_user", "notifications.id", "=", "notification_user.notification_id")
            ->leftJoin("notification_types", "notifications.type_id", "=", "notification_types.id")
            ->leftJoin("notification_type_translations", "notification_types.id", "=", "notification_type_translations.notification_type_id")
            ->select(
                "notifications.*",
//                "notification_statuses.id as notification_statuses_id",
//                "notification_status_translations.display_name as status_name",
                "users.name as sender_name",
                "users.id as sender_id",
                "notification_type_translations.display_name as type_name"
            )
            ->where(function ($query) use ($user_id) {
                $query->where("notifications.sender_id", "=", $user_id)->orWhere("notification_user.user_id", "=", $user_id);
            })
//            ->where("sender_id", "=", $user_id)
            ->where("notification_type_translations.locale", "=", App::getLocale())//            ->where("notification_status_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function setNotificationReceivers(array $relationData)
    {
        $id = $this->id;
        $data = [];
        foreach ($relationData as $user_id) {
            $record = DB::table('notification_user')
                ->where('notification_id', $id)
                ->where('user_id', $user_id)
                ->first();
            if ($record) {
                $status_id = $record->status_id; // save status for old record
            } else {
                $status_id = 1; // Created status for new record
            }
            $data[] = ['user_id' => $user_id, 'notification_id' => $this->id, 'status_id' => $status_id];
        }
        DB::table('notification_user')->where('notification_id', $id)->delete();
        return DB::table('notification_user')->insert($data);
    }
}
