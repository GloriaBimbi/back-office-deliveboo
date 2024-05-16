<?php

use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TypeController;
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

Route::get('restaurants/advanced-filters', [RestaurantController::class, 'advancedFilters']);
Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);
Route::apiResource('types', TypeController::class)->only(['index', 'show']);

// braintree payment
Route::get('generate-client-token', [PaymentController::class, 'generateClientToken']);
Route::post('process-payment', [PaymentController::class, 'processPayment']);
// Route::post('process-payment', 'OrderController@order');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
