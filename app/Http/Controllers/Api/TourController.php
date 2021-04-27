<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Tour;
use Illuminate\Http\Request;
use App\Model\Category;

class TourController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index(Request $request)
    {
        $query = Tour::with(
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
        )->latest();

        if (!empty($request->field) && $request->field == 'type') {
            $query->where('tour_type', $request->quefieldry);
        }

        if (!empty($request->field) && $request->field == 'category') {
            $categoey = Category::where('name', $request->field)->pluck('id')->first();
            $query->where('category_id', $categoey);
        }

        $tours = $query->get();

        return response()->json($tours, 200);
    }

    public function show($id)
    {
        $tour = Tour::with(
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
        )->where('id', $id)->first();

        return response()->json($tour, 200);
    }
}
