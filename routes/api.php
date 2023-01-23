<?php

// use App\Http\Controllers\Api\V1\CustomerController;
// use App\Http\Controllers\Api\V1\InvoiceController;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Models\Customer;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//api/v1
Route::group(['prefix'=>'v1','middleware'=>'auth:sanctum'],function(){
    Route::apiResource('customers',CustomerController::class);
    Route::apiResource('invoices',InvoiceController::class);
    Route::post('invoices/bluck',[InvoiceController::class,'bluckStore']);
});




