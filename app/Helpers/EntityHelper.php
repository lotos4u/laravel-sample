<?php

namespace App\Helpers;

class EntityHelper
{
    public static function getConfigKeyForInstance($instance)
    {
        $entity_key = false;
        $className = get_class($instance);
        $entities = config('entity');
        foreach ($entities as $key => $e) {
            $fullClass = $e['namespace'] . "\\" . $e['class_name'];
            if ($fullClass == $className) {
                $entity_key = $key;
                break;
            }
        }
        if (!$entity_key) {
            throw new \Exception('No entity records found in config for ' . $className);
        }
        return $entity_key;
    }

    public static function getEntityColumns(array $config)
    {
        $fields = $config['fields'];
        $columns = [];
        foreach ($fields as $fieldName => $fieldData) {
            $columns[$fieldName] = !isset($fieldData['database']) ? $fieldName : $fieldData['database'];
        }
        return $columns;
    }

    public static function getEntitySearchColumns(array $config)
    {
        $fields = $config['fields'];
        $searchable = [];
        foreach ($fields as $fieldName => $fieldData) {
            if (!isset($fieldData['search']) || (isset($fieldData['search']) && $fieldData['search'])) {
                $searchable[$fieldName] = !isset($fieldData['database']) ? $fieldName : $fieldData['database'];
            }
        }
        return $searchable;
    }

    public static function getEntityDisplayField(array $config)
    {
        $fields = $config['fields'];
        foreach ($fields as $fieldName => $fieldData) {
            if (isset($fieldData['display']) && $fieldData['display']) {
                return $fieldName;
            }
        }
        throw new \Exception('Display field not found for ' . $config['class_name']);
    }

    public static function getEntityClassName(array $config)
    {
        return $config['namespace'] . "\\" . $config['class_name'];
    }

    public static function getSelectValues($modelName)
    {
        $config = config('entity.' . $modelName);
        $className = EntityHelper::getEntityClassName($config);
        $displayField = EntityHelper::getEntityDisplayField($config);
        $models = $className::all()->toArray();
        $data = [];
        foreach ($models as $model) {
            $data[$model['id']] = $model[$displayField];
        }
        return $data;
    }

    public static function getSelectedRelations($modelArray, $relation)
    {
        $relatedModels = $modelArray[$relation];
        $ids = [];
        foreach ($relatedModels as $model) {
            $ids[] = $model['id'];
        }
        return $ids;
    }

    public static function hasRelatedByFormElementName($modelName, $formElementName)
    {
        $config = config('entity.' . $modelName);
        $related = isset($config['related']) ? $config['related'] : false;
        if (is_array($related)) {
            foreach ($related as $relation) {
                if (!empty($relation['form_element_name']) && $relation['form_element_name'] === $formElementName) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function getRelationForFormElementName($modelName, $formElementName)
    {
        $config = config('entity.' . $modelName);
        $related = isset($config['related']) ? $config['related'] : false;
        if (is_array($related)) {
            foreach ($related as $relation) {
                if (!empty($relation['form_element_name']) && $relation['form_element_name'] === $formElementName) {
                    return $relation;
                }
            }
        }
        return null;
    }
}