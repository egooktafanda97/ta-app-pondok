<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\logincontroller;

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
Route::get('/login',[logincontroller::class,'halamanlogin'])->name('login');
Route::post('/postlogin',[logincontroller::class,'postlogin'])->name('postlogin');
Route::get('/logout',[logincontroller::class,'logout'])->name('logout');
route::group(['middleware' => ['auth']], function(){
    Route::get('/home',[homecontroller::class,'index'])->name('home');

});
