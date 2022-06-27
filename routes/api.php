<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;

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

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('accounts', [AccountController::class, 'create']);
    Route::put('accounts/fund/{account_number}', [AccountController::class, 'fund']);
    Route::put('accounts/withdraw/{account_number}', [AccountController::class, 'withdraw']);
    Route::get('accounts/getinterest/{account_number}', [AccountController::class, 'getinterest']);
    Route::get('accounts/getaccounttypecustomers/{account_type}', [AccountController::class, 'getaccounttypecustomers']);
    Route::get('accounts/getaccountsofcustomer/{user_id}', [AccountController::class, 'getaccountsofcustomer']);
    Route::get('accounts/getaccounttypeswithzerocustomers', [AccountController::class, 'getaccounttypeswithzerocustomers']);
    Route::get('accounts/getaccountswithzerobalance', [AccountController::class, 'getaccountswithzerobalance']);
});

