<?php

namespace App\Http\Controllers;

use App\Traits\EntityController;

class TaskLogController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'task_log';
    }

}