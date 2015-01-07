<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
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
}