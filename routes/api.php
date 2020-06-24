<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    Route::post('/update', 'UserController@update');
    Route::post('/report', 'EmergencyController@store'); 
    Route::post('/storeprofile', 'UserController@storeprofile');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
