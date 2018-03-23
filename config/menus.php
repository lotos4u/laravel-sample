<?php

return [
    'main' => [
        'empty_route' => 'javascript:void(0);',
        'items' => [
            [
                'permissions' => ['role_*', 'permission_*', 'user_*'],
                'routes' => [
                    'role.index', 'permission.index', 'user.index', 'user_status.index',
                    'role.show', 'permission.show', 'user.show', 'user_status.show',
                    'role.edit', 'permission.edit', 'user.edit', 'user_status.edit',
                    'role.new', 'permission.new', 'user.new', 'user_status.new',
                ],
                'route' => false,
                'icon' => 'security',
                'title_key' => 'main.menu_access_section',
                'items' => [
                    [
                        'permissions' => ['user_create*', 'user_read*', 'user_update*', 'user_delete*'],
                        'routes' => ['user.index', 'user.show', 'user.edit', 'user.new'],
                        'route' => 'user.index',
                        'model' => 'user',
                        'title_key' => 'main.menu_users',
                    ],
                    [
                        'permissions' => ['user_status*'],
                        'routes' => ['user_status.index', 'user_status.show', 'user_status.edit', 'user_status.new'],
                        'route' => 'user_status.index',
                        'model' => 'user_status',
                        'title_key' => 'main.menu_user_statuses',
                    ],
                    [
                        'permissions' => ['role_*'],
                        'routes' => ['role.index', 'role.show', 'role.edit', 'role.new'],
                        'route' => 'role.index',
                        'model' => 'role',
                        'title_key' => 'main.menu_roles',
                    ],
                    [
                        'permissions' => ['permission_*'],
                        'routes' => ['permission.index', 'permission.show', 'permission.edit', 'permission.new'],
                        'route' => 'permission.index',
                        'model' => 'permission',
                        'title_key' => 'main.menu_permissions',
                    ],
                ],
            ],
            [
                'permissions' => ['setting_type_*', 'setting_*', 'setting_variant_*'],
                'routes' => [
                    'setting_type.index', 'setting_type.show', 'setting_type.edit', 'setting_type.new',
                    'setting_variant.index', 'setting_variant.show', 'setting_variant.edit', 'setting_variant.new',
                    'setting.index', 'setting.show', 'setting.edit', 'setting.new',
                ],
                'route' => false,
                'icon' => 'settings',
                'title_key' => 'main.menu_settings_section',
                'items' => [
                    [
                        'permissions' => ['setting_type_*'],
                        'routes' => ['setting_type.index', 'setting_type.show', 'setting_type.edit', 'setting_type.new'],
                        'route' => 'setting_type.index',
                        'model' => 'setting_type',
                        'title_key' => 'main.menu_setting_types',
                    ],
                    [
                        'permissions' => ['setting_variant_*'],
                        'routes' => ['setting_variant.index', 'setting_variant.show', 'setting_variant.edit', 'setting_variant.new'],
                        'route' => 'setting_variant.index',
                        'model' => 'setting_variant',
                        'title_key' => 'main.menu_setting_variants',
                    ],
                    [
                        'permissions' => ['setting_create*', 'setting_read*', 'setting_update*', 'setting_delete*'],
                        'routes' => ['setting.index', 'setting.show', 'setting.edit', 'setting.new'],
                        'route' => 'setting.index',
                        'model' => 'setting',
                        'title_key' => 'main.menu_settings',
                    ],
                ],
            ],
            [
                'permissions' => ['task_*'],
                'routes' => [
                    'task_type.index', 'task_type.show', 'task_type.edit', 'task_type.new',
                    'task.index', 'task.show', 'task.edit', 'task.new',
                    'task_log.index', 'task_log.show', 'task_log.edit', 'task_log.new',
                ],
                'route' => false,
                'icon' => 'schedule',
                'title_key' => 'main.menu_tasks_section',
                'items' => [
                    [
                        'permissions' => ['task_type_*'],
                        'routes' => ['task_type.index', 'task_type.show', 'task_type.edit', 'task_type.new'],
                        'route' => 'task_type.index',
                        'model' => 'task_type',
                        'title_key' => 'main.menu_task_types',
                    ],
                    [
                        'permissions' => ['task_create*', 'task_read*', 'task_update*', 'task_delete*'],
                        'routes' => ['task.index', 'task.show', 'task.edit', 'task.new'],
                        'route' => 'task.index',
                        'model' => 'task',
                        'title_key' => 'main.menu_tasks',
                    ],
                    [
                        'permissions' => ['task_log_*'],
                        'routes' => ['task_log.index', 'task_log.show', 'task_log.edit', 'task_log.new'],
                        'route' => 'task_log.index',
                        'model' => 'task_log',
                        'title_key' => 'main.menu_task_logs',
                    ],
                ],
            ],
            [
                'permissions' => ['notification_*'],
                'routes' => [
                    'notification_type.index', 'notification_type.show', 'notification_type.edit', 'notification_type.new',
                    'notification.index', 'notification.show', 'notification.edit', 'notification.new',
                    'notification_status.index', 'notification_status.show', 'notification_status.edit', 'notification_status.new'
                ],
                'route' => false,
                'icon' => 'notifications',
                'title_key' => 'main.menu_notifications_section',
                'items' => [
                    [
                        'permissions' => ['notification_type_*'],
                        'routes' => ['notification_type.index', 'notification_type.show', 'notification_type.edit', 'notification_type.new'],
                        'route' => 'notification_type.index',
                        'model' => 'notification_type',
                        'title_key' => 'main.menu_notification_types',
                    ],
                    [
                        'permissions' => ['notification_status_*'],
                        'routes' => ['notification_status.index', 'notification_status.show', 'notification_status.edit', 'notification_status.new'],
                        'route' => 'notification_status.index',
                        'model' => 'notification_status',
                        'title_key' => 'main.menu_notification_statuses',
                    ],
                    [
                        'permissions' => ['notification_create*', 'notification_read*', 'notification_update*', 'notification_delete*'],
                        'routes' => ['notification.index', 'notification.show', 'notification.edit', 'notification.new'],
                        'route' => 'notification.index',
                        'model' => 'notification',
                        'title_key' => 'main.menu_notifications',
                    ],
                ],
            ],
        ],
    ],
];