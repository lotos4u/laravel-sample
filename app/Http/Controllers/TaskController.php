<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Traits\EntityController;

class TaskController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'task';
    }

    public function apiLogs(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiTaskLogs',
            'data' => ['task_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'task_log', $relation_data);
        return $modelsJson;
    }
}