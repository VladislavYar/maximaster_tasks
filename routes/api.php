<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//(PHP) REST API
Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::get('products/', IndexController::class)->name('product.index');
    Route::post('products/', StoreController::class)->name('product.store');
    Route::get('products/{id}', ShowController::class)->name('product.show');
    Route::put('products/{id}', UpdateController::class)->name('product.update');
    Route::delete('products/{id}', DestroyController::class)->name('product.destroy');
});