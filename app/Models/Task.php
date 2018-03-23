<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\TypeScope;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class Task extends BasicModel
{
    protected $fillable = [
        'type_id',
        'user_id',
        'name',
        'data',
    ];

    protected $appends = [
        'type_name',
        'user_name'
    ];

//    protected $with = [
//        'type',
//        'user',
//    ];


    public function type()
    {
        return $this->belongsTo('App\Models\TaskType', 'type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function logs()
    {
        return $this->hasMany('App\Models\TaskLog');
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope());
        static::addGlobalScope(new TypeScope());
    }

    public function getTypeNameAttribute()
    {
        return $this->attributes['type_name'] = $this->type->display_name;
    }

    public function getUserNameAttribute()
    {
        return $this->attributes['user_name'] = $this->user->name;
    }

    public static function getUserTasks($user_id = false)
    {
        if (!$user_id) {
            $current_user = User::getUserFromGuard();
            $user_id = $current_user ? $current_user->id : false;
        }
        if (!$user_id) {
            throw new \Exception('No user for getting tasks!');
        }
        $tasks = Task::
            leftJoin("users", "tasks.user_id", "=", "users.id")
            ->leftJoin("task_types", "tasks.type_id", "=", "task_types.id")
            ->leftJoin("task_type_translations", "task_types.id", "=", "task_type_translations.task_type_id")
            ->select("tasks.*", "task_types.id as type_id", "task_type_translations.display_name as type_name", "users.id as user_id", "users.name as user_name")
            ->where("user_id", "=", $user_id)
            ->where("task_type_translations.locale", "=", App::getLocale())
            ->get()
        ;
        return $tasks;
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $plural = $config['plural'];
        $fixed = $query
            ->leftJoin("users", "{$plural}.user_id", "=", "users.id")
            ->leftJoin("task_types", "{$plural}.type_id", "=", "task_types.id")
            ->leftJoin("task_type_translations", "task_types.id", "=", "task_type_translations.task_type_id")
            ->select("{$plural}.*", "task_types.id as type_id", "task_type_translations.display_name as type_name", "users.id as user_id", "users.name as user_name")
            ->where("task_type_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function scopeInternalApiUserTasks(Builder $query, $relationData = null)
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
            ->leftJoin("task_types", "{$plural}.type_id", "=", "task_types.id")
            ->leftJoin("task_type_translations", "task_types.id", "=", "task_type_translations.task_type_id")
            ->select("{$plural}.*", "task_types.id as type_id", "task_type_translations.display_name as type_name", "users.id as user_id", "users.name as user_name")
            ->where("user_id", "=", $user_id)
            ->where("task_type_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }

    public function scopeInternalApiTaskTypeTasks(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $single = $entity_key;
        $plural = $config['plural'];
        if (!$relationData || empty($relationData['type_id'])) {
            throw new \Exception(__('errors.exception_no_related_task_type_data'));
        }
        $type_id = $relationData['type_id'];
        $fixed = $query
            ->leftJoin("users", "{$plural}.user_id", "=", "users.id")
            ->leftJoin("task_types", "{$plural}.type_id", "=", "task_types.id")
            ->leftJoin("task_type_translations", "task_types.id", "=", "task_type_translations.task_type_id")
            ->select("{$plural}.*", "task_types.id as type_id", "task_type_translations.display_name as type_name", "users.id as user_id", "users.name as user_name")
            ->where("type_id", "=", $type_id)
            ->where("task_type_translations.locale", "=", App::getLocale())
        ;
        return $fixed;
    }
}
