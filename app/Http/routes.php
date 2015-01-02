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

$router->get('/', 'InventoryController@getIndex');

Route::get('/{id}', 'InventoryController@getInventory', array());

Route::get('seed', function()
{
    $user = new \Inventory\User();
    $user->name = 'Quatermaster';
    $user->password = Hash::make('password');
    $user->email = 'quater@mast.er';
    $user->save();

    $inventory = new \Inventory\Inventory();
    $inventory->name = 'Electronic Components';
    $inventory->user()->associate($user);
    $inventory->save();

    $category = new \Inventory\Category();
    $category->name = 'MOSFETs';
    $category->inventory()->associate($inventory);
    $category->save();

    $location = new \Inventory\Location();
    $location->name = 'Repurposed Ice Cream Tub';
    $location->inventory()->associate($inventory);
    $location->save();

    $item = new \Inventory\Item();
    $item->name = 'IRZ44N';
    $item->quantity = 10;
    $item->category()->associate($category);
    $item->location()->associate($location);
    $item->save();

    echo "Data seeded successfully. 5 inserts, 0 updates, 0 deletions.";
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
