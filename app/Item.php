<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function location()
    {
        return $this->belongsTo('Location');
    }
}