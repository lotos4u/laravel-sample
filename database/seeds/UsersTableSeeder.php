<?php

use App\SmartDatabaseSeeder;
use Illuminate\Database\Schema\Blueprint;

class UsersTableSeeder extends BasicSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin_size = 2;
        $normal_admin_size = 2;
        $super_user_size = 2;
        $normal_user_size = 2;
        $default_password = bcrypt('niuh78gugb768mj9896n6n899mj79');

        $this->loadUserStatuses();

        $system_users = [
            [
                'name' => 'system',
                'email' => 'lotos4u@gmail.com',
                'password' => bcrypt('9n0d20cn2c02569b22929f295mfcs'),
                'api_token' => str_random(60),
                'status_id' => 1,
            ]
        ];

        $dev_users = [
            [
                'name' => 'lotos4u',
                'email' => 'golovin.denis@gmail.com',
                'password' => bcrypt('098'),
                'api_token' => str_random(60),
                'status_id' => 1,
            ],
            [
                'name' => 'ulya',
                'email' => 'uliannochka@mail.ru',
                'password' => bcrypt('2605'),
                'api_token' => str_random(60),
                'status_id' => 1,
            ],
        ];

        $this->command->info("Generating super admin users ($super_admin_size records) data...");
        $super_admins = [];
        for ($i = 0; $i < $super_admin_size; $i++) {
            $name = 'USER_admin-super_' . ($i + 1);
            $super_admins[] = [
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => $default_password,
                'api_token' => str_random(60),
                'status_id' => 1,
            ];
        }

        $this->command->info("Generating normal admin users ($normal_admin_size records) data...");
        $normal_admins = [];
        for ($i = 0; $i < $normal_admin_size; $i++) {
            $name = 'USER_admin-normal_' . ($i + 1);
            $normal_admins[] = [
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => $default_password,
                'api_token' => str_random(60),
                'status_id' => 1,
            ];
        }

        $this->command->info("Generating super users ($super_user_size records) data...");
        $super_users = [];
        for ($i = 0; $i < $super_user_size; $i++) {
            $name = 'USER_user-super_' . ($i + 1);
            $super_users[] = [
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => $default_password,
                'api_token' => str_random(60),
                'status_id' => 1,
            ];
        }

        $this->command->info("Generating normal users ($normal_user_size records) data...");
        $normal_users = [];
        for ($i = 0; $i < $normal_user_size; $i++) {
            $name = 'USER_user-normal_' . ($i + 1);
            $normal_users[] = [
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => $default_password,
                'api_token' => str_random(60),
                'status_id' => 1,
            ];
        }

        $data = array_merge(
            $system_users,
            $dev_users,
            $super_admins,
            $normal_admins,
            $super_users,
            $normal_users
        );

        $this->command->info('Saving all users data (' . count($data) . ' records) into DB...');

        $this->loadDataToTable($data, 'users');
    }

    protected function loadUserStatuses()
    {
        $statuses_data = [
            [
                'name' => 'active',
                'display_name' => [
                    'en' => 'Active',
                    'ru' => 'Активный',
                ],
                'description' => [
                    'en' => 'User have all access for his permissions',
                    'ru' => 'Пользователю доступна вся функциональность системы в рамках его разрешений',
                ],
            ],
            [
                'name' => 'suspended',
                'display_name' => [
                    'en' => 'Suspended',
                    'ru' => 'Приостановлен',
                ],
                'description' => [
                    'en' => 'User was suspended',
                    'ru' => 'Действия пользователя временно ограничены',
                ],
            ],
        ];

        $this->command->info('Saving all user statuses data (' . count($statuses_data) . ' records) into DB...');
        $this->loadDataToTranslatableModel($statuses_data, 'App\Models\UserStatus');
    }
}
