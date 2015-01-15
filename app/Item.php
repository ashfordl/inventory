<?php namespace Inventory;

use DB;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /*---------------------*/
    /*--- RELATIONSHIPS ---*/
    /*---------------------*/

    public function user()
    {
        return $this->belongsTo('Inventory\User');
    }

    public function category()
    {
        return $this->belongsTo('Inventory\Category');
    }

    public function references()
    {
        return $this->hasMany('Inventory\Reference');
    }





    /*---------------------*/
    /*------ QUERIES ------*/
    /*---------------------*/

    /**
     * Selects all items for the given user, with quantity and category name
     *
     * @param  int  $userid     The user id to select items from
     * @return Query            A query expression to select this information
     */
    public static function selectAllForUser($userid)
    {
        return DB::table('items')
                    // Select all from items table
                    ->select('*')
                    // Sum quantities distributed between references
                    ->addSelect(DB::raw('(SELECT SUM(quantity) FROM `references` WHERE references.item_id = items.id GROUP BY item_id) AS quantity'))
                    // Select category name
                    ->addSelect(DB::raw('(SELECT name FROM `categories` WHERE categories.id = items.category_id) AS category'))
                    // Only for the current user
                    ->where('user_id', $userid);
    }
}