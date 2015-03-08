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

    public function getProject(Project $project)
    {
        $user = Auth::user();

        $references = Item::selectAllForProject($project->id)
                    ->get();

        return view('inventory.project')
            ->with(['user' => $user,
                'project' => $project,
                'references' => $references]);
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

    public function postItem(Request $request)
    {
        $this->validate($request, [
            'id' => 'required | valueOrExists:-1,items,id',
            'name' => 'required | max:255',
            'category_id' => 'required | exists:categories,id',
            'references.project_id' => 'required_with:references.quantity | exists:projects,id',
            'references.quantity' => 'required_with:references.id | exists:projects,id'
        ]);

        // TODO existsForUser: new validator to restrict exists with a where clause
        $data = \Input::all();

        $item;
        if ($data['id'] == -1)
        {
            $item = new Item;
        }
        else
        {
            $item = Item::find(['id' => $data['id']])->first();
        }

        $item->name = $data['name'];
        $item->user_id = Auth::user()->id;
        $item->category_id = $data['category_id'];
        $item->save();


        if (isset($data['references']))
        {
            foreach($data['references'] as $reference)
            {
                $proj_id = $reference['project_id'] == -1 ? null : $reference['project_id'];

                $ref_model = Reference::firstOrNew(['item_id' => $item->id,
                                            'project_id' => $proj_id]);
                $ref_model->quantity = $reference['quantity'];
                $ref_model->save();
            }
        }

        // Echo URL to item page, so that user can be redirected away from /item/new
        echo route("item_get", $item->id);
    }
}
