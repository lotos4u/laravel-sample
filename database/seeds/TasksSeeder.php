<?php

use App\Models\User;
use App\Models\Task;
use App\Models\TaskLog;

class TasksSeeder extends BasicSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'shell_command',
                'display_name' => [
                    'en' => 'Shell command',
                    'ru' => 'Запуск команды',
                ],
                'description' => [
                    'en' => 'Run shell command',
                    'ru' => 'Запустить команду оболочки',
                ],
            ],
            [
                'name' => 'email_send',
                'display_name' => [
                    'en' => 'Email send',
                    'ru' => 'Отправка электронного письма',
                ],
                'description' => [
                    'en' => 'Email send',
                    'ru' => 'Отправка электронного письма',
                ],
            ],
            [
                'name' => 'email_receive',
                'display_name' => [
                    'en' => 'Email receive',
                    'ru' => 'Получение электронной почты',
                ],
                'description' => [
                    'en' => 'Email receive',
                    'ru' => 'Получение электронной почты',
                ],
            ],
            [
                'name' => 'http_receive',
                'display_name' => [
                    'en' => 'Get URL contents',
                    'ru' => 'Получить данные по URL',
                ],
                'description' => [
                    'en' => 'Get contents from the specified URL destination',
                    'ru' => 'Получить содержимое по указанному URL',
                ],
            ],
        ];

        $this->command->info('Creating task types...');
        $task_types = $this->loadDataToTranslatableModel($data, 'App\Models\TaskType');

        $this->command->info('Creating tasks for all users...');
        $users = User::all();
        $numberOfTasks = 10;
        $numberOfLogs = 10;
        foreach ($users as $user) {
            for ($i = 0; $i < $numberOfTasks; $i++) {
                foreach ($task_types as $task_type) {
                    $task = new Task();
                    $task->name = $task_type->name . ' ' . rand(1, 100000);
                    $task->type_id = $task_type->id;
                    $task->user_id = $user->id;
                    $task->data = 'Some data for ' . $task_type->name . '...';
                    $task->created_at = date("Y-m-d H:i:s");
                    $task->save();

                    for ($j = 0; $j < $numberOfLogs; $j++) {
                        $taskLog = new TaskLog();
                        $taskLog->task_id = $task->id;
                        $taskLog->data = 'log #' . ($j + 1) . ' for task #' . $task->id . '...';
                        $taskLog->created_at = date("Y-m-d H:i:s");
                        $taskLog->save();
                    }
                }
            }
        }
    }
}
