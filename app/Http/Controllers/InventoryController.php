<?php namespace Inventory\Http\Controllers;

use Inventory\Http\Requests;
use Inventory\Http\Controllers\Controller;
use Inventory\Project;

class InventoryController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'getIndex']);
    }

	/**
	 * Show a list of
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        if (\Auth::guest())
        {
            // If not logged in, display welcome message
            return view('welcome');
        }
        else
        {
            // If logged in, display user dashboard
            return view('inventory.inventories')
                ->with('user', \Auth::user());
        }
	}

    public function getInventory()
    {
        echo "all components";
    }

    public function getProject(Project $project)
    {
        echo "components of ";
        echo $project->name;
    }

    public function getSpares()
    {
        echo "spare components";
    }
}
