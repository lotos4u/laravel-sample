<?php

use Illuminate\Database\Seeder;
use App\Models\NotificationType;
use App\Models\NotificationUser;
use App\Models\Notification;
use App\Models\User;

class NotificationsSeeder extends BasicSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification_types_data = [
            [
                'name' => 'email',
                'display_name' => [
                    'en' => 'E-mail',
                    'ru' => 'E-mail',
                ],
                'description' => [
                    'en' => 'Send e-mail to specified users',
                    'ru' => 'Отправка электронного письма указанным пользователям',
                ],
            ],
            [
                'name' => 'sms',
                'display_name' => [
                    'en' => 'SMS',
                    'ru' => 'SMS',
                ],
                'description' => [
                    'en' => 'Send SMS to specified users',
                    'ru' => 'Отправка SMS-сообщения указанным пользователям',
                ],
            ],
            [
                'name' => 'message',
                'display_name' => [
                    'en' => 'Internal message',
                    'ru' => 'Внутреннее сообщение',
                ],
                'description' => [
                    'en' => 'Send internal instant message to specified users',
                    'ru' => 'Отправка внутреннего мгновенного сообщения указанным пользователям',
                ],
            ],
        ];

        $notification_statuses_data = [
            [
                'name' => 'created',
                'display_name' => [
                    'en' => 'Created',
                    'ru' => 'Создано',
                ],
                'description' => [
                    'en' => 'Notification was just created and nothing else',
                    'ru' => 'Уведомление создано, никаких других действий с ним не произошло',
                ],
            ],
            [
                'name' => 'sent',
                'display_name' => [
                    'en' => 'Sent',
                    'ru' => 'Отправлено',
                ],
                'description' => [
                    'en' => 'Notification was sent',
                    'ru' => 'Уведомление было отправлено',
                ],
            ],
            [
                'name' => 'received',
                'display_name' => [
                    'en' => 'Received',
                    'ru' => 'Получено',
                ],
                'description' => [
                    'en' => 'Notification was received',
                    'ru' => 'Уведомление было получено адресатом',
                ],
            ],
            [
                'name' => 'archived',
                'display_name' => [
                    'en' => 'Archived',
                    'ru' => 'Архивировано',
                ],
                'description' => [
                    'en' => 'Notification was marked as archived',
                    'ru' => 'Уведомление было помечено как архивное',
                ],
            ],
            [
                'name' => 'error',
                'display_name' => [
                    'en' => 'Error occured',
                    'ru' => 'Произошел сбой',
                ],
                'description' => [
                    'en' => 'During the notification processing some error occurred',
                    'ru' => 'В процессе обработки уведомления произошла ошибка',
                ],
            ],
        ];

        $this->command->info('Creating notification types...');
        $notification_types = $this->loadDataToTranslatableModel($notification_types_data, 'App\Models\NotificationType');

        $this->command->info('Creating notification statuses...');
        $notification_statuses = $this->loadDataToTranslatableModel($notification_statuses_data, 'App\Models\NotificationStatus');

        $this->command->info('Creating notifications for all users...');
        $users = User::all();
        foreach ($notification_types as $notification_type) {
            foreach ($notification_statuses as $notification_status) {
                foreach ($users as $user) {
                    $notification = new Notification();
                    $notification->type_id = $notification_type->id;
                    $notification->sender_id = $user->id;
                    $notification->subject = 'Some subject ' . rand(1, 99) * rand(1, 99) * rand(1, 99) * rand(1, 99);
                    $notification->text = 'Some text ' . rand(1, 99) * rand(1, 99) * rand(1, 99) * rand(1, 99);
                    $notification->created_at = date("Y-m-d H:i:s");
                    $notification->updated_at = date("Y-m-d H:i:s");
                    $notification->save();

                    for ($toUserId = 1; $toUserId <= 10; $toUserId++) {
                        if ($toUserId == $user->id) continue;
                        $notification_user = new NotificationUser();
                        $notification_user->status_id = $notification_status->id;
                        $notification_user->user_id = $toUserId;
                        $notification_user->notification_id = $notification->id;
                        $notification_user->save();
                    }
                }
            }
        }

    }
}
