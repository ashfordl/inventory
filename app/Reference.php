<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    public function item()
    {
        return $this->belongsTo('Inventory\Item');
    }

    public function project()
    {
        return $this->belongsTo('Inventory\Project');
    }





    /*---------------------*/
    /*------ QUERIES ------*/
    /*---------------------*/

    /**
     * Selects and returns all references (with a positive quantity) for a given item. Eager loads projects for these references also.
     *
     * @param  integer  $itemId     The item to find for
     * @return Collection           All references for the given item
     */
    public static function allForItem($itemId)
    {
        return Reference::where('item_id', $itemId)
                        ->where('quantity', '>', 0)
                        ->with('project')
                        ->get();
    }
}