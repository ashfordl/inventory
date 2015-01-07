<?php namespace Inventory;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    public function item()
    {
        return $this->belongsTo('Inventory\Item');
    }

    public function project()
    {
        return $this->belongsTo('Inventory\Project');
    }
}