<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $guarded = [];

    public function rents()
    {
        return $this->hasMany('App\Model\Rent');
    }

    public function facilities()
    {
        return $this->hasMany('App\Model\Facility');
    }

    public function conditions()
    {
        return $this->hasMany('App\Model\Condition');
    }

    public function galleries()
    {
        return $this->hasMany('App\Model\Gallery');
    }

    public function destination()
    {
        return $this->belongsTo('App\Model\Destination');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function activity()
    {
        return $this->belongsTo('App\Model\Activity');
    }

    public function service()
    {
        return $this->belongsTo('App\Model\Service');
    }

    public function location()
    {
        return $this->belongsTo('App\Model\Location');
    }

    public function duration()
    {
        return $this->belongsTo('App\Model\Duration');
    }

    public function type()
    {
        return $this->belongsTo('App\Model\Type');
    }
}
