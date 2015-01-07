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
}