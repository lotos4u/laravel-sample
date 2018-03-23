<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\SettingVariant;
use App\Models\Task;
use App\Models\User;
use App\Scopes\TranslationsScope;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserDataHelper
{
    public static function userCanAny($expression, $permissions = null)
    {
        if (!$permissions) {
            $user_data = Session::get(config('settings.key'));
            if (!$user_data) {
                $user_data = self::getUserSharedData(true);
            }
            $permissions = $user_data['user_permissions'];
        }
        if (!is_array($expression)) {
            $permissions_array = explode('|', $expression);
            if (count($permissions_array) > 1) {
                $expression = $permissions_array;
            } else {
                $expression = [$expression];
            }
        }
        foreach ($expression as $item) {
            $parts = explode('*', $item);
            if (count($parts) === 1) {
                $slug = $item;
                foreach ($permissions as $permission) {
                    if ($permission == $slug) {
                        return true;
                    }
                }
            } else {
                $slug = $parts[0];
                foreach ($permissions as $permission) {
                    if (false !== mb_strpos($permission, $slug)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private static function getUserSettingsFormData(array $user_settings)
    {
        $settings_form_data = [];
        foreach ($user_settings as $setting_key => $user_setting) {
            $values = SettingVariant::getSettingsVariants($setting_key);
            $prepared_values = [];
            foreach ($values->toArray() as $value_key => $value) {
                $prepared_values[$value['name']] = $value['name'];
            }
            $settings_form_data[$setting_key] = [
                'values' => $prepared_values,
                'current' => $user_settings[$setting_key]['value'],
            ];
        }
        return $settings_form_data;
    }

    private static function updateUserSharedData()
    {
        $current_user = User::getUserFromGuard();
        $user_id = $current_user->id;
        $colors = UserDataHelper::themeColors();
        $rowsPerPage = UserDataHelper::rowsPerPageOptions();
        $settings = Setting::getUserSettings($user_id)->toArray();
        $user_settings = [];
        foreach ($settings as $setting) {
            $user_settings[$setting['name']] = $setting;
        }
        $settings_form_data = self::getUserSettingsFormData($user_settings);

        $user_permissions = Permission::getUserPermissions($user_id)->toArray();
        $user_locale = App::getLocale();
        $theme_name = $user_settings['theme_name']['value'];
        $timeout = config('settings.temporary_messages_timeout');

        $user_notifications = Notification::getUserReceivedUnreadNotifications($user_id)->toArray();

        $user_tasks = Task::getUserTasks($user_id)->toArray();

        $data = [
            'api_token' => $current_user->api_token,
            'user_permissions' => $user_permissions,
            'user_settings' => $user_settings,
            'user_notifications' => $user_notifications,
            'user_tasks' => $user_tasks,
            'user_locale' => $user_locale,
            'theme_colors' => $colors,
            'rows_per_page_options' => $rowsPerPage,
            'theme_name' => $theme_name,
            'settings_form_data' => $settings_form_data,
            'temporary_messages_timeout' => $timeout,
        ];
        return $data;
    }

    public static function getUserSharedData($forceUpdate = false)
    {
        $key = config('settings.key');
        $data = Session::get($key);
        if (!$data || $forceUpdate) {
            $data = self::updateUserSharedData();
            Session::put($key, $data);
        }
        return $data;
    }

    public static function themeColors()
    {
        $variants_rows = SettingVariant::getThemeColors()->toArray();
        $themes = [];
        foreach ($variants_rows as $v) {
            $theme = $v['value'];
            $color_arr = explode('-', $theme);
            if (count($color_arr) === 2) {
                $color = $color_arr[1];
                $themes[] = [
                    'internal_name' => $theme,
                    'display_name' => ucwords($color),
                    'form_name' => $color,
                ];
            }
        }
        return $themes;
    }

    public static function rowsPerPageOptions()
    {
        $variants_rows = SettingVariant::getRowsPerPages()->toArray();
        $numbers = [];
        foreach ($variants_rows as $v) {
            $numbers[] = $v['name'];
        }
        return $numbers;
    }
}