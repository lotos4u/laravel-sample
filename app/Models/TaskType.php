<?php

namespace App\Models;

class TaskType extends BasicTranslatable
{
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

}
