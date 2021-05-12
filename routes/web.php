<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/signup', function () {
    return view('signup');
});



Route::get('/index', function () {
    return view('index');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/userviewdetails', function () {
    return view('user_viewdetails');
});

Route::get('/adminviewdetails', function () {
    return view('admin_viewdetails');
});

Route::get('/adminviewdetails2', function () {
    return view('admin_viewdetails2');
});

Route::get('/luckylakshmi_viewdetails', function () {
    return view('luckylakshmi_viewdetails');
});

Route::get('/chitform', function () {
    return view('chitform');
});