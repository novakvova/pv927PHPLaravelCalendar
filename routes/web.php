<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CarController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('events', EventController::class);
Route::get('/cars', [CarController::class, "Index"])->name("cars.index");
Route::get('/cars/create', [CarController::class, "Create"])->name("cars.create");
Route::post('/cars/store', [CarController::class, "Store"])->name("cars.store");
