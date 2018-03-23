<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\TypeScope;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Setting extends BasicModel
{
    public $type_name;
    public $user_name;
    protected $fillable = [
        'type_id',
        'user_id',
        'value',
    ];

    protected $appends = [
        'type_name',
        'user_name',
    ];
//
//    protected $hidden = [
//        'type_name',
//        'user_name',
//    ];

//    protected $with = [
//        'type',
//        'user'
//    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\SettingType', 'type_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TypeScope());
        static::addGlobalScope(new UserScope());
    }

    public static function getUserTheme($user_id = false)
    {
        if (!$user_id) {
            $current_user = Auth::user();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting settings!');
        }
        $setting = Setting::
        withoutGlobalScopes([TypeScope::class, UserScope::class])
            ->leftJoin('setting_types', 'settings.type_id', '=', 'setting_types.id')
            ->select('settings.*')
            ->where('settings.user_id', '=', $user_id)
            ->where('setting_types.name', '=', 'theme_name')
            ->first()
        ;
        return $setting;
    }

    public static function getUserSettings($user_id = false)
    {
        if (!$user_id) {
            $current_user = User::getUserFromGuard();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting settings!');
        }
        $settings = Setting::leftJoin('setting_types', 'settings.type_id', '=', 'setting_types.id')
            ->select('settings.value', 'settings.user_id', 'setting_types.default', 'setting_types.name', 'settings.type_id', 'setting_types.id')
            ->where('user_id', $user_id)
            ->get()
            ;
        return $settings;
    }

    public function scopeWithType($query)
    {
        return $query
            ->withoutGlobalScopes([TypeScope::class])
            ->leftJoin('setting_types', 'settings.type_id', '=', 'setting_types.id')
            ->select('settings.*', 'setting_types.name as type_name', 'setting_types.display_name as type_display_name')
            ;
    }

    public function scopeForUserAndType($query, $user_id, $type_name)
    {
        return $query
            ->leftJoin('setting_types', 'settings.type_id', '=', 'setting_types.id')
            ->select('settings.*', 'setting_types.name as type_name')
//            ->select('setting_types.display_name as type_display_name')
            ->where('settings.user_id', '=', $user_id)
            ->where('setting_types.name', '=', $type_name)
            ;
    }

    public function getTypeNameAttribute()
    {
        return $this->attributes['type_name'] = $this->type->display_name;
    }

    public function getUserNameAttribute()
    {
        return $this->attributes['user_name'] = $this->user->name;
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        $fixed = $query
            ->leftJoin("users", "{$plural}.user_id", "=", "users.id")
            ->leftJoin("setting_types", "{$plural}.type_id", "=", "setting_types.id")
            ->leftJoin("setting_type_translations", "setting_types.id", "=", "setting_type_translations.setting_type_id")
            ->select("{$plural}.*", "setting_types.id as type_id", "setting_type_translations.display_name as type_name", "users.id as user_id", "users.name as user_name")
            ->where("setting_type_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function scopeInternalApiUserSettings(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['user_id'])) {
            throw new \Exception(__('errors.exception_no_related_user_data'));
        }
        $user_id = $relationData['user_id'];
        $fixed = $query
            ->leftJoin("users", "{$plural}.user_id", "=", "users.id")
            ->leftJoin("setting_types", "{$plural}.type_id", "=", "setting_types.id")
            ->leftJoin("setting_type_translations", "setting_types.id", "=", "setting_type_translations.setting_type_id")
            ->select("{$plural}.*", "setting_types.id as type_id", "setting_type_translations.display_name as type_name", "users.id as user_id", "users.name as user_name")
            ->where("user_id", "=", $user_id)
            ->where("setting_type_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function scopeInternalApiSettingTypeSettings(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['type_id'])) {
            throw new \Exception(__('errors.exception_no_related_setting_type_data'));
        }
        $type_id = $relationData['type_id'];
        $fixed = $query
            ->leftJoin("users", "{$plural}.user_id", "=", "users.id")
            ->leftJoin("setting_types", "{$plural}.type_id", "=", "setting_types.id")
            ->leftJoin("setting_type_translations", "setting_types.id", "=", "setting_type_translations.setting_type_id")
            ->select("{$plural}.*", "setting_types.id as type_id", "setting_type_translations.display_name as type_name", "users.id as user_id", "users.name as user_name")
            ->where("type_id", "=", $type_id)
            ->where("setting_type_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }
}
