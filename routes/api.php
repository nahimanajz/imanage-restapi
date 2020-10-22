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
Route::get('/all/expenses','ExpenseController@index',);

// Testing passport
Route::group(['prefix'=>'auth'], function (){
    Route::post('/user', 'UserController@login');
});


//Final step will be to set authorization token
Route::group(['middleware'=> 'auth:sanctum'], function() {    
    Route::get('all/users','UserController@index');
    Route::apiResource('/deposit', 'DepositController');
    Route::apiResource('/debits','DebitController');
    Route::apiResource('/credits','CreditController');
    Route::apiResource('/expenses','ExpenseController');

    //payment Routes
    Route::post("/pay/credit", "CreditPaymentController@store");
    Route::post("/pay/debit", "DebitPaymentController@store");

    Route::post('auth/logout', 'UserController@logout');
});
Route::get('/get-headers',function(){
$headers = apache_request_headers()['user_id'];
return (int)$headers;
});

