<?php

// use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\SensorController;
// use App\Http\Livewire\Dht11;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
// Route::get('/artikel/insert', [ArtikelController::class, 'insert'])->name('artikelinsert');
// Route::post('/artikel/insert', [ArtikelController::class, 'store'])->name('prosesinsert');
// // Route::post('/artikel/delete', [ArtikelController::class, 'delete'])->name('prosesdelete');
// Route::post('/artikel/delete', [ArtikelController::class, 'destroy'])->name('prosesdestroy');

// Route::get('/artikel/edit/{id}', [ArtikelController::class, 'edit']);
// Route::post('/artikel/update', [ArtikelController::class, 'update']);

Route::get('/suhu', [ArtikelController::class, 'suhu'])->name('suhu');
// Route::get('/dht11', Dht11::class);
Route::get('/', [SensorController::class, 'index']);
Route::get('/updateData', [SensorController::class, 'dataterakhir']);
Route::get('/updateGrafik', [SensorController::class, 'dataGrafik']);
