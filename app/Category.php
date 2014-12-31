<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function inventory()
    {
        return $this->belongsTo('Inventory\Inventory');
    }

    public function items()
    {
        return $this->hasMany('Inventory\Item');
    }
}