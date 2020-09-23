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

// Testing passport tokens
Route::post('login','AuthController@login');
Route::post('signup','AuthController@signup');
Route::group(['middleware' => 'auth:api'], function (){
    Route::post('details','AuthController@details');
});

// Testing passport
Route::group(['middleware'=>'auth:api'], function (){
    Route::post('/user', 'UserController@login');
});

//before setting autorization
Route::apiResource('/expenses','ExpenseController')->except(['create','edit']);
Route::apiResource('/debits','DebitController')->except(['create','edit']);
Route::apiResource('/credits','CreditController')->except(['create','edit']);


