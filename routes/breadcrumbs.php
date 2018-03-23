<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $data = ['icon' => 'home'];
    $breadcrumbs->push('Home', route('home'), $data);
});
$entities = array_keys(config('entity'));
foreach ($entities as $model_name) {
    // Home > Users
    Breadcrumbs::register($model_name . '.index', function ($breadcrumbs) use ($model_name) {
        $breadcrumbs->parent('home');
        $data = ['icon' => config('entity.' . $model_name . '.icon')];
        $breadcrumbs->push(__('entity.' . $model_name . '_plural'), route($model_name . '.index'), $data);
    });
    // Home > Users > User
    Breadcrumbs::register($model_name . '.show', function ($breadcrumbs, $model) use ($model_name) {
        $data = ['icon' => ''];
        $breadcrumbs->parent($model_name . '.index');
        $field_name = \App\Helpers\EntityHelper::getEntityDisplayField(config('entity.' . $model_name));
        $breadcrumbs->push($model[$field_name], route($model_name . '.show', $model['id']), $data);
    });
    // Home > Users > New
    Breadcrumbs::register($model_name . '.new', function ($breadcrumbs) use ($model_name) {
        $data = ['icon' => ''];
        $breadcrumbs->parent($model_name . '.index');
        $breadcrumbs->push(__('main.breadcrumbs_new'), route($model_name . '.new'), $data);
    });
    // Home > Users > User > Edit
    Breadcrumbs::register($model_name . '.edit', function ($breadcrumbs, $model) use ($model_name) {
        $data = ['icon' => ''];
        $breadcrumbs->parent($model_name . '.show', $model);
        $breadcrumbs->push(__('main.breadcrumbs_edit'), route($model_name . '.edit', $model['id']), $data);
    });
}

Breadcrumbs::register('user.profile', function ($breadcrumbs, $model) {
    $data = ['icon' => ''];
    $breadcrumbs->parent('home');
    $field_name = \App\Helpers\EntityHelper::getEntityDisplayField(config('entity.user'));
    $breadcrumbs->push($model[$field_name], route('user.profile'), $data);
});
