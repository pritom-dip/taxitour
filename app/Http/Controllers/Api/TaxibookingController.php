<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\Taxibooking;

class TaxibookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'airport' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'mobile_number' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $booking = Taxibooking::create($request->all());

        return response()->json([
            'success' => true,
            'booking' => $booking
        ]);
    }
}
