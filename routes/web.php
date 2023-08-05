<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\logincontroller;

use App\Http\Controllers\{
    OperatorController
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
