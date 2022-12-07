<?php

use App\Http\Controllers\API\dht11;
use App\Http\Controllers\API\switchController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/terimadata/{suhu}/{kelembaban}/{pH}', [dht11::class, 'terimaData']);
Route::get('/switcher', [switchController::class, 'index']);
Route::post('/switcher/store', [switchController::class, 'store']);
