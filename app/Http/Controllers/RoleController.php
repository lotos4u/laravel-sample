<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Traits\EntityController;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'role';
    }

    public function show($id)
    {
        $role = Role::find($id);
        $data = $this->combineDetailsViewDataForModel($this->modelName, $role->toArray());
        return view('entity.show', $data);
    }

    public function apiPermissions(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiRolePermissions',
            'data' => ['role_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'permission', $relation_data);
        return $modelsJson;
    }
}
