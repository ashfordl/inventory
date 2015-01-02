<?php namespace Inventory\Http\Controllers;

use Inventory\Http\Requests;
use Inventory\Http\Controllers\Controller;

class InventoryController extends Controller {

    public function __construct()
    {
        // $this->middleware('auth');
    }

	/**
	 * Show a list of
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('inventory.inventories');
	}

}
