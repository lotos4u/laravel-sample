<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Helpers\UserDataHelper;
use App\Models\SettingVariant;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Task;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Traits\EntityController;

class UserController extends Controller
{
    use EntityController;

    public function __construct()
    {
        parent::__construct();
        $this->modelName = 'user';
    }

    /**
     * Show the User profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        return $this->show($user->id);
    }

    /**
     * Show the User with ID=$id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $data = $this->combineDetailsViewDataForModel($this->modelName, $user->toArray());
        return view('entity.show', $data);
    }

    public function updateSettings(Request $request)
    {
        $user = User::getUserFromGuard();
        foreach ($user->settings as $setting) {
            $input_value = $request->input($setting->type->name, 'EMPTY_INPUT');
            if ($input_value !== 'EMPTY_INPUT') {
                $settingValue = SettingVariant::where('name', $input_value)->first();
                if ($settingValue) {
                    $setting->value = $settingValue->value;
                } else {
                    throw new \Exception("Unknown setting '$input_value'");
                }
            }
            $setting->save();
        }
        GeneralHelper::addInfo(__('messages.user_settings_updated'));
        return back()->withInput();
    }

    public function apiRoles(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiUserRoles',
            'data' => ['user_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'role', $relation_data);
        return $modelsJson;
    }

    public function apiTasks(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiUserTasks',
            'data' => ['user_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'task', $relation_data);
        return $modelsJson;
    }

    public function apiSettings(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiUserSettings',
            'data' => ['user_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'setting', $relation_data);
        return $modelsJson;
    }

    public function apiNotifications(Request $request, $id)
    {
        $relation_data = [
            'scope' => 'internalApiUserNotifications',
            'data' => ['user_id' => $id],
        ];
        $modelsJson = $this->getEntityModelsJsonForRequest($request, 'notification', $relation_data);
        return $modelsJson;
    }
}
