<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\UserComputerController;

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

Route::resource('stock-opname', StockOpnameController::class);
Route::resource('computer', ComputerController::class);
Route::resource('userComputer', UserComputerController::class);
Route::resource('/stock-opname', StockOpnameController::class);
