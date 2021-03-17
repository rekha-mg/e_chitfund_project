<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ChitController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Log;
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

Route::get('/AllMembers', 'App\Http\Controllers\MemberController@showAll');
Route::get('/Member/{phone}', 'App\Http\Controllers\MemberController@showOne');
Route::post('/NewMember', 'App\Http\Controllers\MemberController@insert');
Route::patch('/Member/{member_id}', 'App\Http\Controllers\MemberController@edit');
Route::delete('/Member/{member_id}', 'App\Http\Controllers\MemberController@destroy');

Route::get('/Allchits', 'App\Http\Controllers\ChitController@showAll');
Route::get('/Chit/{chit_id}', 'App\Http\Controllers\ChitController@showOne');
Route::post('/NewChit', 'App\Http\Controllers\ChitController@insert');
Route::patch('/Chit/{chit_id}', 'App\Http\Controllers\ChitController@edit');
Route::delete('/Chit/{chit_id}', 'App\Http\Controllers\ChitController@destroy');

Route::post('/Table/{chit_id}/{member_id}','App\Http\Controllers\PaymentController@newtable');