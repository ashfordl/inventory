<?php namespace Inventory\Http\Controllers;

use Auth;
use Inventory\Http\Requests;
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

    public function getItem(Item $item = null)
    {
        $user = Auth::user();

        // All categories, for drop-down category select
        $categories = Category::all();

        if (isset($item))
        {
            // All references (with positive quantity) involving this item
            $references = Reference::allForItem($item->id);

            // All projects without references to this item
            $projects = Project::projectsWithoutItem($item->id);

            // True if there are no spares for the item
            $hasSpares = !Item::itemHasSpares($item->id);
        }

        return view('inventory.item')
            ->with(['user' => $user,
                'item' => $item,
                'categories' => $categories,
                'references' => $references,
                'projects' => $projects,
                'hasSpares' => $hasSpares
            ]);
    }

    public function postItem(Item $item = null)
    {
        dd(\Input::all());
    }
}
