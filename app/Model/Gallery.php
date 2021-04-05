<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    public function tour()
    {
        return $this->belongsTo('App\Model\Tour');
    }
}
