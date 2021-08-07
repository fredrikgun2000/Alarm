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

// Route::get('/', function () {
//     return view('welcome');
// });

//get
Route::get('/','MainController@index');
Route::get('/loadtime','MainController@loadtime');
Route::get('/loadalarm/{email}','MainController@loadalarm');
Route::get('/countalarm/{email}','MainController@countalarm');
Route::get('/alarm/{email}','MainController@sendalarmemail');
Route::get('/hapusalarm/{id}/{email}','MainController@hapusalarm');
Route::get('/register','MainController@register');
Route::get('/verify/{email}','MainController@verify');
Route::get('/rsendverify/{email}','MainController@sendverify');
Route::get('/login','MainController@login')->name('login');
Route::get('/logout','MainController@logout');


//post
Route::post('/register/post','MainController@registerpost');
Route::post('/login/post','MainController@loginpost');
Route::post('/simpanalarm/post','MainController@simpanalarmpost');
