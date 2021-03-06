<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function user()
    {
        return $this->belongsTo('Inventory\User');
    }

    public function items()
    {
        return $this->hasMany('Inventory\Item');
    }
}