<?php

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
Route::apiResource('/users', 'UserController');

Route::group([
    'prefix' => 'auth'
], function(){
    Route::post('login', 'UserController@login');
    Route::post('signup', 'UserController@store');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout','UserController@logout');
        Route::get('user', 'UserController@user');
    });
});

//before setting autorization
Route::apiResource('/expenses','ExpenseController')->except(['create','edit']);
Route::apiResource('/debits','DebitController')->except(['create','edit']);
Route::apiResource('/credits','CreditController')->except(['create','edit']);


