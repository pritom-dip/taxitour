<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    protected $guarded = [];

    public function tours()
    {
        return $this->hasMany('App\Model\Tour');
    }
}
