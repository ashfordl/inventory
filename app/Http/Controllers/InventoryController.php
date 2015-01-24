<?php namespace Inventory\Http\Controllers;

use Auth;
use Inventory\Http\Requests;
use Inventory\Http\Controllers\Controller;
use Inventory\Item;
use Inventory\Project;

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

    public function getProject(Project $project)
    {
        $user = Auth::user();

        $references = Item::selectAllForProject($project->id)
                    ->get();

        return view('inventory.project')
            ->with('user', $user)
            ->with('references', $references);
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
