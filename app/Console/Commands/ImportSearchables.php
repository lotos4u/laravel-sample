<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportSearchables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:searchables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update indecies for searchable models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Updating searchables indecies...");
        $searchables = [
            'App\\Models\\Role',
            'App\\Models\\Permission',
            'App\\Models\\Task',
            'App\\Models\\TaskType',
            'App\\Models\\User',
            'App\\Models\\UserStatus',
            'App\\Models\\Notification',
            'App\\Models\\NotificationType',
            'App\\Models\\Setting',
            'App\\Models\\SettingType',
            'App\\Models\\SettingVariant',
        ];
        foreach ($searchables as $model) {
            $this->call('scout:import', ['model' => $model]);
            $this->call('scout:mysql-index', ['model' => $model]);
        }
        $this->info("Success!");
    }
}
