<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        $this->call(UsersTableSeeder::class);
        $this->call(RolesAndPermissionsTableSeeder::class);
        $this->call(TasksSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(NotificationsSeeder::class);
        DB::enableQueryLog();
    }
}
