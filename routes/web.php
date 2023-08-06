<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\logincontroller;

use App\Http\Controllers\{
    OperatorController,OrangTuaController,GuruController,PengasuhController
};

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

Route::get('/login', [logincontroller::class, 'halamanlogin'])->name('login');
Route::post('/postlogin', [logincontroller::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [logincontroller::class, 'logout'])->name('logout');
route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [homecontroller::class, 'index'])->name('home');
});

Route::group([
    'middleware' =>  ["web"],
    'prefix' => "operator"
], function ($router) {
    Route::get('/', [OperatorController::class, 'show']);
    Route::get('/show-data', [OperatorController::class, 'show_data']);
    Route::post('/', [OperatorController::class, 'store']);
    Route::post('/update/{id}', [OperatorController::class, 'update']);
    Route::get('/destroy/{id}', [OperatorController::class, 'destroy']);
});

Route::group([
    'middleware' =>  ["web"],
    'prefix' => "orangtua"
], function ($router) {
    Route::get('/', [OrangTuaController::class, 'show']);
    Route::get('/show-data', [OrangTuaController::class, 'show_data']);
    Route::post('/', [OrangTuaController::class, 'store']);
    Route::post('/update/{id}', [OrangTuaController::class, 'update']);
    Route::get('/destroy/{id}', [OrangTuaController::class, 'destroy']);
});
Route::group([
    'middleware' =>  ["web"],
    'prefix' => "guru"
], function ($router) {
    Route::get('/', [GuruController::class, 'show']);
    Route::get('/show-data', [GuruController::class, 'show_data']);
    Route::post('/', [GuruController::class, 'store']);
    Route::post('/update/{id}', [GuruController::class, 'update']);
    Route::get('/destroy/{id}', [GuruController::class, 'destroy']);
});
Route::group([
    'middleware' =>  ["web"],
    'prefix' => "pengasuh"
], function ($router) {
    Route::get('/', [PengasuhController::class, 'show']);
    Route::get('/show-data', [PengasuhController::class, 'show_data']);
    Route::post('/', [PengasuhController::class, 'store']);
    Route::post('/update/{id}', [PengasuhController::class, 'update']);
    Route::get('/destroy/{id}', [PengasuhController::class, 'destroy']);
});