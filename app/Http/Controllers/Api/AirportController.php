<?php

namespace App\Http\Controllers\Api;

use App\Model\Airport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::latest()->where('status', 'a')->get();

        return response()->json($airports);
    }
}
