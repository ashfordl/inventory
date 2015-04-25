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
Route::get('spares', ['as' => 'spares', 'uses' => 'InventoryController@getSpares']);

Route::get('project/{project}', ['as' => 'project_get', 'uses' => 'ProjectController@getProject']);
Route::post('project', ['as' => 'project_post', 'uses' => 'ProjectController@postProject']);

Route::get('item/new', ['as' => 'item_new', 'uses' => 'ItemController@getItem']);
Route::get('item/{item}', ['as' => 'item_get', 'uses' => 'ItemController@getItem']);
Route::post('item', ['as' => 'item_post', 'uses' => 'ItemController@postItem']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	// 'password' => 'Auth\PasswordController',
]);
