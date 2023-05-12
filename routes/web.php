<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HitCounterController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RandomСolorController;
use App\Http\Controllers\MakingOrderController;
use App\Http\Controllers\SpreadsheetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//(PHP) Гостевая книга
Route::group(['namespace' => 'App\Http\Controllers\Guest'], function () {
    Route::get('/guest-book', IndexController::class)->name('guest.index');
    Route::post('/guest-book', StoreController::class)->name('guest.store');
});

//(PHP) Калькулятор доставки
Route::group(['namespace' => 'App\Http\Controllers\Delivery'], function () {
    Route::get('/delivery-calculator', IndexController::class)->name('delivery.index');
    Route::post('/delivery-calculator', StoreController::class)->name('delivery.store');
});

//(JS) Таблица товаров
Route::group(['namespace' => 'App\Http\Controllers\Product'], function () {
    Route::get('/table-product', IndexController::class)->name('table.index');
    Route::get('/table-product/products', ShowController::class)->name('table.show');
});

//(JS) График загруженности процессора
Route::group(['namespace' => 'App\Http\Controllers\CPU'], function () {
    Route::get('/cpu-usage', IndexController::class)->name('cpu.index');
    Route::get('/cpu-usage/cpu-info', ShowController::class)->name('cpu.show');
});

Route::get('/', MainController::class)->name('main.index'); //Главная страница для навигации
Route::get('/hit-counter', HitCounterController::class)->name('hit.index'); //(PHP) Счётчик хитов
Route::get('/random-color', RandomСolorController::class)->name('color.index'); //(JS) Случайный цвет
Route::get('/making-order', MakingOrderController::class)->name('order.index'); //(JS) Оформление заказа
Route::get('/spreadsheet', SpreadsheetController::class)->name('spreadsheet.index'); //(JS) Электронная таблица
