<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Tourbooking;
use Validator;

class TourBookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tour_id' => 'required',
            'no_of_persons' => 'required',
            'date' => 'required',
            'arrival_time' => 'required',
            'fname' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $booking = Tourbooking::create($request->all());

        return response()->json([
            'success' => true,
            'booking' => $booking
        ]);
    }
}
