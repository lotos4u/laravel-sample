<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

abstract class BasicSeeder extends Seeder
{
    protected function loadDataToTable(array $data, $tableName)
    {
        Schema::disableForeignKeyConstraints();
        foreach ($data as $item) {
            $item['created_at'] = date("Y-m-d H:i:s");
            $item['updated_at'] = date("Y-m-d H:i:s");
            DB::table($tableName)->insert($item);
        }
        Schema::enableForeignKeyConstraints();
    }

    protected function loadDataToTranslatableModel(array $data, $fullClassName)
    {
        $models = [];
        foreach ($data as $item) {
            $model = new $fullClassName();
            $model->name = $item['name'];
            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
            $model->translateOrNew('en')->display_name = $item['display_name']['en'];
            $model->translateOrNew('ru')->display_name = $item['display_name']['ru'];
            $model->translateOrNew('en')->description = $item['description']['en'];
            $model->translateOrNew('ru')->description = $item['description']['ru'];
            $model->save();
            $models[] = $model;
        }
        return $models;
    }
}
