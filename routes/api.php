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

Route::any('/menu', ['uses' => 'ApiController@menu'])->name('external.api.frontend.menu');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('users', function () {
//    return \App\Models\User::all()->toJson();
//})
//    ->middleWare('auth:api')
//    ->middleware('auth.basic.once')
//;




//Route::get('users/{user}', function (App\Models\User $user) {
//    return $user->api()->first()->toJson();
//});

//Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
//    Route::post('/short', 'UrlMapperController@store');
//});
//Route::get('/users', ['uses' => 'UserController@apiIndex', 'middleware' => 'auth:api'])->name('api.user.index');
//Route::get('/users/{user}', ['uses' => 'UserController@apiShow', 'middleware' => 'auth:api'])->name('api.user.show');