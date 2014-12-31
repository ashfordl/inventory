<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function categories()
    {
        return $this->hasMany('Category');
    }

    public function locations()
    {
        return $this->hasMany('Location');
    }
}