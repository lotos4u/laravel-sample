<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Traits\EntityController;

class UserStatusController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'user_status';
    }

    public function apiUsers(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiUserStatusUsers',
            'data' => ['user_status_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'user', $relation_data);
        return $modelsJson;
    }
}