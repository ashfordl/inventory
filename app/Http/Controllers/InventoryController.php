<?php namespace Inventory\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
use Inventory\Category;
use Inventory\Item;
use Inventory\Project;
use Inventory\Reference;

class InventoryController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'getIndex']);
    }

    /**
     * Display welcome message for guests or dashboard for users
     *
     * @return Response
     */
    public function getIndex()
    {
        if (Auth::guest())
        {
            // If not logged in, display welcome message
            return view('welcome');
        }
        else
        {
            // If logged in, display user dashboard
            $user = Auth::user();

            $items = Item::selectAllForUser($user->id)
                        ->get();

            $outofstock = Item::selectOutOfStockForUser($user->id)
                        ->get();

            return view('inventory.inventories')
                ->with('user', $user)
                ->with('items', $items)
                ->with('nostock', $outofstock);
        }
    }

    public function getSpares()
    {
        $user = Auth::user();

        $items = Item::selectSparesForUser($user->id)
                    ->get();

        return view('inventory.spares')
            ->with('user', $user)
            ->with('items', $items);
    }
}
