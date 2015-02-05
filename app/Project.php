<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user()
    {
        return $this->belongsTo('Inventory\User');
    }

    public function references()
    {
        return $this->hasMany('Inventory\Reference');
    }





    /*---------------------*/
    /*------ QUERIES ------*/
    /*---------------------*/

    /**
     * Selects and returns all projects that do not references a positive quantity of the given item.
     *
     * @param  integer  $itemId     The item to find for
     * @return Collection           All projects not including the given item
     */
    public static function projectsWithoutItem($itemId)
    {
        return \DB::select('SELECT * FROM `projects`
                            WHERE id NOT IN(
                                SELECT `project_id` FROM `references`
                                WHERE `item_id` = ?
                                    AND `quantity` IS NOT NULL
                                    AND `quantity` > 0
                                    AND `project_id` IS NOT NULL)',
                        [$itemId]);
    }
}