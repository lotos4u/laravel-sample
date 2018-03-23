<?php
return [
    'user' => [
        'plural' => 'users',
        'namespace' => 'App\Models',
        'class_name' => 'User',
        'related' => [
            'role' => [
                'route_name' => 'internal.api.user.roles',
                'method_get' => 'roles',
                'method_set' => 'setUserRoles',
                'model' => 'role',
                'form_element_name' => 'user_related_roles',
            ],
            'task' => [
                'route_name' => 'internal.api.user.tasks',
            ],
            'setting' => [
                'route_name' => 'internal.api.user.settings',
            ],
            'notification' => [
                'route_name' => 'internal.api.user.notifications',
            ],
        ],
        'icon' => 'group',
        'fields' => [
            'id' => [],
            'name' => ['database' => 'users.name', 'display' => true],
            'email' => [],
            'status_name' => ['database' => 'user_statuses.name'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_email',
                    'field' => 'email'
                ],
                [
                    'key' => 'string_status',
                    'field' => 'status_name'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:users,name,?|max:100',
                'email' => 'required|email|unique:users,email,?|max:150',
                'status_id' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_email',
                    'form_element_name' => 'email',
                    'field_value' => 'email',
                ],
                [
                    'key' => 'string_status',
                    'type' => 'select',
                    'model' => 'user_status',
                    'form_element_name' => 'status_id',
                    'field_value' => 'status_id',
                ],
                [
                    'key' => 'string_roles',
                    'type' => 'select',
                    'model' => 'role',
                    'multiple' => true,
                    'form_element_name' => 'user_related_roles',
                    'options' => [
                        'relation' => 'role'
                    ],
                ],
            ],
            'title_data' => [
                'field' => 'name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
//                'actions_position' => 'after',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'email' => [
                    'title_key' => 'string_email',
                    'grid_config' => [
                        'column-id' => 'email',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'status_name' => [
                    'title_key' => 'string_status',
                    'grid_config' => [
                        'column-id' => 'status_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'email' => [
                ],
                'status_name' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'user_status' => [
        'plural' => 'user_statuses',
        'namespace' => 'App\Models',
        'class_name' => 'UserStatus',
        'related' => [
            'user' => [
                'route_name' => 'internal.api.user_status.users',
            ],
        ],
        'icon' => 'accessibility',
        'fields' => [
            'id' => [],
            'name' => [],
            'display_name' => ['database' => 'user_status_translations.display_name', 'display' => true],
            'description' => ['database' => 'user_status_translations.description'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_display_name',
                    'field' => 'display_name'
                ],
                [
                    'key' => 'string_description',
                    'field' => 'description'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:user_statuses,name,?|max:100',
                'display_name' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_display_name',
                    'form_element_name' => 'display_name',
                    'field_value' => 'display_name',
                ],
                [
                    'key' => 'string_description',
                    'type' => 'textarea',
                    'form_element_name' => 'description',
                    'field_value' => 'description',
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'display_name' => [
                    'title_key' => 'string_display_name',
                    'grid_config' => [
                        'column-id' => 'display_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'description' => [
                    'title_key' => 'string_description',
                    'grid_config' => [
                        'column-id' => 'description',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'display_name' => [
                ],
                'description' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'permission' => [
        'plural' => 'permissions',
        'namespace' => 'App\Models',
        'class_name' => 'Permission',
        'related' => [
            'role' => [
                'route_name' => 'internal.api.permission.roles',
            ],
        ],
        'icon' => 'lock',
        'fields' => [
            'id' => [],
            'name' => [],
            'display_name' => ['database' => 'permission_translations.display_name', 'display' => true],
            'description' => ['database' => 'permission_translations.description'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_display_name',
                    'field' => 'display_name'
                ],
                [
                    'key' => 'string_description',
                    'field' => 'description'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:permissions,name,?|max:100',
                'display_name' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_display_name',
                    'form_element_name' => 'display_name',
                    'field_value' => 'display_name',
                ],
                [
                    'key' => 'string_description',
                    'type' => 'textarea',
                    'form_element_name' => 'description',
                    'field_value' => 'description',
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'display_name' => [
                    'title_key' => 'string_display_name',
                    'grid_config' => [
                        'column-id' => 'display_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'description' => [
                    'title_key' => 'string_description',
                    'grid_config' => [
                        'column-id' => 'description',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'display_name' => [
                ],
                'description' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'role' => [
        'plural' => 'roles',
        'namespace' => 'App\Models',
        'class_name' => 'Role',
        'related' => [
            'permission' => [
                'route_name' => 'internal.api.role.permissions',
                'method_get' => 'perms',
                'method_set' => 'setRolePermissions',
                'model' => 'permission',
                'form_element_name' => 'role_related_perms',
            ],
        ],
        'icon' => 'people_outline',
        'fields' => [
            'id' => [],
            'name' => [],
            'display_name' => ['database' => 'role_translations.display_name', 'display' => true],
            'description' => ['database' => 'role_translations.description'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_display_name',
                    'field' => 'display_name'
                ],
                [
                    'key' => 'string_description',
                    'field' => 'description'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:roles,name,?|max:100',
                'display_name' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_display_name',
                    'form_element_name' => 'display_name',
                    'field_value' => 'display_name',
                ],
                [
                    'key' => 'string_description',
                    'type' => 'textarea',
                    'form_element_name' => 'description',
                    'field_value' => 'description',
                ],
                [
                    'key' => 'string_permissions',
                    'type' => 'select',
                    'model' => 'permission',
                    'multiple' => true,
                    'form_element_name' => 'role_related_perms',
                    'options' => [
                        'relation' => 'permission'
                    ],
//                    'field_value' => 'role_user.role_id',
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'display_name' => [
                    'title_key' => 'string_display_name',
                    'grid_config' => [
                        'column-id' => 'display_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'description' => [
                    'title_key' => 'string_description',
                    'grid_config' => [
                        'column-id' => 'description',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'display_name' => [
                ],
                'description' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'task' => [
        'plural' => 'tasks',
        'namespace' => 'App\Models',
        'class_name' => 'Task',
        'related' => [
            'task_log' => [
                'route_name' => 'internal.api.task.logs',
            ],
        ],
        'icon' => 'perm_contact_calendar',
        'fields' => [
            'id' => [],
            'type_id' => [],
            'user_id' => [],
            'name' => ['database' => 'tasks.name', 'display' => true],
            'type_name' => ['database' => 'task_type_translations.display_name'],
            'user_name' => ['database' => 'users.name'],
            'data' => [],
            'created_at' => ['database' => 'tasks.created_at', 'search' => false],
            'updated_at' => ['database' => 'tasks.updated_at', 'search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_type',
                    'field' => 'type_name'
                ],
                [
                    'key' => 'string_user',
                    'field' => 'user_name'
                ],
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_data',
                    'field' => 'data'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|max:100',
                'data' => 'required',
                'type_id' => 'required',
                'user_id' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_type',
                    'type' => 'select',
                    'model' => 'task_type',
                    'form_element_name' => 'type_id',
                    'field_value' => 'type_id',
                ],
                [
                    'key' => 'string_user',
                    'type' => 'select',
                    'model' => 'user',
                    'form_element_name' => 'user_id',
                    'field_value' => 'user_id',
                ],
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_data',
                    'type' => 'textarea',
                    'form_element_name' => 'data',
                    'field_value' => 'data',
                ],
            ],
            'title_data' => [
                'field' => 'name',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'type_name' => [
                    'title_key' => 'string_type',
                    'actions' => [
                        'show' => [
                            'route_name' => 'show',
                            'route_model' => 'task_type',
                            'key' => 'type_id',
                            'title_column' => 'type_name',
                            'text_column' => 'type_name',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'type_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'user_name' => [
                    'title_key' => 'string_user',
                    'actions' => [
                        'show' => [
                            'route_name' => 'show',
                            'route_model' => 'user',
                            'key' => 'user_id',
                            'title_column' => 'user_name',
                            'text_column' => 'user_name',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'user_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'created_at' => [
                    'title_key' => 'string_created_at',
                    'template' => 'datetime',
                    'grid_config' => [
                        'column-id' => 'created_at',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'type_name' => [
                ],
                'user_name' => [
                ],
                'created_at' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'task_log' => [
        'plural' => 'task_logs',
        'namespace' => 'App\Models',
        'class_name' => 'TaskLog',
        'icon' => 'event_note',
        'fields' => [
            'id' => [],
            'task_id' => [],
            'task_name' => ['database' => 'tasks.name'],
            'data' => ['database' => 'task_logs.data'],
            'created_at' => ['database' => 'task_logs.created_at', 'search' => false, 'display' => true],
            'updated_at' => ['database' => 'task_logs.updated_at', 'search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_task',
                    'field' => 'task_name'
                ],
                [
                    'key' => 'string_data',
                    'field' => 'data'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'created_at',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'task_id' => 'required',
                'data' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_task',
                    'type' => 'select',
                    'model' => 'task',
                    'form_element_name' => 'task_id',
                    'field_value' => 'task_id',
                ],
                [
                    'key' => 'string_data',
                    'type' => 'textarea',
                    'form_element_name' => 'data',
                    'field_value' => 'data',
                ],
            ],
            'title_data' => [
                'field' => 'created_at',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'created_at' => [
                    'title_key' => 'string_created_at',
                    'template' => 'datetime',
                    'actions' => [
                        'show' => [
                            'route_name' => 'show',
                            'title_column' => 'created_at',
                            'text_column' => 'created_at',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'created_at',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'task_name' => [
                    'title_key' => 'string_task',
                    'actions' => [
                        'show' => [
                            'route_model' => 'task',
                            'route_name' => 'show',
                            'title_column' => 'task_name',
                            'text_column' => 'task_name',
                            'key' => 'task_id',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'task_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'data' => [
                    'title_key' => 'string_name',
                    'grid_config' => [
                        'column-id' => 'data',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'data' => [
                ],
                'task_name' => [
                ],
                'created_at' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'task_type' => [
        'plural' => 'task_types',
        'namespace' => 'App\Models',
        'class_name' => 'TaskType',
        'related' => [
            'task' => [
                'route_name' => 'internal.api.task_type.tasks',
            ],
        ],
        'icon' => 'dehaze',
        'fields' => [
            'id' => [],
            'name' => [],
            'display_name' => ['database' => 'task_type_translations.display_name', 'display' => true],
            'description' => ['database' => 'task_type_translations.description'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_display_name',
                    'field' => 'display_name'
                ],
                [
                    'key' => 'string_description',
                    'field' => 'description'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:task_types,name,?|max:100',
                'display_name' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_display_name',
                    'form_element_name' => 'display_name',
                    'field_value' => 'display_name',
                ],
                [
                    'key' => 'string_description',
                    'type' => 'textarea',
                    'form_element_name' => 'description',
                    'field_value' => 'description',
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'display_name' => [
                    'title_key' => 'string_display_name',
                    'grid_config' => [
                        'column-id' => 'display_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'description' => [
                    'title_key' => 'string_description',
                    'grid_config' => [
                        'column-id' => 'description',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'display_name' => [
                ],
                'description' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'setting' => [
        'plural' => 'settings',
        'namespace' => 'App\Models',
        'class_name' => 'Setting',
        'icon' => 'mood',
        'fields' => [
            'id' => ['database' => 'settings.id'],
            'type_id' => [],
            'user_id' => [],
            'value' => [],
            'user_name' => ['database' => 'users.name'],
            'type_name' => ['database' => 'setting_type_translations.display_name', 'display' => true],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_type',
                    'field' => 'type_name'
                ],
                [
                    'key' => 'string_user',
                    'field' => 'user_name'
                ],
                [
                    'key' => 'string_value',
                    'field' => 'value'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'content' => false,
                'field' => 'type_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'content' => false,
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'type_id' => 'unique_with:settings,user_id,?',
                'value' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_type',
                    'type' => 'select',
                    'model' => 'setting_type',
                    'form_element_name' => 'type_id',
                    'field_value' => 'type_id',
                ],
                [
                    'key' => 'string_user',
                    'type' => 'select',
                    'model' => 'user',
                    'form_element_name' => 'user_id',
                    'field_value' => 'user_id',
                ],
                [
                    'key' => 'string_value',
                    'form_element_name' => 'value',
                    'field_value' => 'value',
                ],
            ],
            'title_data' => [
                'content' => false,
                'field' => 'type_name',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'content' => false,
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'type_name' => [
                    'title_key' => 'string_type',
                    'actions' => [
                        'show' => [
//                            'route_model' => 'setting_type',
                            'route_name' => 'show',
                            'title_column' => 'type_name',
                            'text_column' => 'type_name',
//                            'key' => 'type_id',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'type_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'user_name' => [
                    'title_key' => 'string_user',
                    'actions' => [
                        'show' => [
                            'route_model' => 'user',
                            'route_name' => 'show',
                            'title_column' => 'user_name',
                            'text_column' => 'user_name',
                            'key' => 'user_id',
                        ],
                    ],
                    'grid_config' => [
                        'column-id' => 'user_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'value' => [
                    'title_key' => 'string_value',
                    'grid_config' => [
                        'column-id' => 'value',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'type_name' => [
                ],
                'user_name' => [
                ],
                'value' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'setting_variant' => [
        'plural' => 'setting_variants',
        'namespace' => 'App\Models',
        'class_name' => 'SettingVariant',
        'icon' => 'filter_2',
        'fields' => [
            'id' => [],
            'name' => ['database' => 'setting_variants.name', 'display' => true],
            'type_id' => [],
            'type_name' => ['database' => 'setting_type_translations.display_name'],
            'value' => [],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_type',
                    'field' => 'type_name'
                ],
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_value',
                    'field' => 'value'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'content' => false,
                'field' => 'name',
                'key' => false,
            ],
            'subtitle_data' => [
                'content' => false,
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'type_name' => 'required',
                'value' => 'required',
                'name' => 'required|unique:setting_variants,name,?|max:150',
            ],
            'elements_data' => [
                [
                    'key' => 'string_type',
                    'type' => 'select',
                    'model' => 'setting_type',
                    'form_element_name' => 'type_name',
                    'field_name' => 'type_name',
                    'field_value' => 'type_id',
                ],
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_value',
                    'form_element_name' => 'value',
                    'field_value' => 'value',
                ],
            ],
            'title_data' => [
                'content' => false,
                'field' => 'name',
                'key' => 'title_new',
            ],
            'subtitle_data' => [
                'content' => false,
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'value' => [
                    'title_key' => 'string_value',
                    'grid_config' => [
                        'column-id' => 'value',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'type_name' => [
                    'title_key' => 'string_type',
                    'actions' => [
                        'show' => [
                            'route_model' => 'setting_type',
                            'route_name' => 'show',
                            'title_column' => 'type_name',
                            'text_column' => 'type_name',
                            'key' => 'type_id',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'type_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'value' => [
                ],
                'type_name' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'setting_type' => [
        'plural' => 'setting_types',
        'namespace' => 'App\Models',
        'class_name' => 'SettingType',
        'related' => [
            'setting' => [
                'route_name' => 'internal.api.setting_type.settings',
            ],
            'setting_variant' => [
                'route_name' => 'internal.api.setting_type.setting_variants',
            ],
        ],
        'icon' => 'settings_applications',
        'fields' => [
            'id' => [],
            'name' => [],
            'default' => [],
            'display_name' => ['database' => 'setting_type_translations.display_name', 'display' => true],
            'description' => ['database' => 'setting_type_translations.description'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_display_name',
                    'field' => 'display_name'
                ],
                [
                    'key' => 'string_description',
                    'field' => 'description'
                ],
                [
                    'key' => 'string_default',
                    'field' => 'default'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:setting_types,name,?|max:100',
                'display_name' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_display_name',
                    'form_element_name' => 'display_name',
                    'field_value' => 'display_name',
                ],
                [
                    'key' => 'string_description',
                    'type' => 'textarea',
                    'form_element_name' => 'description',
                    'field_value' => 'description',
                ],
                [
                    'key' => 'string_default',
                    'form_element_name' => 'default',
                    'field_value' => 'default',
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'display_name' => [
                    'title_key' => 'string_display_name',
                    'grid_config' => [
                        'column-id' => 'display_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'default' => [
                    'title_key' => 'string_default',
                    'grid_config' => [
                        'column-id' => 'default',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'display_name' => [
                ],
                'default' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'notification' => [
        'plural' => 'notifications',
        'namespace' => 'App\Models',
        'class_name' => 'Notification',
        'related' => [
            'user' => [
                'route_name' => 'internal.api.notification.receivers',
                'method_get' => 'receivers',
                'method_set' => 'setNotificationReceivers',
                'model' => 'user',
                'form_element_name' => 'notification_related_users',
            ],
        ],
        'icon' => 'notifications_active',
        'fields' => [
            'id' => [],
            'type_id' => [],
            'type_name' => ['database' => 'notification_type_translations.display_name'],
            'sender_id' => [],
            'sender_name' => ['database' => 'users.name'],
            'subject' => ['display' => true],
            'text' => [],
            'created_at' => ['database' => 'notifications.created_at', 'search' => false],
            'updated_at' => ['database' => 'notifications.updated_at', 'search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_subject',
                    'field' => 'subject'
                ],
                [
                    'key' => 'string_text',
                    'field' => 'text'
                ],
                [
                    'key' => 'string_type',
                    'field' => 'type_name'
                ],
                [
                    'key' => 'string_sender',
                    'field' => 'sender_name'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'subject',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'subject' => 'required|max:150',
                'text' => 'required',
                'type_id' => 'required',
                'sender_id' => 'required',
//                'notification_related_users' => 'unique_with:notification_user,',
//                'type_id' => 'unique_with:settings,user_id,?',
            ],
            'elements_data' => [
                [
                    'key' => 'string_subject',
                    'form_element_name' => 'subject',
                    'field_value' => 'subject',
                ],
                [
                    'key' => 'string_text',
                    'type' => 'textarea',
                    'form_element_name' => 'text',
                    'field_value' => 'text',
                ],
                [
                    'key' => 'string_type',
                    'type' => 'select',
                    'model' => 'notification_type',
                    'form_element_name' => 'type_id',
                    'field_value' => 'type_id',
                ],
                [
                    'key' => 'string_sender',
                    'type' => 'select',
                    'model' => 'user',
                    'form_element_name' => 'sender_id',
                    'field_value' => 'sender_id',
                ],
                [
                    'key' => 'string_users',
                    'type' => 'select',
                    'model' => 'user',
                    'multiple' => true,
                    'form_element_name' => 'notification_related_users',
                    'options' => [
                        'relation' => 'user'
                    ],
                ],
            ],
            'title_data' => [
                'field' => 'subject',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'subject' => [
                    'title_key' => 'string_subject',
                    'actions' => [
                        'show' => [
                            'route_name' => 'show',
                            'title_column' => 'subject',
                            'text_column' => 'subject',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'subject',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'created_at' => [
                    'title_key' => 'string_created_at',
                    'formatter_data' => [
                        'route_name' => 'notification.show',
                        'keys' => ['id'],
                        'class' => 'active',
                        'title_key' => 'link_title',
                    ],
                    'grid_config' => [
                        'column-id' => 'created_at',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                        'converter' => 'datetime',
                    ],
                ],
                'type_name' => [
                    'title_key' => 'string_type',
                    'actions' => [
                        'show' => [
                            'route_model' => 'notification_type',
                            'route_name' => 'show',
                            'title_column' => 'type_name',
                            'text_column' => 'type_name',
                            'key' => 'type_id',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'type_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'sender_name' => [
                    'title_key' => 'string_sender',
                    'actions' => [
                        'show' => [
                            'route_model' => 'user',
                            'route_name' => 'show',
                            'title_column' => 'sender_name',
                            'text_column' => 'sender_name',
                            'key' => 'sender_id',
                        ]
                    ],
                    'grid_config' => [
                        'column-id' => 'sender_name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'subject' => [
                ],
                'created_at' => [
                ],
                'type_name' => [
                ],
                'sender_name' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'notification_type' => [
        'plural' => 'notification_types',
        'namespace' => 'App\Models',
        'class_name' => 'NotificationType',
        'related' => [
            'notification' => [
                'route_name' => 'internal.api.notification_type.notifications',
            ],
        ],
        'icon' => 'notifications_none',
        'fields' => [
            'id' => [],
            'name' => [],
            'display_name' => ['database' => 'notification_type_translations.display_name', 'display' => true],
            'description' => ['database' => 'notification_type_translations.description'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_display_name',
                    'field' => 'display_name'
                ],
                [
                    'key' => 'string_description',
                    'field' => 'description'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:notification_types,name,?|max:100',
                'display_name' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_display_name',
                    'form_element_name' => 'display_name',
                    'field_value' => 'display_name',
                ],
                [
                    'key' => 'string_description',
                    'type' => 'textarea',
                    'form_element_name' => 'description',
                    'field_value' => 'description',
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'display_name' => [
                    'title_key' => 'string_display_name',
                    'grid_config' => [
                        'column-id' => 'display_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'description' => [
                    'title_key' => 'string_description',
                    'grid_config' => [
                        'column-id' => 'description',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'display_name' => [
                ],
                'description' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
    'notification_status' => [
        'plural' => 'notification_statuses',
        'namespace' => 'App\Models',
        'class_name' => 'NotificationStatus',
//        'related' => [
//            'notification' => [
//                'route_name' => 'internal.api.notification_type.notifications',
//            ],
//        ],
        'icon' => 'notifications_paused',
        'fields' => [
            'id' => [],
            'name' => [],
            'display_name' => ['database' => 'notification_status_translations.display_name', 'display' => true],
            'description' => ['database' => 'notification_status_translations.description'],
            'created_at' => ['search' => false],
            'updated_at' => ['search' => false],
        ],
        'details' => [
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'field' => 'name'
                ],
                [
                    'key' => 'string_display_name',
                    'field' => 'display_name'
                ],
                [
                    'key' => 'string_description',
                    'field' => 'description'
                ],
                [
                    'key' => 'string_created_at',
                    'field' => 'created_at'
                ],
                [
                    'key' => 'string_updated_at',
                    'field' => 'updated_at'
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
            'actions' => [
                'edit',
                'delete',
            ],
        ],
        'edit' => [
            'validate' => [
                'name' => 'required|unique:notification_statuses,name,?|max:100',
                'display_name' => 'required',
            ],
            'elements_data' => [
                [
                    'key' => 'string_name',
                    'form_element_name' => 'name',
                    'field_value' => 'name',
                ],
                [
                    'key' => 'string_display_name',
                    'form_element_name' => 'display_name',
                    'field_value' => 'display_name',
                ],
                [
                    'key' => 'string_description',
                    'type' => 'textarea',
                    'form_element_name' => 'description',
                    'field_value' => 'description',
                ],
            ],
            'title_data' => [
                'field' => 'display_name',
                'key' => false,
            ],
            'subtitle_data' => [
                'field' => false,
                'key' => 'title_show',
            ],
//            'actions' => [
//                'edit',
//                'delete',
//            ],
        ],
        'list' => [
            'columns_data' => [
                'id' => [
                    'title_key' => false,
                    'grid_config' => [
                        'column-id' => 'id',
                        'visible' => 'false',
                        'formatter' => 'false',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
                'name' => [
                    'title_key' => 'string_name',
                    'actions' => [
                        'show'
                    ],
                    'grid_config' => [
                        'column-id' => 'name',
                        'visible' => 'true',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'display_name' => [
                    'title_key' => 'string_display_name',
                    'grid_config' => [
                        'column-id' => 'display_name',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'description' => [
                    'title_key' => 'string_description',
                    'grid_config' => [
                        'column-id' => 'description',
                        'visible' => 'true',
                        'formatter' => 'false',
                        'sortable' => 'true',
                        'visible-in-selection' => 'true',
                    ],
                ],
                'command' => [
                    'title_key' => 'string_action',
                    'actions' => [
                        'edit-row',
                        'delete-row',
                    ],
                    'grid_config' => [
                        'column-id' => 'command',
                        'visible' => 'true',
                        'formatter' => 'command',
                        'sortable' => 'false',
                        'visible-in-selection' => 'false',
                    ],
                ],
            ],
            'filters' => [
                'name' => [
                ],
                'display_name' => [
                ],
                'description' => [
                ],
            ],
            'actions' => [
                'new',
            ],
        ],
    ],
];