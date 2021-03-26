<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ChitController;
use App\Http\Controllers\PaymentController;

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

Route::get('/members', 'App\Http\Controllers\MemberController@showAll');
Route::get('/members/{phone}', 'App\Http\Controllers\MemberController@showOne');
Route::post('/members', 'App\Http\Controllers\MemberController@insert');
Route::patch('/members/{member_id}', 'App\Http\Controllers\MemberController@edit');
Route::delete('/members/{member_id}', 'App\Http\Controllers\MemberController@destroy');

Route::get('/chits', 'App\Http\Controllers\ChitController@showAll');
Route::get('/chits/{chit_id}', 'App\Http\Controllers\ChitController@showOne');
Route::post('/chits', 'App\Http\Controllers\ChitController@insert');
Route::patch('/chits/{chit_id}', 'App\Http\Controllers\ChitController@edit');
Route::delete('/chits/{chit_id}', 'App\Http\Controllers\ChitController@destroy');

Route::post('/payments/{chit_id}/{member_id}','App\Http\Controllers\PaymentController@newtable');




