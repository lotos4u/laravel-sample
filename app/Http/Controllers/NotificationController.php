<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Traits\EntityController;

class NotificationController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'notification';
    }

    public function apiReceivers(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiNotificationReceivers',
            'data' => ['notification_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'user', $relation_data);
        return $modelsJson;
    }

}
