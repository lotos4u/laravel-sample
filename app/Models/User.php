<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\RolesScope;
use App\Scopes\StatusScope;
use App\Scopes\TasksScope;
use App\Traits\EntityModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use EntityModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'status_name',
    ];

    public $image = 'lib/images/user.png';

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    public function settings()
    {
        return $this->hasMany('App\Models\Setting');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'sender_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\UserStatus');
    }

    public function scopeApi($query)
    {
        return $query
            ->withoutGlobalScopes([StatusScope::class])
            ->select('users.*')
//            ->leftJoin('setting_types', 'settings.type_id', '=', 'setting_types.id')
//            ->select('settings.*', 'setting_types.name as type_name', 'setting_types.display_name as type_display_name')
            ;
    }

    public static function getSystemUser()
    {
        $user = User::where('name', '=', 'system')->first();
        return $user;
    }

    public static function getUserFromGuard($guard = null)
    {
        $guards = [$guard];
        if (!$guard) {
            $guards = ['web', 'api'];
        }
        foreach ($guards as $g) {
            $user = Auth::guard($g)->user();
            if ($user) {
                return $user;
            }
        }
        return null;
    }

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StatusScope());
//        static::addGlobalScope(new RolesScope());
//        static::addGlobalScope(new SettingsScope());
//        static::addGlobalScope(new TasksScope());
//        static::addGlobalScope(new NotificationsScope());
    }

    public function getStatusNameAttribute()
    {
        return $this->attributes['status_name'] = $this->status->display_name;
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $plural = $config['plural'];
        $fixed = $query
            ->leftJoin("user_statuses", "{$plural}.status_id", "=", "user_statuses.id")
            ->leftJoin("user_status_translations", "user_statuses.id", "=", "user_status_translations.user_status_id")
            ->select(
                "{$plural}.*",
                "user_statuses.id as user_statuses_id",
                "user_status_translations.display_name as user_status_name"
            )
            ->where("user_status_translations.locale", "=", App::getLocale());
        return $fixed;
    }

    public function scopeInternalApiNotificationReceivers(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['notification_id'])) {
            throw new \Exception(__('errors.exception_no_related_notification_data'));
        }
        $notification_id = $relationData['notification_id'];
        $fixed = $query
//            ->leftJoin("users", "{$plural}.user_id", "=", "users.id")
            ->leftJoin("notification_user", "users.id", "=", "notification_user.user_id")
//            ->leftJoin("setting_type_translations", "setting_types.id", "=", "setting_type_translations.setting_type_id")
            ->select("users.*", "notification_user.notification_id", "notification_user.user_id")
            ->where("notification_user.notification_id", "=", $notification_id)//            ->where("setting_type_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function scopeInternalApiUserStatusUsers(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        if (!$relationData || empty($relationData['user_status_id'])) {
            throw new \Exception(__('errors.exception_no_related_user_status_data'));
        }
        $user_status_id = $relationData['user_status_id'];
        $fixed = $query
//            ->leftJoin("users", "{$plural}.user_id", "=", "users.id")
            ->select("users.*")
            ->where("users.status_id", "=", $user_status_id)//            ->where("user_status_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function setUserRoles(array $relationData)
    {
        $this->roles()->sync($relationData);
    }
}
