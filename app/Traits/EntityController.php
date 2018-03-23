<?php

namespace App\Traits;

use App\Helpers\EntityHelper;
use App\Helpers\GeneralHelper;
use App\Helpers\UserDataHelper;
use App\Models\ActionFactory;
use App\Models\FilterFactory;
use App\Models\FormatterFactory;
use App\Models\FormFactory;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

trait EntityController
{
    /**
     * Name of model used for routes, translations etc
     * @var string
     */
    protected $modelName = '';

    public function show($id)
    {
        $config = $this->getEntityConfig();
        $fullClassName = $this->getEntityClassname($config);
        $model = $fullClassName::find($id)->toArray();
        $data = $this->combineDetailsViewDataForModel($this->modelName, $model);
        return view('entity.show', $data);
    }

    public function index()
    {
        $data = $this->combineAjaxListViewDataForModel($this->modelName);
        return view('entity.index', $data);
    }

    public function delete(Request $request, $id)
    {
        $config = $this->getEntityConfig();
        $fullClassName = $this->getEntityClassname($config);
        $model = $fullClassName::find($id);
//        $success = $model->delete();
        $success = true;
        $msg_key = $success ? 'messages.' . $this->modelName . '_deleted' : 'messages.' . $this->modelName . '_delete_error';
        $msg = __($msg_key, ['name' => $model->getEntityName()]);
        if ($request->ajax()) {
            return response()->json(['success' => $success, 'message' => $msg]);
        } else {
            GeneralHelper::addInfo($msg);
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $config = $this->getEntityConfig();
        $fullClassName = $this->getEntityClassname($config);
        $model = $fullClassName::find($id)->toArray();
        $data = $this->combineEditOrCreateViewDataForModel($this->modelName, $model);
        return view('entity.edit', $data);
    }

    public function new()
    {
        $data = $this->combineEditOrCreateViewDataForModel($this->modelName);
        return view('entity.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $model = $this->store($request, $id);
        $msg = __('messages.' . $this->modelName . '_updated', ['name' => $model->getEntityName()]);
        GeneralHelper::addInfo($msg);
        return back()->withInput();
    }

    public function create(Request $request)
    {
        $model = $this->store($request);
        $msg = __('messages.' . $this->modelName . '_created', ['name' => $model->getEntityName()]);
        GeneralHelper::addInfo($msg);
        return back()->withInput();
    }

    protected function getValidatingRules($id)
    {
        $config = $this->getEntityConfig();
        if (empty($config['edit']['validate'])) return null;
        $rules = $config['edit']['validate'];
        if ($id) {
            foreach ($rules as $key => $rule) {
                $rules[$key] = str_replace('?', $id, $rule);
            }
        }
        return $rules;
    }

    protected function updateMultiSelectFields($inputData)
    {
        $res = $inputData;
        $emptyFields = [];
        foreach ($res as $field => $value) {
            if (false !== mb_strpos($field, FormFactory::MULTI_SELECT_PRESENT_INDICATOR)) {
                if (!isset($res[$value])) {
                    $emptyFields[] = $value;
                }
                unset($res[$field]);
            }
        }
        foreach ($emptyFields as $field) {
            $res[$field] = [];
        }
        return $res;
    }

    protected function store(Request $request, $id = false)
    {
        $config = $this->getEntityConfig();
        $rules = $this->getValidatingRules($id);
        if ($rules) {
            $this->validate($request, $rules);
        }

        $fullClassName = $this->getEntityClassname($config);
        $model = null;
        if ($id) {
            $model = $fullClassName::find($id);
        } else {
            $model = new $fullClassName();
        }
        if (!$model) {
            throw new \Exception("Can't instantiate object for classname '$fullClassName' and ID=$id");
        }

        $inputs = $this->updateMultiSelectFields($request->all());
        $model->fill($inputs);
        if ($id) {
            $model->update();
        } else {
            $model->save();
        }

        foreach ($inputs as $inputName => $inputValue) {
            if (!$model->isFillable($inputName)) {
                $relationData = EntityHelper::getRelationForFormElementName($this->modelName, $inputName);
                if (is_array($relationData)) {
                    $model->saveRelated($inputs, $relationData);
                }
            }
        }
        return $model;
    }


    public function apiIndex(Request $request)
    {
        $modelsJson = $this->getEntityModelsJsonForRequest($request, $this->modelName);
        return $modelsJson;
    }

    public function apiShow($id)
    {
        $config = $this->getEntityConfig();
        $fullClassName = $this->getEntityClassname($config);
        return $fullClassName::find($id)->toJson();
    }


    protected function getEntityConfig($modelName = null): array
    {
        $modelName = $modelName ? $modelName : $this->modelName;
        $entity = config('entity.' . $modelName);
        return $entity;
    }

    protected function getEntityClassname(array $entity_data)
    {
        return EntityHelper::getEntityClassName($entity_data);
    }

    protected function getRowsPerPage()
    {
        $userData = UserDataHelper::getUserSharedData();
        if ($userData && isset($userData['user_settings'])) {
            return $userData['user_settings']['rows_per_page']['value'];
        }
        return config('system.rows_per_page');
    }

    protected function combineRelatedData($entity_id)
    {
        $config = $this->getEntityConfig();
        $related_data = [];
        if (!empty($config['related'])) {
            foreach ($config['related'] as $name => $related) {
                $related_data[] = [
                    'model_name' => $name,
                    'api_url' => route($related['route_name'], $entity_id),
                ];
            }
        }
        $related_data = count($related_data) > 0 ? $related_data : null;
        return $related_data;
    }

    protected function combineDetailsViewDataForModel($modelName, $modelObject)
    {
        $relatedCollections = $this->combineRelatedData($modelObject['id']);
        $entity = config('entity.' . $modelName);
        $fields = array_keys($entity['fields']);
        $details = $entity['details'];
        $title_data = $details['title_data'];
        $subtitle_data = $details['subtitle_data'];
        $title = $title_data['field'] ? $modelObject[$title_data['field']] : ($title_data['key'] ? __($modelName . '.' . $title_data['key']) : '');
        $subtitle = $subtitle_data['field'] ? $modelObject[$subtitle_data['field']] : ($subtitle_data['key'] ? __($modelName . '.' . $subtitle_data['key']) : '');
        if (!empty($details['actions']) && is_array($details['actions'])) {
            $actions = ActionFactory::getActions($modelName, $details['actions'], $modelObject);
        }

        $block_elements = [];
        foreach ($details['elements_data'] as $element) {
            $block_elements[] = [
                'title' => __($modelName . '.' . $element['key']),
                'content' => $modelObject[$element['field']],
            ];
        }

        $data = [
            'model' => $modelObject,
            'model_name' => $modelName,
            'block_elements' => $block_elements,
            'block_title' => $title,
            'block_subtitle' => $subtitle,
            'block_actions' => $actions,
            'fields' => $fields,
            'tab_icon' => $entity['icon'],
            'tab_title_main' => __($modelName . '.title_tab_main'),
            'tab_title_related' => __($modelName . '.title_tab_related'),
        ];

        if ($relatedCollections) {
            $block_related_lists = [];
            $grid_ids = [];
            foreach ($relatedCollections as $collection) {
                $related_name = $collection['model_name'];
                $related_url = $collection['api_url'];
                $collection_data = $this->combineAjaxListViewDataForModel($related_name, $related_url);
                unset($collection_data['list_title']);
                unset($collection_data['list_subtitle']);
                $block_related_lists[] = $collection_data;
                $grid_ids[$collection_data['grid_id']] = [
                    'api_token' => $collection_data['api_token'],
                ];
            }
            $data['block_related_lists'] = $block_related_lists;
            $data['grid_ids'] = $grid_ids;
        }
        return $data;
    }

    protected function combineEditOrCreateViewDataForModel($modelName, $modelObject = null)
    {
        $createView = !$modelObject;
        $entity = config('entity.' . $modelName);
        $fields = array_keys($entity['fields']);
        $details = $entity['edit'];
        $title_data = $details['title_data'];
        $subtitle_data = $details['subtitle_data'];
        if ($createView) {
            $title = $title_data['key'] ? __($modelName . '.' . $title_data['key']) : 'Create';
            $subtitle = $subtitle_data['key'] ? __($modelName . '.' . $subtitle_data['key']) : '';
        } else {
            $title = $title_data['field'] ? $modelObject[$title_data['field']] : ($title_data['key'] ? __($modelName . '.' . $title_data['key']) : 'Create');
            $subtitle = $subtitle_data['field'] ? $modelObject[$subtitle_data['field']] : ($subtitle_data['key'] ? __($modelName . '.' . $subtitle_data['key']) : '');
        }
        $actions = false;
        if (!empty($details['actions']) && is_array($details['actions'])) {
            $actions = ActionFactory::getActions($modelName, $details['actions']);
        }

        $block_elements = [];
        foreach ($details['elements_data'] as $element) {
            $multiple = empty($element['multiple']) ? false : $element['multiple'];
            $type = empty($element['type']) ? 'text' : $element['type'];
            $class = empty($element['class']) ? false : $element['class'];
            $elementName = $element['form_element_name'];
            $fieldValue = isset($element['field_value']) ? $element['field_value'] : false;
            $values = null;
            if ($multiple) {
                $options = $element['options'];
                $relation = $options['relation'];
                $relation = $entity['related'][$relation]['method_get'];
                if (!isset($modelObject[$relation])) {
                    $className = $this->getEntityClassname($entity);
                    $modelObject[$relation] = $className::getModelRelatedArrays($modelName, $modelObject['id'], $relation);
                }
                $value = EntityHelper::getSelectedRelations($modelObject, $relation);
            } else {
                $value = $createView ? null : $modelObject[$fieldValue];
            }

            $attributes = [];
            if ($class) {
                $attributes['class'] = $class;
            }
            if ($type === 'text') {

            } elseif ($type === 'select') {
                $values = EntityHelper::getSelectValues($element['model']);
                if ($multiple) {
                    $attributes['multiple'] = $multiple;
                    if (!$class) {
                        $attributes['class'] = FormFactory::MULTI_SELECT_CLASS;
                    }
                }
            }
            $block_elements[] = [
                'title' => FormFactory::getLabel($elementName, __($modelName . '.' . $element['key'])),
                'content' => FormFactory::getInput($elementName, $type, $value, $values, $attributes),
            ];
        };
        $data = [
            'model' => $modelObject,
            'model_name' => $modelName,
            'block_elements' => $block_elements,
            'block_title' => $title,
            'block_subtitle' => $subtitle,
            'block_actions' => $actions,
            'fields' => $fields,
            'tab_icon' => $entity['icon'],
            'tab_title_main' => __($modelName . '.title_tab_main'),
            'tab_title_related' => __($modelName . '.title_tab_related'),
        ];

        return $data;
    }

    protected function combineAjaxListViewDataForModel($modelName, $api_url = false)
    {
        $entity = config('entity.' . $modelName);
        $listData = $entity['list'];
        $gridsData = $listData['columns_data'];
        $titles = [];
        foreach ($gridsData as $title) {
            $title['settings'] = '';
            if (empty($title['grid_config'])) {
                throw new \Exception(__('errors.exception_no_grid_config', ['class' => $modelName]));
            }
            foreach ($title['grid_config'] as $param_name => $param) {
                if (!is_array($param)) {
                    $title['settings'] .= " data-$param_name='$param' ";
                }
            }
            unset($title['grid_config']);
            if ($title['title_key']) {
                $title['title'] = __($modelName . '.' . $title['title_key']);
            } else {
                $title['title'] = '';
            }
            unset($title['title_key']);
            $titles[] = $title;
        }

        $actions = false;
        if (!empty($listData['actions']) && is_array($listData['actions'])) {
            $actions = ActionFactory::getActions($modelName, $listData['actions'], null);
        }

        $user_data = Session::get(config('settings.key'));
        $api_url = $api_url ? $api_url : config('app.url') . '/' . config('api.internal.url_prefix') . '/' . config('api.internal.urls.' . $modelName);
        $api_token = $user_data['api_token'];
        $data = [
            'list_title' => __($modelName . '.title_index'),
            'list_subtitle' => __($modelName . '.subtitle_index'),
            'block_actions' => $actions,
            'api_url' => $api_url,
            'api_token' => $api_token,
            'grid_ids' => ['listview_grid_' . $modelName => ['api_token' => $api_token, 'api_url' => $api_url]],
            'grid_id' => 'listview_grid_' . $modelName,
            'titles' => $titles,
            'tab_icon' => $entity['icon'],
            'tab_title_main' => __($modelName . '.title_tab_main'),
            'tab_title_related' => __($modelName . '.title_tab_related'),
        ];
        return $data;
    }

    protected function getEntityModelsJsonForRequest(Request $request, string $modelName, $queryData = null)
    {
        $queryScope = $queryData ? $queryData['scope'] : 'internalApi';
        $config = $this->getEntityConfig($modelName);
        $input = $request->input();
        $rowsPerPage = $this->getRowsPerPage();
        $gridId = empty($input['grid_id']) ? false : $input['grid_id'];
        $current_page = empty($input['current']) ? 1 : $input['current'];
        $rowCount = empty($input['rowCount']) ? $rowsPerPage : $input['rowCount'];
        $searchPhrase = empty($input['searchPhrase']) ? false : $input['searchPhrase'];
        $searchObject = empty($input['search']) ? false : $input['search'];
        $fullClassName = $this->getEntityClassname($config);
        $sortColumn = 'id';
        $sortDirection = 'asc';
        if (!empty($input['sort']) && is_array($input['sort'])) {
            $columns = array_keys($input['sort']);
            $directions = array_values($input['sort']);
            $sortColumn = $columns[0];
            $sortDirection = $directions[0];
        }
        $columns = EntityHelper::getEntityColumns($config);
        $sortColumn = $columns[$sortColumn];

        Paginator::currentPageResolver(function () use ($current_page) {
            return $current_page;
        });

        $query = $queryData ? $fullClassName::$queryScope($queryData['data']) : $fullClassName::$queryScope();
        if ($searchObject) {
            $query = $query->search($searchObject);
        } elseif ($searchPhrase) {
            $query = $query->search($searchPhrase);
        }

        if ($rowCount > 0) {
            $models = $query->orderBy($sortColumn, $sortDirection)->paginate($rowCount);
        } else {
            $models = $models = $query->orderBy($sortColumn, $sortDirection);
            $models = $models->paginate($models->count());
        }
        $modelsJson = $this->converModelsToGridJson($modelName, $models, $gridId);
        return $modelsJson;
    }

    protected function converModelsToGridJson(string $modelName, LengthAwarePaginator $collection, $gridId)
    {
        $modelsArray = $collection->toArray();
        $listConfig = config("entity.$modelName.list");
        $gridConfig = $listConfig['columns_data'];
        $data = [];
        foreach ($modelsArray['data'] as $modelObject) {
            $gridObject = [];
            foreach ($gridConfig as $columnKey => $columnConfig) {
                $actionsPosition = isset($columnConfig['actions_position']) ? $columnConfig['actions_position'] : 'only';
                $gridColumnConfig = $columnConfig['grid_config'];
                if ($gridColumnConfig['visible']) {
                    $cellText = '';
                    $actions = false;
                    if (isset($columnConfig['actions']) && is_array($columnConfig['actions'])) {
                        $actions = ActionFactory::getActions($modelName, $columnConfig['actions'], $modelObject);
                        $actions = implode($actions);
                    }
                    if (isset($modelObject[$gridColumnConfig['column-id']])) {
                        $cellText = $modelObject[$gridColumnConfig['column-id']];
                        if (isset($columnConfig['template'])) {
                            $cellText = FormatterFactory::getFormattedText($cellText, $columnConfig['template']);
                        }
                    }
                    if ($actions) {
                        switch ($actionsPosition) {
                            case 'after': // Actions after content
                                $html = $cellText . $actions;
                                break;
                            case 'before': // Actions before content
                                $html = $actions . $cellText;
                                break;
                            default:
                                $html = $actions; // only Actions without content
                        }
                    } else {
                        $html = $cellText;
                    }
                    $gridObject[$columnKey] = $html;
                }
            }
            $data[] = $gridObject;
        }

        $filters = FilterFactory::getFiltersForEntity($modelName, $gridId);

        $dataArray = ["current" => $modelsArray['current_page'],
            'rows' => $data,
            'rowCount' => $modelsArray['per_page'],
            'total' => $modelsArray['total'],
        ];
        if (is_array($filters) && count($filters) > 0) {
            $dataArray['filters'] = $filters;
        }
        $modelsJson = json_encode($dataArray);
        return $modelsJson;
    }
}