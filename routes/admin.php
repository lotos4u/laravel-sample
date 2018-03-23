<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses' => 'HomeController@index'])->name('home');

Route::get('/users', ['uses' => 'UserController@index', 'middleware' => ['permission:web,user_*']])->name('user.index');
Route::get('/users/new', ['uses' => 'UserController@new', 'middleware' => ['permission:web,user_create*']])->name('user.new');
Route::post('/users/create', ['uses' => 'UserController@create', 'middleware' => ['permission:web,user_create*']])->name('user.create');
Route::get('/users/profile', ['uses' => 'UserController@profile', 'middleware' => ['permission:web,user_*']])->name('user.profile');
Route::any('/users/settings/update', ['uses' => 'UserController@updateSettings', 'middleware' => ['permission:web,user_*']])->name('user.settings.update');
Route::get('/users/{id}/settings', ['uses' => 'UserController@settings', 'middleware' => ['permission:web,user_*']])->name('user.settings');
Route::get('/users/{user_id}/settings/{setting_id}', ['uses' => 'UserController@setting', 'middleware' => ['permission:web,user_*']])->name('user.setting');
Route::get('/users/{id}/edit', ['uses' => 'UserController@edit', 'middleware' => ['permission:web,user_*']])->name('user.edit');
Route::post('/users/{id}/delete', ['uses' => 'UserController@delete', 'middleware' => ['permission:web,user_delete*']])->name('user.delete');
Route::post('/users/{id}/update', ['uses' => 'UserController@update', 'middleware' => ['permission:web,user_update*']])->name('user.update');
Route::get('/users/{id}', ['uses' => 'UserController@show', 'middleware' => ['permission:web,user_*']])->name('user.show');

Route::get('/user-statuses', ['uses' => 'UserStatusController@index', 'middleware' => ['permission:web,user_status_*']])->name('user_status.index');
Route::get('/user-statuses/new', ['uses' => 'UserStatusController@new', 'middleware' => ['permission:web,user_status_create*']])->name('user_status.new');
Route::post('/user-statuses/create', ['uses' => 'UserStatusController@create', 'middleware' => ['permission:web,user_status_create*']])->name('user_status.create');
Route::get('/user-statuses/{id}', ['uses' => 'UserStatusController@show', 'middleware' => ['permission:web,user_status_read*']])->name('user_status.show');
Route::get('/user-statuses/{id}/edit', ['uses' => 'UserStatusController@edit', 'middleware' => ['permission:web,user_status_update*']])->name('user_status.edit');
Route::post('/user-statuses/{id}/delete', ['uses' => 'UserStatusController@delete', 'middleware' => ['permission:web,user_status_delete*']])->name('user_status.delete');
Route::post('/user-statuses/{id}/update', ['uses' => 'UserStatusController@update', 'middleware' => ['permission:web,user_status_update*']])->name('user_status.update');

Route::get('/roles', ['uses' => 'RoleController@index', 'middleware' => ['permission:web,role_*']])->name('role.index');
Route::get('/roles/new', ['uses' => 'RoleController@new', 'middleware' => ['permission:web,role_create*']])->name('role.new');
Route::post('/roles/create', ['uses' => 'RoleController@create', 'middleware' => ['permission:web,role_create*']])->name('role.create');
Route::get('/roles/{id}', ['uses' => 'RoleController@show', 'middleware' => ['permission:web,role_read*']])->name('role.show');
Route::get('/roles/{id}/edit', ['uses' => 'RoleController@edit', 'middleware' => ['permission:web,role_update*']])->name('role.edit');
Route::post('/roles/{id}/delete', ['uses' => 'RoleController@delete', 'middleware' => ['permission:web,role_delete*']])->name('role.delete');
Route::post('/roles/{id}/update', ['uses' => 'RoleController@update', 'middleware' => ['permission:web,role_update*']])->name('role.update');

Route::get('/permissions', ['uses' => 'PermissionController@index', 'middleware' => ['permission:web,permission_*']])->name('permission.index');
Route::get('/permissions/new', ['uses' => 'PermissionController@new', 'middleware' => ['permission:web,permission_create*']])->name('permission.new');
Route::post('/permissions/create', ['uses' => 'PermissionController@create', 'middleware' => ['permission:web,permission_create*']])->name('permission.create');
Route::get('/permissions/{id}', ['uses' => 'PermissionController@show', 'middleware' => ['permission:web,permission_read*']])->name('permission.show');
Route::get('/permissions/{id}/edit', ['uses' => 'PermissionController@edit', 'middleware' => ['permission:web,permission_update*']])->name('permission.edit');
Route::post('/permissions/{id}/delete', ['uses' => 'PermissionController@delete', 'middleware' => ['permission:web,permission_delete*']])->name('permission.delete');
Route::post('/permissions/{id}/update', ['uses' => 'PermissionController@update', 'middleware' => ['permission:web,permission_update*']])->name('permission.update');

Route::get('/tasks', ['uses' => 'TaskController@index', 'middleware' => ['permission:web,task_*']])->name('task.index');
Route::get('/tasks/new', ['uses' => 'TaskController@new', 'middleware' => ['permission:web,task_create*']])->name('task.new');
Route::post('/tasks/create', ['uses' => 'TaskController@create', 'middleware' => ['permission:web,task_create*']])->name('task.create');
Route::get('/tasks/{id}', ['uses' => 'TaskController@show', 'middleware' => ['permission:web,task_read*']])->name('task.show');
Route::get('/tasks/{id}/edit', ['uses' => 'TaskController@edit', 'middleware' => ['permission:web,task_update*']])->name('task.edit');
Route::post('/tasks/{id}/delete', ['uses' => 'TaskController@delete', 'middleware' => ['permission:web,task_delete*']])->name('task.delete');
Route::post('/tasks/{id}/update', ['uses' => 'TaskController@update', 'middleware' => ['permission:web,task_update*']])->name('task.update');

Route::get('/task-logs', ['uses' => 'TaskLogController@index', 'middleware' => ['permission:web,task_log_*']])->name('task_log.index');
Route::get('/task-logs/new', ['uses' => 'TaskLogController@new', 'middleware' => ['permission:web,task_log_create*']])->name('task_log.new');
Route::post('/task-logs/create', ['uses' => 'TaskLogController@create', 'middleware' => ['permission:web,task_log_create*']])->name('task_log.create');
Route::get('/task-logs/{id}', ['uses' => 'TaskLogController@show', 'middleware' => ['permission:web,task_log_read*']])->name('task_log.show');
Route::get('/task-logs/{id}/edit', ['uses' => 'TaskLogController@edit', 'middleware' => ['permission:web,task_log_update*']])->name('task_log.edit');
Route::post('/task-logs/{id}/delete', ['uses' => 'TaskLogController@delete', 'middleware' => ['permission:web,task_log_delete*']])->name('task_log.delete');
Route::post('/task-logs/{id}/update', ['uses' => 'TaskLogController@update', 'middleware' => ['permission:web,task_log_update*']])->name('task_log.update');

Route::get('/task-types', ['uses' => 'TaskTypeController@index', 'middleware' => ['permission:web,task_type_*']])->name('task_type.index');
Route::get('/task-types/new', ['uses' => 'TaskTypeController@new', 'middleware' => ['permission:web,task_type_create*']])->name('task_type.new');
Route::post('/task-types/create', ['uses' => 'TaskTypeController@create', 'middleware' => ['permission:web,task_type_create*']])->name('task_type.create');
Route::get('/task-types/{id}', ['uses' => 'TaskTypeController@show', 'middleware' => ['permission:web,task_type_read*']])->name('task_type.show');
Route::get('/task-types/{id}/edit', ['uses' => 'TaskTypeController@edit', 'middleware' => ['permission:web,task_type_update*']])->name('task_type.edit');
Route::post('/task-types/{id}/delete', ['uses' => 'TaskTypeController@delete', 'middleware' => ['permission:web,task_type_delete*']])->name('task_type.delete');
Route::post('/task-types/{id}/update', ['uses' => 'TaskTypeController@update', 'middleware' => ['permission:web,task_type_update*']])->name('task_type.update');

Route::get('/settings', ['uses' => 'SettingController@index', 'middleware' => ['permission:web,setting_*']])->name('setting.index');
Route::post('/settings/theme', ['uses' => 'SettingController@theme', 'middleware' => ['permission:web,setting_update*']])->name('setting.theme');
Route::get('/settings/new', ['uses' => 'SettingController@new', 'middleware' => ['permission:web,setting_create*']])->name('setting.new');
Route::post('/settings/create', ['uses' => 'SettingController@create', 'middleware' => ['permission:web,setting_create*']])->name('setting.create');
Route::get('/settings/{id}', ['uses' => 'SettingController@show', 'middleware' => ['permission:web,setting_read*']])->name('setting.show');
Route::get('/settings/{id}/edit', ['uses' => 'SettingController@edit', 'middleware' => ['permission:web,setting_update*']])->name('setting.edit');
Route::post('/settings/{id}/delete', ['uses' => 'SettingController@delete', 'middleware' => ['permission:web,setting_delete*']])->name('setting.delete');
Route::post('/settings/{id}/update', ['uses' => 'SettingController@update', 'middleware' => ['permission:web,setting_update*']])->name('setting.update');

Route::get('/setting-types', ['uses' => 'SettingTypeController@index', 'middleware' => ['permission:web,setting_type_*']])->name('setting_type.index');
Route::get('/setting-types/new', ['uses' => 'SettingTypeController@new', 'middleware' => ['permission:web,setting_type_create*']])->name('setting_type.new');
Route::post('/setting-types/create', ['uses' => 'SettingTypeController@create', 'middleware' => ['permission:web,setting_type_create*']])->name('setting_type.create');
Route::get('/setting-types/{id}', ['uses' => 'SettingTypeController@show', 'middleware' => ['permission:web,setting_type_read*']])->name('setting_type.show');
Route::get('/setting-types/{id}/edit', ['uses' => 'SettingTypeController@edit', 'middleware' => ['permission:web,setting_type_update*']])->name('setting_type.edit');
Route::post('/setting-types/{id}/delete', ['uses' => 'SettingTypeController@delete', 'middleware' => ['permission:web,setting_type_delete*']])->name('setting_type.delete');
Route::post('/setting-types/{id}/update', ['uses' => 'SettingTypeController@update', 'middleware' => ['permission:web,setting_type_update*']])->name('setting_type.update');

Route::get('/setting-variants', ['uses' => 'SettingVariantController@index', 'middleware' => ['permission:web,setting_variant_*']])->name('setting_variant.index');
Route::get('/setting-variants/new', ['uses' => 'SettingVariantController@new', 'middleware' => ['permission:web,setting_variant_create*']])->name('setting_variant.new');
Route::post('/setting-variants/create', ['uses' => 'SettingVariantController@create', 'middleware' => ['permission:web,setting_variant_create*']])->name('setting_variant.create');
Route::get('/setting-variants/{id}', ['uses' => 'SettingVariantController@show', 'middleware' => ['permission:web,setting_variant_read*']])->name('setting_variant.show');
Route::get('/setting-variants/{id}/edit', ['uses' => 'SettingVariantController@edit', 'middleware' => ['permission:web,setting_variant_update*']])->name('setting_variant.edit');
Route::post('/setting-variants/{id}/delete', ['uses' => 'SettingVariantController@delete', 'middleware' => ['permission:web,setting_variant_delete*']])->name('setting_variant.delete');
Route::post('/setting-variants/{id}/update', ['uses' => 'SettingVariantController@update', 'middleware' => ['permission:web,setting_variant_update*']])->name('setting_variant.update');

Route::get('/notifications', ['uses' => 'NotificationController@index', 'middleware' => ['permission:web,notification_*']])->name('notification.index');
Route::get('/notifications/new', ['uses' => 'NotificationController@new', 'middleware' => ['permission:web,notification_create*']])->name('notification.new');
Route::post('/notifications/create', ['uses' => 'NotificationController@create', 'middleware' => ['permission:web,notification_create*']])->name('notification.create');
Route::get('/notifications/{id}', ['uses' => 'NotificationController@show', 'middleware' => ['permission:web,notification_read*']])->name('notification.show');
Route::get('/notifications/{id}/edit', ['uses' => 'NotificationController@edit', 'middleware' => ['permission:web,notification_update*']])->name('notification.edit');
Route::post('/notifications/{id}/delete', ['uses' => 'NotificationController@delete', 'middleware' => ['permission:web,notification_delete*']])->name('notification.delete');
Route::post('/notifications/{id}/update', ['uses' => 'NotificationController@update', 'middleware' => ['permission:web,notification_update*']])->name('notification.update');

Route::get('/notification-types', ['uses' => 'NotificationTypeController@index', 'middleware' => ['permission:web,notification_type_*']])->name('notification_type.index');
Route::get('/notification-types/new', ['uses' => 'NotificationTypeController@new', 'middleware' => ['permission:web,notification_type_create*']])->name('notification_type.new');
Route::post('/notification-types/create', ['uses' => 'NotificationTypeController@create', 'middleware' => ['permission:web,notification_type_create*']])->name('notification_type.create');
Route::get('/notification-types/{id}', ['uses' => 'NotificationTypeController@show', 'middleware' => ['permission:web,notification_type_read*']])->name('notification_type.show');
Route::get('/notification-types/{id}/edit', ['uses' => 'NotificationTypeController@edit', 'middleware' => ['permission:web,notification_type_update*']])->name('notification_type.edit');
Route::post('/notification-types/{id}/delete', ['uses' => 'NotificationTypeController@delete', 'middleware' => ['permission:web,notification_type_delete*']])->name('notification_type.delete');
Route::post('/notification-types/{id}/update', ['uses' => 'NotificationTypeController@update', 'middleware' => ['permission:web,notification_type_update*']])->name('notification_type.update');

Route::get('/notification-statuses', ['uses' => 'NotificationStatusController@index', 'middleware' => ['permission:web,notification_status_*']])->name('notification_status.index');
Route::get('/notification-statuses/new', ['uses' => 'NotificationStatusController@new', 'middleware' => ['permission:web,notification_status_create*']])->name('notification_status.new');
Route::post('/notification-statuses/create', ['uses' => 'NotificationStatusController@create', 'middleware' => ['permission:web,notification_status_create*']])->name('notification_status.create');
Route::get('/notification-statuses/{id}', ['uses' => 'NotificationStatusController@show', 'middleware' => ['permission:web,notification_status_read*']])->name('notification_status.show');
Route::get('/notification-statuses/{id}/edit', ['uses' => 'NotificationStatusController@edit', 'middleware' => ['permission:web,notification_status_update*']])->name('notification_status.edit');
Route::post('/notification-statuses/{id}/delete', ['uses' => 'NotificationStatusController@delete', 'middleware' => ['permission:web,notification_status_delete*']])->name('notification_status.delete');
Route::post('/notification-statuses/{id}/update', ['uses' => 'NotificationStatusController@update', 'middleware' => ['permission:web,notification_status_update*']])->name('notification_status.update');
