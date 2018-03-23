<?php

namespace App\Models;


use Illuminate\Support\Facades\View;

class FilterFactory
{

    public static function getFiltersForEntity($modelName, $gridId)
    {
        $filters = false;
        $filtersConfig = config("entity.$modelName.list.filters");
        $gridConfig = config("entity.$modelName.list.columns_data");
        if (is_array($filtersConfig) && count($filtersConfig) > 0) {
            $filters = [];
            foreach ($gridConfig as $columnKey => $columnConfig) {
                if ($columnConfig['grid_config']['visible'] === 'true') {
                    if (isset($filtersConfig[$columnKey])) {
                        $filterConfig = $filtersConfig[$columnKey];
                        $filterType = isset($filterConfig['type']) ? $filterConfig['type'] : 'string';
                        switch ($filterType) {
                            case 'string':
                                $filterData = ['column' => $columnKey, 'grid' => $gridId];
                                break;
                            default:
                                throw new \Exception("There is no filter of type '$filterType'!");
                        }
                        $filter = view('filters.' . $filterType, $filterData)->render();
                    } else {
                        $filterData = ['column' => $columnKey, 'grid' => $gridId];
                        $filter = view('filters.empty', $filterData)->render();
                    }
                    $filters[$columnKey] = $filter;
                }
            }
        }
        return $filters;
    }
}