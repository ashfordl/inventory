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

    public function postProject(Request $request)
    {
        $this->validate($request, [
            'id' => 'required | valueOrExists:-1,projects,id',
            'name' => 'required | max:255'
        ]);

        $data = \Input::all();

        $project = $data['id'] == -1
                        ? new Project
                        : Project::find(['id' => $data['id']])->first();

        $project->name = $data['name'];
        $project->user()->associate(Auth::user());
        $project->save();

        return redirect()->route('project_get', $project);
    }
}
