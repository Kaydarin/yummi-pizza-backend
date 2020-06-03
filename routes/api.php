<?php

header('Access-Control-Allow-Origin: http://localhost:3000');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testget', 'ApiController@getTest');
Route::post('/testpost', 'ApiController@postTest');
Route::get('/pizza', 'ApiController@getPizza');
Route::post('/orderpizza', 'ApiController@orderPizza');
Route::post('/order', 'ApiController@getOrder');