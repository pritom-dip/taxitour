<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(
            [
                'category',
                'rents',
                'facilities',
                'conditions',
                'galleries',
                'destination',
                'activity',
                'service',
                'location',
                'duration',
                'type'
            ]
        )->get();
        return response()->json($tours, 200);
    }
}
