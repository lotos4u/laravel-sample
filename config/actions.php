<?php

return [
    'new' => [
        'route_name' => 'new',
        'title_key' => 'list_button_new_title',
        'text_key' => 'list_button_new_text',
    ],
    'edit' => [
        'route_name' => 'edit',
        'title_key' => 'details_button_edit_title',
        'text_key' => 'details_button_edit_text',
    ],
    'edit-row' => [
        'route_name' => 'edit',
        'class' => 'btn btn-primary waves-effect',
        'text_template' => 'actions.templates.material',
        'title_key' => 'details_button_edit_title',
        'text' => 'edit',
    ],
    'delete' => [
        'route_name' => 'delete',
        'title_key' => 'details_button_delete_title',
        'text_key' => 'details_button_delete_text',
        'method' => 'POST',
        'confirm' => true,
    ],
    'delete-row' => [
        'route_name' => 'delete',
        'class' => 'btn btn-warning waves-effect',
        'title_key' => 'details_button_delete_title',
        'text' => 'delete',
        'text_template' => 'actions.templates.material',
        'method' => 'POST',
        'confirm' => true,
    ],
    'show' => [
        'route_name' => 'show',
        'title_column' => 'name',
        'text_column' => 'name',
    ],
];
