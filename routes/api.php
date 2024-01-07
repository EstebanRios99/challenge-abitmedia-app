<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post('login', [UserController::class, 'login']);


Route::middleware('jwt.verify')->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('product/{sku}', [ProductController::class, 'show']);
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{sku}', [ProductController::class, 'update']);
    Route::put('delete_product/{sku}', [ProductController::class, 'isDelete']);
});
