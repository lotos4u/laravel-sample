<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationStatus;
use App\Traits\EntityController;

class NotificationStatusController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'notification_status';
    }

    public function apiNotifications(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiNotificationStatusNotifications',
            'data' => ['type_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'notification', $relation_data);
        return $modelsJson;
    }
}
