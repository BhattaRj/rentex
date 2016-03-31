<?php

namespace App\Models;

class Facility extends BaseModel
{

    protected $table    = "facilities";
    protected $fillable = array('title', 'description', 'icon');

    public function flats()
    {
        return $this->belongsToMany('App\Models\Flat');
    }

}
