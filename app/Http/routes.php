<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
	'as'	=> 'index', 
	'uses'	=> 'HomeController@index',
]);

Route::get('login', [
	'as'	=> 'login', 
	'uses'	=> 'Auth\AuthController@getLogin',
]);

Route::post('login/attempt', [
	'as'	=> 'login.attempt', 
	'uses'	=> 'Auth\AuthController@postLogin',
]);

Route::get('logout', [
	'as'	=> 'logout', 
	'uses'	=> 'Auth\AuthController@getLogout',
]);

Route::resource('stations', 'StationController');
Route::resource('trains', 'TrainController');
Route::resource('operators', 'OperatoController');
Route::resource('schedules', 'ScheduleController');