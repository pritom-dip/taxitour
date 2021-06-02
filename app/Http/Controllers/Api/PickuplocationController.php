<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Pickuplocation;

class PickuplocationController extends Controller
{
    public function index()
    {
        $locations = Pickuplocation::latest()->where('status', 'a')->get();

        return response()->json($locations);
    }
}
