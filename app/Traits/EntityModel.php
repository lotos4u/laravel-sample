<?php

namespace App\Traits;

use App\Helpers\EntityHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

trait EntityModel
{
    protected $scopeClasses = [];


    public function saveRelated(array $modelData, array $relationConfig)
    {
        $setRelation = $relationConfig['method_set'];
        if (method_exists($this, $setRelation)) {
            $relationData = $modelData[$relationConfig['form_element_name']];
            $this->$setRelation($relationData);
        } else {
            throw new \Exception("Method '$setRelation' doesn't exist in " . get_class($this));
        }
    }

    public static function getModelRelatedArrays($modelName, $modelId, $relation)
    {
        $config = config("entity.{$modelName}");
        $className = EntityHelper::getEntityClassName($config);
        $user = $className::find($modelId);
        $relationObjects = $user->$relation;
        $res = [];
        foreach ($relationObjects as $object) {
            $res[] = $object->toArray();
        }
        return $res;
    }

    public function getEntityName()
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $fieldName = EntityHelper::getEntityDisplayField($config);
        return $this->$fieldName;
    }

    protected function getSearchableFields()
    {
        $entity_key = EntityHelper::getConfigKeyForInstance($this);
        $config = config("entity.{$entity_key}");
        $search = EntityHelper::getEntitySearchColumns($config);
        return $search;
    }

    protected function getLocale()
    {
        if (Session::has('user_shared_data')) {
            return Session::get('user_shared_data')['user_locale'];
        }
        return config('app.fallback_locale');
    }

    protected function dontSearch($column, $phrase)
    {
        $dont = ['created_at', 'updated_at'];
        foreach ($dont as $slug) {
            if (mb_strpos($column, $slug) !== false && !is_numeric($phrase)) {
                return true;
            }
        }
    }

    public function scopeSearch($query, $phrase)
    {
        $queryWithSearch = $query;
        if (is_array($phrase)) {
            $entityColumns = $this->getSearchableFields();
            foreach ($entityColumns as $entityColumnKey => $entityDbColumn) {
                foreach ($phrase as $searchColumn => $searchPhrase) {
                    if (($searchColumn === $entityColumnKey) && !$this->dontSearch($entityDbColumn, $phrase)) {
                        $queryWithSearch = $queryWithSearch->where($entityDbColumn, 'like', "%$searchPhrase%");
                    }
                }
            }
        } else {
            $entityColumns = $this->getSearchableFields();
            $field_counter = 0;
            foreach ($entityColumns as $entityColumnKey => $entityDbColumn) {
                if ($this->dontSearch($entityDbColumn, $phrase)) {
                    continue;
                }
                if (0 === $field_counter) {
                    $queryWithSearch = $queryWithSearch->where($entityDbColumn, 'like', "%$phrase%");
                } else {
                    $queryWithSearch = $queryWithSearch->orWhere($entityDbColumn, 'like', "%$phrase%");
                }

            }
        }
        return $queryWithSearch;
    }

    public function scopeInternalApi(Builder $query, $relationData = null)
    {
        $fixedQuery = $query;
        return $fixedQuery;
    }

    protected static function addScopes(array $scopeClasses)
    {
        foreach ($scopeClasses as $scopeClass) {
            static::addGlobalScope(new $scopeClass());
        }
    }

    protected static function removeScopes(Builder $query, array $scopeClasses): Builder
    {
        $query = $query->withoutGlobalScopes($scopeClasses);
        return $query;
    }

}