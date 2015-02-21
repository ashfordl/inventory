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

Route::model('user', 'Inventory\User');
Route::model('project', 'Inventory\Project');
Route::model('item', 'Inventory\Item');

Route::get('/', 'InventoryController@getIndex');

Route::get('project/{project}', 'InventoryController@getProject');
Route::get('spares', 'InventoryController@getSpares');

Route::get('item/new', 'InventoryController@getItem');
Route::get('item/{item}', 'InventoryController@getItem');

Route::post('item', 'InventoryController@postItem');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
