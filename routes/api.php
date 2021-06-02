<?php

use Illuminate\Support\Facades\Route;
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

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::group(['middleware' => ['jsonResponse', 'auth:api']], function () {
    Route::post('details', 'Api\UserController@details');
    // Route::get('tours',     'Api\TourController@index');
});

Route::get('/settings', function () {
    return Settings::first();
});

Route::namespace('Api')->group(function () {
    Route::get('tours',              'TourController@index');
    Route::get('tour/{id}',          'TourController@show');
    Route::get('pickuplocation',        'PickuplocationController@index');



    Route::post('taxibooking',        'TaxibookingController@store');
    Route::post('tourbooking',        'TourBookingController@store');
});
