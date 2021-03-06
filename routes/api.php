<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ItemController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::get('/items', [ItemController::class, 'GetAllItems']);
Route::get('/item', [ItemController::class, 'GetItemDetails']);

Route::post('/cart/add', [CheckoutController::class, 'AddCart'])->middleware('auth:sanctum');
Route::get('/cart', [CheckoutController::class, 'GetAllCart'])->middleware('auth:sanctum');
Route::get('/cart/detail', [CheckoutController::class, 'GetCartDetails'])->middleware('auth:sanctum');
Route::post('/checkout', [CheckoutController::class, 'Checkout'])->middleware('auth:sanctum');

