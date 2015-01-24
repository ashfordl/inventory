<?php namespace Inventory;

use DB;
use Illuminate\Database\Eloquent\Model;
use Inventory\Reference;

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
     * @param  int  $userId     The user id to select items from
     * @return Query            A query expression to select this information
     */
    public static function selectAllForUser($userId)
    {
        return DB::table('items')
                    // Select all from items table
                    ->select('*')
                    // Sum quantities distributed between references
                    ->addSelect(DB::raw('(SELECT SUM(quantity) FROM `references` WHERE references.item_id = items.id GROUP BY item_id) AS quantity'))
                    // Select category name
                    ->addSelect(DB::raw('(SELECT name FROM `categories` WHERE categories.id = items.category_id) AS category'))

                    // Only for the current user
                    ->where('user_id', $userId)
                    // Only if there is a quantity that is not null (ie no spares)
                    ->whereNotNull(DB::raw('(SELECT SUM(quantity) FROM `references` WHERE references.item_id = items.id GROUP BY item_id)'))
                    // Only if the quantity is not zero (quantity field has value of 0)
                    ->where(DB::raw('(SELECT SUM(quantity) FROM `references` WHERE references.item_id = items.id GROUP BY item_id)'), '<>', '0');

    }

    /**
     * Selects all spares for the given user, with quantity and category name
     *
     * @param  int  $userId     The user id to select spares from
     * @return Query            A query expression to select this information
     */
    public static function selectSparesForUser($userId)
    {
        return DB::table('items')
                    // Select all from items table
                    ->select('*')
                    // Select quantities from references table
                    ->addSelect(DB::raw('(SELECT quantity FROM `references` WHERE references.item_id = items.id AND references.project_id IS NULL GROUP BY item_id) AS quantity'))
                    // Select category name for item
                    ->addSelect(DB::raw('(SELECT name FROM `categories` WHERE categories.id = items.category_id) AS category'))

                    // Only for the current user
                    ->where('user_id', $userId)
                    // Only if there is a quantity that is not null (ie no spares)
                    ->whereNotNull(DB::raw('(SELECT quantity FROM `references` WHERE references.item_id = items.id AND references.project_id IS NULL GROUP BY item_id)'))
                    // Only if the quantity is not zero (quantity field has value of 0)
                    ->where(DB::raw('(SELECT quantity FROM `references` WHERE references.item_id = items.id AND references.project_id IS NULL GROUP BY item_id)'), '<>', '0');
    }

    /**
     * Selects all items for the given project, with quantity and category name
     *
     * @param  int  $projectId     The project to select items from
     * @return Query               A query expression to select this information
     */
    public static function selectAllForProject($projectId)
    {
        return Reference::with('item', 'item.category')
                        ->where('project_id', $projectId)
                        ->where('quantity', '<>', '0');
    }
}
