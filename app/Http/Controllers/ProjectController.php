<?php namespace Inventory\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Inventory\Http\Controllers\Controller;
use Inventory\Category;
use Inventory\Item;
use Inventory\Project;
use Inventory\Reference;

class ProjectController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
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
}
