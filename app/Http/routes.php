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

Route::get('/', ['as' => 'home', 'uses' => 'InventoryController@getIndex']);

Route::get('project/{project}', ['as' => 'project', 'uses' => 'InventoryController@getProject']);
Route::get('spares', ['as' => 'spares', 'uses' => 'InventoryController@getSpares']);

Route::get('item/new', ['as' => 'item_new', 'uses' => 'InventoryController@getItem']);
Route::get('item/{item}', ['as' => 'item_get', 'uses' => 'InventoryController@getItem']);

Route::post('item', ['as' => 'item_post', 'uses' => 'InventoryController@postItem']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	// 'password' => 'Auth\PasswordController',
]);
