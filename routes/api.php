<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Model\Tour;
use App\Model\Settings;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/tours', function (Request $request) {
//     $tours = Tour::all();
//     return $tours;
// });
Route::get('/settings', function () {
    return Settings::first();
});

Route::namespace('Api')->group(function () {
    Route::get('tours',            'TourController@index');
});
