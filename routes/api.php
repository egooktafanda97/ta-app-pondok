<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Api\OperatorController;
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

Route::group([
    'middleware' =>  ["api"],
    'prefix' => "operator"
], function ($router) {
    Route::post('/', [OperatorController::class, 'store']);
    Route::patch('/{id}', [OperatorController::class, 'update']);
    Route::delete('/{id}', [OperatorController::class, 'destory']);
    Route::get('/', [OperatorController::class, 'show']);
    Route::get('/{id}', [OperatorController::class, 'getId']);
});
