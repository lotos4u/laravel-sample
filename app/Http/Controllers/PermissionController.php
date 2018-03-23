<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\EntityController;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'permission';
    }

    public function apiRoles(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiPermissionRoles',
            'data' => ['permission_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'role', $relation_data);
        return $modelsJson;
    }
}
