<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TypeController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index');
    Route::post('product', 'store');
    Route::get('product/{id}', 'show');
    Route::put('product/{id}', 'update');
    Route::delete('product/{id}', 'destroy');
}); 

Route::controller(TypeController::class)->group(function () {
    Route::get('types', 'index');
    Route::post('type', 'store');
    Route::get('type/{id}', 'show');
    Route::put('type/{id}', 'update');
    Route::delete('type/{id}', 'destroy');
}); 

Route::controller(ColorController::class)->group(function () {
    Route::get('colors', 'index');
    Route::post('color', 'store');
    Route::get('color/{id}', 'show');
    Route::put('color/{id}', 'update');
    Route::delete('color/{id}', 'destroy');
}); 

Route::controller(CardController::class)->group(function () {
    Route::get('cards', 'index');
    Route::post('card', 'store');
    Route::get('card/{id}', 'show');
    Route::put('card/{id}', 'update');
    Route::delete('card/{id}', 'destroy');
});
