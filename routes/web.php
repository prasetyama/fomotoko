<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

Route::middleware('auth:auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:auth')->post('/orders', 'App\Http\Controllers\Api\OrdersController@store')->name('orders.store');

//Rate Limit for Check Stock
Route::middleware(['auth:auth', 'throttle:5,1'])->post('/checkStock', 'App\Http\Controllers\Api\OrdersController@checkStockApi')->name('orders.checkStockApi');
