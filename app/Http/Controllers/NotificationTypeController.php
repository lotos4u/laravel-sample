<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationType;
use App\Traits\EntityController;

class NotificationTypeController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'notification_type';
    }

    public function apiNotifications(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiNotificationTypeNotifications',
            'data' => ['type_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'notification', $relation_data);
        return $modelsJson;
    }
}
