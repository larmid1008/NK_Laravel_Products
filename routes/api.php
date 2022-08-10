<?php

use App\Http\Controllers\V1\ProductController;
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


Route::prefix("/v1")->group(function() {
    Route::prefix("/products")->group(function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/{id}', [ProductController::class, 'store']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::patch('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });
});



