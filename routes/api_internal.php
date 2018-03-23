<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::any('/users', ['uses' => 'UserController@apiIndex', 'middleware' => ['permission:api,user_*']])->name('internal.api.user.index');
Route::any('/users/{id}', ['uses' => 'UserController@apiShow', 'middleware' => ['permission:api,user_*']])->name('internal.api.user.show');
Route::any('/users/{id}/roles', ['uses' => 'UserController@apiRoles', 'middleware' => ['permission:api,user_*']])->name('internal.api.user.roles');
Route::any('/users/{id}/tasks', ['uses' => 'UserController@apiTasks', 'middleware' => ['permission:api,user_*']])->name('internal.api.user.tasks');
Route::any('/users/{id}/settings', ['uses' => 'UserController@apiSettings', 'middleware' => ['permission:api,user_*']])->name('internal.api.user.settings');
Route::any('/users/{id}/notifications', ['uses' => 'UserController@apiNotifications', 'middleware' => ['permission:api,user_*']])->name('internal.api.user.notifications');

Route::any('/user-statuses', ['uses' => 'UserStatusController@apiIndex', 'middleware' => ['permission:api,user_status_*']])->name('internal.api.user_status.index');
Route::any('/user-statuses/{id}', ['uses' => 'UserStatusController@apiShow', 'middleware' => ['permission:api,user_status_*']])->name('internal.api.user_status.show');
Route::any('/user-statuses/{id}/users', ['uses' => 'UserStatusController@apiUsers', 'middleware' => ['permission:api,user_status_*']])->name('internal.api.user_status.users');

Route::any('/roles', ['uses' => 'RoleController@apiIndex', 'middleware' => ['permission:api,role_*']])->name('internal.api.role.index');
Route::any('/roles/{id}', ['uses' => 'RoleController@apiShow', 'middleware' => ['permission:api,role_*']])->name('internal.api.role.show');
Route::any('/roles/{id}/permissions', ['uses' => 'RoleController@apiPermissions', 'middleware' => ['permission:api,role_*']])->name('internal.api.role.permissions');

Route::any('/permissions', ['uses' => 'PermissionController@apiIndex', 'middleware' => ['permission:api,permission_*']])->name('internal.api.permission.index');
Route::any('/permissions/{id}', ['uses' => 'PermissionController@apiShow', 'middleware' => ['permission:api,permission_*']])->name('internal.api.permission.show');
Route::any('/permissions/{id}/roles', ['uses' => 'PermissionController@apiRoles', 'middleware' => ['permission:api,permission_*']])->name('internal.api.permission.roles');

Route::any('/settings', ['uses' => 'SettingController@apiIndex', 'middleware' => ['permission:api,setting_*']])->name('internal.api.setting.index');
Route::any('/settings/{id}', ['uses' => 'SettingController@apiShow', 'middleware' => ['permission:api,setting_*']])->name('internal.api.setting.show');

Route::any('/setting-variants', ['uses' => 'SettingVariantController@apiIndex', 'middleware' => ['permission:api,setting_variant_*']])->name('internal.api.setting_variant.index');
Route::any('/setting-variants/{id}', ['uses' => 'SettingVariantController@apiShow', 'middleware' => ['permission:api,setting_variant_*']])->name('internal.api.setting_variant.show');

Route::any('/setting-types', ['uses' => 'SettingTypeController@apiIndex', 'middleware' => ['permission:api,setting_type_*']])->name('internal.api.setting_type.index');
Route::any('/setting-types/{id}', ['uses' => 'SettingTypeController@apiShow', 'middleware' => ['permission:api,setting_type_*']])->name('internal.api.setting_type.show');
Route::any('/setting-types/{id}/settings', ['uses' => 'SettingTypeController@apiSettings', 'middleware' => ['permission:api,setting_type_*']])->name('internal.api.setting_type.settings');
Route::any('/setting-types/{id}/setting_variants', ['uses' => 'SettingTypeController@apiSettingVariants', 'middleware' => ['permission:api,setting_type_*']])->name('internal.api.setting_type.setting_variants');

Route::any('/tasks', ['uses' => 'TaskController@apiIndex', 'middleware' => ['permission:api,task_*']])->name('internal.api.task.index');
Route::any('/tasks/{id}', ['uses' => 'TaskController@apiShow', 'middleware' => ['permission:api,task_*']])->name('internal.api.task.show');
Route::any('/tasks/{id}/logs', ['uses' => 'TaskController@apiLogs', 'middleware' => ['permission:api,task_*']])->name('internal.api.task.logs');

Route::any('/task-logs', ['uses' => 'TaskLogController@apiIndex', 'middleware' => ['permission:api,task_log_*']])->name('internal.api.task_log.index');
Route::any('/task-logs/{id}', ['uses' => 'TaskLogController@apiShow', 'middleware' => ['permission:api,task_log_*']])->name('internal.api.task_log.show');

Route::any('/task-types', ['uses' => 'TaskTypeController@apiIndex', 'middleware' => ['permission:api,task_type_*']])->name('internal.api.task_type.index');
Route::any('/task-types/{id}', ['uses' => 'TaskTypeController@apiShow', 'middleware' => ['permission:api,task_type_*']])->name('internal.api.task_type.show');
Route::any('/task-types/{id}/tasks', ['uses' => 'TaskTypeController@apiTasks', 'middleware' => ['permission:api,task_type_*']])->name('internal.api.task_type.tasks');

Route::any('/notifications', ['uses' => 'NotificationController@apiIndex', 'middleware' => ['permission:api,notification_*']])->name('internal.api.notification.index');
Route::any('/notifications/{id}', ['uses' => 'NotificationController@apiShow', 'middleware' => ['permission:api,notification_*']])->name('internal.api.notification.show');
Route::any('/notifications/{id}/receivers', ['uses' => 'NotificationController@apiReceivers', 'middleware' => ['permission:api,notification_*']])->name('internal.api.notification.receivers');

Route::any('/notification-types', ['uses' => 'NotificationTypeController@apiIndex', 'middleware' => ['permission:api,notification_type_*']])->name('internal.api.notification_type.index');
Route::any('/notification-types/{id}', ['uses' => 'NotificationTypeController@apiShow', 'middleware' => ['permission:api,notification_type_*']])->name('internal.api.notification_type.show');
Route::any('/notification-types/{id}/notifications', ['uses' => 'NotificationTypeController@apiNotifications', 'middleware' => ['permission:api,notification_type_*']])->name('internal.api.notification_type.notifications');

Route::any('/notification-statuses', ['uses' => 'NotificationStatusController@apiIndex', 'middleware' => ['permission:api,notification_status_*']])->name('internal.api.notification_status.index');
Route::any('/notification-statuses/{id}', ['uses' => 'NotificationStatusController@apiShow', 'middleware' => ['permission:api,notification_status_*']])->name('internal.api.notification_status.show');
Route::any('/notification-statuses/{id}/notifications', ['uses' => 'NotificationStatusController@apiNotifications', 'middleware' => ['permission:api,notification_status_*']])->name('internal.api.notification_status.notifications');
