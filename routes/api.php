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
Route::post('/login/{member_name}/{password}', 'App\Http\Controllers\MemberController@showTwo');
Route::get('/members/{member_id}', 'App\Http\Controllers\MemberController@showOne');
Route::post('/members', 'App\Http\Controllers\MemberController@insert');
Route::patch('/members/{member_id}', 'App\Http\Controllers\MemberController@edit');
Route::delete('/members/{member_id}', 'App\Http\Controllers\MemberController@destroy');

Route::get('/chits', 'App\Http\Controllers\ChitController@showAll');
Route::get('/chits/{chit_id}', 'App\Http\Controllers\ChitController@showOne');
Route::post('/chits', 'App\Http\Controllers\ChitController@insert');
Route::patch('/chits/{chit_id}', 'App\Http\Controllers\ChitController@edit');
Route::delete('/chits/{chit_id}', 'App\Http\Controllers\ChitController@destroy');

//Route::post('/payments/{chit_id}/{member_id}','App\Http\Controllers\PaymentController@newtable');


Route::get('/luckylakshmi','App\Http\Controllers\luckylakshmi@showAll');

Route::get('/luckylakshmi/{id}','App\Http\Controllers\luckylakshmi@showOne');
Route::post('/luckylakshmi', 'App\Http\Controllers\luckylakshmi@insert');
Route::patch('/luckylakshmi/{id}', 'App\Http\Controllers\luckylakshmi@edit');
Route::delete('/luckylakshmi/{id}', 'App\Http\Controllers\luckylakshmi@destroy');

Route::get('/payment','App\Http\Controllers\payment@showAll');
Route::get('/payment/{id}','App\Http\Controllers\payment@showOne');
Route::post('/payment', 'App\Http\Controllers\payment@insert');
Route::patch('/payment/{id}', 'App\Http\Controllers\payment@edit');
Route::delete('/payment/{id}', 'App\Http\Controllers\payment@destroy');

Route::post('/subscriber', 'App\Http\Controllers\SubscriberController@insert');