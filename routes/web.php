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

Route::get('/test', ['uses' => 'HomeController@test'])->name('test');

Auth::routes();

Route::get('/enter', 'HomeController@enter')->name('enter');
Route::get('/{locale}', 'LocaleController@locale')->name('locale');


