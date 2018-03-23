<?php

namespace App\Http\Controllers;

use App\Models\SettingType;
use App\Models\SettingVariant;
use Illuminate\Http\Request;
use App\Traits\EntityController;

class SettingTypeController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'setting_type';
    }

    public function show($id)
    {
        $model = SettingType::find($id);
        $data = $this->combineDetailsViewDataForModel($this->modelName, $model->toArray());
        return view('entity.show', $data);
    }

    public function apiSettings(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiSettingTypeSettings',
            'data' => ['type_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'setting', $relation_data);
        return $modelsJson;
    }

    public function apiSettingVariants(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiSettingTypeSettingVariants',
            'data' => ['type_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'setting_variant', $relation_data);
        return $modelsJson;
    }
}
