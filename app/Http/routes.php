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

Route::get('/', 'InventoryController@getIndex');

Route::get('inventory', 'InventoryController@getInventory');

Route::get('project/{project}', 'InventoryController@getProject');

Route::get('spares', 'InventoryController@getSpares');

Route::get('seed', function()
{
    $user = new \Inventory\User();
    $user->name = 'Quatermaster';
    $user->password = Hash::make('password');
    $user->email = 'quater@mast.er';
    $user->save();

    $category = new \Inventory\Category();
    $category->name = 'MOSFETs';
    $category->user()->associate($user);
    $category->save();

    $item = new \Inventory\Item();
    $item->name = 'IRZ44N';
    $item->user()->associate($user);
    $item->category()->associate($category);
    $item->save();

    $project = new \Inventory\Project();
    $project->name = 'Motor Driver Board';
    $project->user()->associate($user);
    $project->save();

    $reference1 = new \Inventory\Reference();
    $reference1->quantity = 6;
    $reference1->item()->associate($item);
    $reference1->project_id = null;
    $reference1->save();

    $reference2 = new \Inventory\Reference();
    $reference2->quantity = 4;
    $reference2->item()->associate($item);
    $reference2->project()->associate($project);
    $reference2->save();

    echo "Data seeded successfully. 6 inserts, 0 updates, 0 deletions.";
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
