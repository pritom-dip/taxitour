<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function tours()
    {
        return $this->hasMany('App\Model\Tour');
    }
}
