<?php

return [
    'internal' => [
        'url_prefix' => 'api/v2',
        'guard' => 'api',
        'routes_path' => 'routes/api_internal.php',
        'urls' => [
            'setting' => 'settings',
            'setting_type' => 'setting-types',
            'setting_status' => 'setting-statuses',
            'setting_variant' => 'setting-variants',
            'task' => 'tasks',
            'task_log' => 'task-logs',
            'task_type' => 'task-types',
            'notification' => 'notifications',
            'notification_type' => 'notification-types',
            'notification_status' => 'notification-statuses',
            'user' => 'users',
            'user_status' => 'user-statuses',
            'role' => 'roles',
            'permission' => 'permissions',
        ],
    ],
    'external' => [
        'url_prefix' => 'api/v1',
        'guard' => 'api',
        'routes_path' => 'routes/api.php',
    ],
];