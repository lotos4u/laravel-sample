<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use App\Scopes\TaskScope;
use Illuminate\Database\Eloquent\Builder;

class TaskLog extends BasicModel
{
    protected $fillable = [
        'task_id',
        'data',
    ];

    protected $appends = [
        'task_name',
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TaskScope());
    }

    public function getTaskNameAttribute()
    {
        return $this->attributes['task_name'] = $this->task->name;
    }

    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $fixed = $query
            ->leftJoin("tasks", "task_logs.task_id", "=", "tasks.id")
            ->select("task_logs.*", "tasks.id as tasks_task_id", "tasks.name as task_name")
        ;
        return $fixed;
    }


    public function scopeInternalApiTaskLogs(Builder $query, $relationData = null)
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        if (!$relationData || empty($relationData['task_id'])) {
            throw new \Exception(__('errors.exception_no_related_task_data'));
        }
        $task_id = $relationData['task_id'];
        return $query
            ->leftJoin("tasks", "task_logs.task_id", "=", "tasks.id")
            ->select("task_logs.*", "tasks.id as tasks_task_id", "tasks.name as task_name")
            ->where('task_logs.task_id', $task_id)
        ;
    }

}
