<?php

namespace App\Http\Controllers;

use App\Models\TaskType;
use Illuminate\Http\Request;
use App\Traits\EntityController;

class TaskTypeController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'task_type';
    }

    public function apiTasks(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiTaskTypeTasks',
            'data' => ['type_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'task', $relation_data);
        return $modelsJson;
    }
}