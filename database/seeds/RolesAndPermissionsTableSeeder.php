<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsTableSeeder extends BasicSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating roles...');
        $roles_data = $this->roles();

        $this->command->info('Creating permissions...');
        $permissions_data = $this->permissions();

        $this->command->info('Creating relations between Roles, Permissions and Users...');
        $this->setPermissionsToRoles($roles_data, $permissions_data);
    }

    protected function permissions()
    {

        // Permissions
        $models = [
            'users' => [
                'name' => 'user',
                'display_name' => [
                    'en' => 'Users ',
                    'ru' => 'Пользователей ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'user_statuses' => [
                'name' => 'user_status',
                'display_name' => [
                    'en' => 'User Statuses ',
                    'ru' => 'Статусы пользователей ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'roles' => [
                'name' => 'role',
                'display_name' => [
                    'en' => 'Roles ',
                    'ru' => 'Роли ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'permissions' => [
                'name' => 'permission',
                'display_name' => [
                    'en' => 'Permissions ',
                    'ru' => 'Разрешения ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'tasks' => [
                'name' => 'task',
                'display_name' => [
                    'en' => 'Tasks ',
                    'ru' => 'Задачи ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'task_logs' => [
                'name' => 'task_log',
                'display_name' => [
                    'en' => 'Task Logs ',
                    'ru' => 'Логи задач ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'task_types' => [
                'name' => 'task_type',
                'display_name' => [
                    'en' => 'Task Types ',
                    'ru' => 'Типы задач ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'settings' => [
                'name' => 'setting',
                'display_name' => [
                    'en' => 'Settings ',
                    'ru' => 'Настройки ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'setting_types' => [
                'name' => 'setting_type',
                'display_name' => [
                    'en' => 'Setting Types ',
                    'ru' => 'Типы настроек ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'setting_variants' => [
                'name' => 'setting_variant',
                'display_name' => [
                    'en' => 'Setting Variants ',
                    'ru' => 'Значения настроек ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'notifications' => [
                'name' => 'notification',
                'display_name' => [
                    'en' => 'Notifications ',
                    'ru' => 'Уведомления ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'notification_types' => [
                'name' => 'notification_type',
                'display_name' => [
                    'en' => 'Notification Types ',
                    'ru' => 'Типы уведомлений ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
            'notification_statuses' => [
                'name' => 'notification_status',
                'display_name' => [
                    'en' => 'Notification Statuses ',
                    'ru' => 'Статусы уведомлений ',
                ],
                'description' => [
                    'en' => 'Can ',
                    'ru' => 'Может ',
                ],
            ],
        ];
        $actions = [
            'create' => [
                'name' => '_create',
                'display_name' => [
                    'en' => 'Create ',
                    'ru' => 'Создавать ',
                ],
            ],
            'read' => [
                'name' => '_read',
                'display_name' => [
                    'en' => 'Read ',
                    'ru' => 'Просматривать ',
                ],
            ],
            'update' => [
                'name' => '_update',
                'display_name' => [
                    'en' => 'Update ',
                    'ru' => 'Изменять ',
                ],
            ],
            'delete' => [
                'name' => '_delete',
                'display_name' => [
                    'en' => 'Delete ',
                    'ru' => 'Удалять ',
                ],
            ],
        ];

        $whose = [
            'own' => [
                'name' => '',
                'display_name' => [
                    'en' => 'for Himself',
                    'ru' => 'Себе',
                ],
                'description' => [
                    'en' => 'for himself',
                    'ru' => 'для себя',
                ],
            ],
            'dev-super' => [
                'name' => '_dev-super',
                'display_name' => [
                    'en' => 'of Super Developers',
                    'ru' => 'Супер Разработчиков',
                ],
                'description' => [
                    'en' => 'of super developers',
                    'ru' => ', принадлежащих супер разработчикам',
                ],
            ],
            'dev-normal' => [
                'name' => '_dev-normal',
                'display_name' => [
                    'en' => 'of Normal Developers',
                    'ru' => 'Обычных Разработчиков',
                ],
                'description' => [
                    'en' => 'of normal developers',
                    'ru' => ', принадлежащих обычным разработчикам',
                ],
            ],
            'adminsuper' => [
                'name' => '_admin-super',
                'display_name' => [
                    'en' => 'of Super Administrators',
                    'ru' => 'Супер Администраторов',
                ],
                'description' => [
                    'en' => 'of super administrators',
                    'ru' => ', принадлежащих супер администраторам',
                ],
            ],
            'admin-normal' => [
                'name' => '_admin-normal',
                'display_name' => [
                    'en' => 'of Normal Administrators',
                    'ru' => 'Обычных Администраторов',
                ],
                'description' => [
                    'en' => 'of normal administrators',
                    'ru' => ', принадлежащих обычным администраторам',
                ],
            ],
            'user-super' => [
                'name' => '_user-super',
                'display_name' => [
                    'en' => 'of Super Users',
                    'ru' => 'Супер Пользователей',
                ],
                'description' => [
                    'en' => 'of super users',
                    'ru' => ', принадлежащих супер пользователям',
                ],
            ],
            'user-normal' => [
                'name' => '_user-normal',
                'display_name' => [
                    'en' => 'of Normal Users',
                    'ru' => 'Обычных пользователей',
                ],
                'description' => [
                    'en' => 'of normal users',
                    'ru' => ', принадлежащих обычных пользователям',
                ],
            ],
        ];
        $permissions_data = [];
        foreach ($models as $key => $model) {
            foreach ($actions as $action) {
                foreach ($whose as $role) {
                    $permissions_data[] = [
                        'name' => $model['name'] . $action['name'] . $role['name'],
                        'display_name' => [
                            'en' => $action['display_name']['en'] . $model['display_name']['en'] . $role['display_name']['en'],
                            'ru' => $action['display_name']['ru'] . $model['display_name']['ru'] . $role['display_name']['ru'],
                        ],
                        'description' => [
                            'en' => $model['description']['en'] . mb_strtolower($action['display_name']['en'] . $model['display_name']['en']) . $role['description']['en'],
                            'ru' => $model['description']['ru'] . mb_strtolower($action['display_name']['ru'] . $model['display_name']['ru']) . $role['description']['ru'],
                        ],
                    ];
                }
            }
        }

        $this->loadDataToTranslatableModel($permissions_data, 'App\Models\Permission');

        return $permissions_data;
    }

    protected function roles()
    {
        // Roles
        $roles_data = [
            [
                'name' => 'system',
                'display_name' => [
                    'en' => 'System',
                    'ru' => 'Система',
                ],
                'description' => [
                    'en' => 'Role for internal use only. Only one user (system user) can have this role',
                    'ru' => 'Роль для внутреннего системного пользователя. Только один пользователь может иметь эту роль',
                ],
            ],
            [
                'name' => 'dev-super',
                'display_name' => [
                    'en' => 'Developer Super',
                    'ru' => 'Разработчик Супер',
                ],
                'description' => [
                    'en' => 'Most powerfull user',
                    'ru' => 'Может все',
                ],
            ],
            [
                'name' => 'dev-normal',
                'display_name' => [
                    'en' => 'Developer',
                    'ru' => 'Разработчик',
                ],
                'description' => [
                    'en' => 'Very powerfull user',
                    'ru' => 'Может почти все',
                ],
            ],
            [
                'name' => 'admin-super',
                'display_name' => [
                    'en' => 'Administrator Super',
                    'ru' => 'Администратор Супер',
                ],
                'description' => [
                    'en' => 'Manage Administrators and other users',
                    'ru' => 'Управляет администраторами и остальными пользователями',
                ],
            ],
            [
                'name' => 'admin-normal',
                'display_name' => [
                    'en' => 'Administrator',
                    'ru' => 'Администратор',
                ],
                'description' => [
                    'en' => 'Manage users',
                    'ru' => 'Управляет остальными пользователями',
                ],
            ],
            [
                'name' => 'user-super',
                'display_name' => [
                    'en' => 'User Super',
                    'ru' => 'Пользователь Супер',
                ],
                'description' => [
                    'en' => 'Can customise system settings',
                    'ru' => 'Может управлять своими задачами и просматривать задачи обычных пользователей. Создавать новые роли для обычных пользователей. Управлять своими уведомлениями.',
                ],
            ],
            [
                'name' => 'user-normal',
                'display_name' => [
                    'en' => 'User',
                    'ru' => 'Пользователь',
                ],
                'description' => [
                    'en' => 'Can manage his Tasks',
                    'ru' => 'Может управлять своими задачами и уведомлениями',
                ],
            ],
        ];

        $this->loadDataToTranslatableModel($roles_data, 'App\Models\Role');

        return $roles_data;
    }

    protected function getSystemPermissions(array $permissions)
    {
        $perms = $permissions;
        return $perms;
    }

    protected function getSuperDeveloperPermissions(array $permissions)
    {
        $perms = $permissions;
        return $perms;
    }

    protected function getNormalDeveloperPermissions(array $permissions)
    {
        $perms = $permissions;
        return $perms;
    }

    protected function getSuperAdminPermissions(array $permissions)
    {
        $perms = [
            $permissions['role_read'],

            $permissions['role_create_user-super'],
            $permissions['role_read_user-super'],
            $permissions['role_update_user-super'],
            $permissions['role_delete_user-super'],

            $permissions['role_create_user-normal'],
            $permissions['role_read_user-normal'],
            $permissions['role_update_user-normal'],
            $permissions['role_delete_user-normal'],

            $permissions['role_create_admin-normal'],
            $permissions['role_read_admin-normal'],
            $permissions['role_update_admin-normal'],
            $permissions['role_delete_admin-normal'],

            $permissions['task_create'],
            $permissions['task_read'],
            $permissions['task_update'],
            $permissions['task_delete'],

            $permissions['task_create_admin-normal'],
            $permissions['task_read_admin-normal'],
            $permissions['task_update_admin-normal'],
            $permissions['task_delete_admin-normal'],

            $permissions['task_create_user-super'],
            $permissions['task_read_user-super'],
            $permissions['task_update_user-super'],
            $permissions['task_delete_user-super'],

            $permissions['task_create_user-normal'],
            $permissions['task_read_user-normal'],
            $permissions['task_update_user-normal'],
            $permissions['task_delete_user-normal'],

            $permissions['user_create_admin-normal'],
            $permissions['user_read_admin-normal'],
            $permissions['user_update_admin-normal'],
            $permissions['user_delete_admin-normal'],

            $permissions['user_create_user-super'],
            $permissions['user_read_user-super'],
            $permissions['user_update_user-super'],
            $permissions['user_delete_user-super'],

            $permissions['user_create_user-normal'],
            $permissions['user_read_user-normal'],
            $permissions['user_update_user-normal'],
            $permissions['user_delete_user-normal'],

            $permissions['notification_create'],
            $permissions['notification_read'],
            $permissions['notification_update'],
            $permissions['notification_delete'],

            $permissions['notification_create_admin-normal'],
            $permissions['notification_read_admin-normal'],
            $permissions['notification_update_admin-normal'],
            $permissions['notification_delete_admin-normal'],

            $permissions['notification_create_user-super'],
            $permissions['notification_read_user-super'],
            $permissions['notification_update_user-super'],
            $permissions['notification_delete_user-super'],

            $permissions['notification_create_user-normal'],
            $permissions['notification_read_user-normal'],
            $permissions['notification_update_user-normal'],
            $permissions['notification_delete_user-normal'],
        ];
        return $perms;
    }

    protected function getNormalAdminPermissions(array $permissions)
    {
        $perms = [
            $permissions['role_read'],

            $permissions['role_create_user-super'],
            $permissions['role_read_user-super'],
            $permissions['role_update_user-super'],
            $permissions['role_delete_user-super'],

            $permissions['role_create_user-normal'],
            $permissions['role_read_user-normal'],
            $permissions['role_update_user-normal'],
            $permissions['role_delete_user-normal'],

            $permissions['task_create'],
            $permissions['task_read'],
            $permissions['task_update'],
            $permissions['task_delete'],

            $permissions['task_create_user-super'],
            $permissions['task_read_user-super'],
            $permissions['task_update_user-super'],
            $permissions['task_delete_user-super'],

            $permissions['task_create_user-normal'],
            $permissions['task_read_user-normal'],
            $permissions['task_update_user-normal'],
            $permissions['task_delete_user-normal'],

            $permissions['user_create_user-super'],
            $permissions['user_read_user-super'],
            $permissions['user_update_user-super'],
            $permissions['user_delete_user-super'],

            $permissions['user_create_user-normal'],
            $permissions['user_read_user-normal'],
            $permissions['user_update_user-normal'],
            $permissions['user_delete_user-normal'],

            $permissions['notification_create'],
            $permissions['notification_read'],
            $permissions['notification_update'],
            $permissions['notification_delete'],

            $permissions['notification_create_user-super'],
            $permissions['notification_read_user-super'],
            $permissions['notification_update_user-super'],
            $permissions['notification_delete_user-super'],

            $permissions['notification_create_user-normal'],
            $permissions['notification_read_user-normal'],
            $permissions['notification_update_user-normal'],
            $permissions['notification_delete_user-normal'],
        ];
        return $perms;
    }

    protected function getSuperUserPermissions(array $permissions)
    {
        $perms = [
            $permissions['role_read'],
            $permissions['role_create_user-normal'],
            $permissions['role_read_user-normal'],
            $permissions['role_update_user-normal'],
            $permissions['role_delete_user-normal'],
            $permissions['setting_read'],
            $permissions['setting_update'],
            $permissions['task_create'],
            $permissions['task_read'],
            $permissions['task_read_user-normal'],
            $permissions['task_update'],
            $permissions['task_delete'],
            $permissions['notification_create'],
            $permissions['notification_read'],
            $permissions['notification_update'],
            $permissions['notification_delete'],
        ];
        return $perms;
    }

    protected function getNormalUserPermissions(array $permissions)
    {
        $perms = [
            $permissions['role_read'],
            $permissions['permission_read'],
            $permissions['setting_read'],
            $permissions['setting_update'],
            $permissions['task_create'],
            $permissions['task_read'],
            $permissions['task_update'],
            $permissions['task_delete'],
            $permissions['notification_create'],
            $permissions['notification_read'],
            $permissions['notification_update'],
            $permissions['notification_delete'],
        ];
        return $perms;
    }

    protected function setPermissionsToRoles($roles_data, $permissions_data)
    {
        $roles = [];
        foreach ($roles_data as $role) {
            $roles[$role['name']] = Role::where('name', $role['name'])->first();
        }
        $permissions = [];
        foreach ($permissions_data as $permission) {
            $permissions[$permission['name']] = Permission::where('name', $permission['name'])->first();
        }

        $roles['system']->attachPermissions($this->getSystemPermissions($permissions));

        $roles['dev-super']->attachPermissions($this->getSuperDeveloperPermissions($permissions));

        $roles['dev-normal']->attachPermissions($this->getNormalDeveloperPermissions($permissions));

        $roles['admin-super']->attachPermissions($this->getSuperAdminPermissions($permissions));

        $roles['admin-normal']->attachPermissions($this->getNormalAdminPermissions($permissions));

        $roles['user-super']->attachPermissions($this->getSuperUserPermissions($permissions));

        $roles['user-normal']->attachPermissions($this->getNormalUserPermissions($permissions));

        $this->command->info('Saving Roles with Permissions into DB...');
        foreach ($roles as $role) {
            $role->save();
        }
        $users_data = [
            'admin-super',
            'admin-normal',
            'user-super',
            'user-normal',
        ];

        $users = [];
        foreach ($users_data as $name) {
            $users_set = User::where('name', 'like', "%$name%")->get();
            $this->command->info('Updating ' . count($users_set) . ' Users with name like "' . $name . '"...');
            foreach ($users_set as $user) {
                $user->attachRole($roles[$name]);
                $users[] = $user;
            }
        }

        $denis = User::getSystemUser();
        $denis->attachRole($roles['system']);

        $denis = User::where('email', 'golovin.denis@gmail.com')->first();
        $denis->attachRole($roles['dev-super']);

        $ulya = User::where('email', 'uliannochka@mail.ru')->first();
        $ulya->attachRole($roles['dev-normal']);

        $users[] = $denis;
        $users[] = $ulya;
        $this->command->info('Saving ' . count($users) . ' Users with Roles into DB...');
        foreach ($users as $user) {
            $user->save();
        }
    }
}
