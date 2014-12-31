<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function user()
    {
        return $this->belongsTo('Inventory\User');
    }

    public function categories()
    {
        return $this->hasMany('Inventory\Category');
    }

    public function locations()
    {
        return $this->hasMany('Inventory\Location');
    }
}