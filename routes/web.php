<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\logincontroller;

use App\Http\Controllers\{
    OperatorController,
    OrangTuaController,
    GuruController,
    HafalanController,
    MessageController,
    PendaftaranController,
    PengasuhController,
    SiswaController,
    BeritaController,
    BeritawebController,
    WebsiteController,
    PimpinanController,
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

Route::get('/', [\App\Http\Controllers\WebsiteController::class, "index"]);
Route::get('/about', [\App\Http\Controllers\WebsiteController::class, "about"]);
Route::get('/newspapper', [\App\Http\Controllers\WebsiteController::class, "newspapper"]);

Route::get('/login', [logincontroller::class, 'halamanlogin'])->name('login');
Route::get('/login/logout', [logincontroller::class, 'logout'])->name('logout');
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
    Route::get('/laporan', [OrangTuaController::class, 'laporan']);
    Route::get('/hafalan', [OrangTuaController::class, 'show_hafalan']);
    Route::get('/laporan/{id}', [OrangTuaController::class, 'laporan']);
    Route::get('/hafalansantri', [OrangTuaController::class, 'show_hafalanid']);
   

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

Route::group([
    'middleware' =>  ["web"],
    'prefix' => "hafalan"
], function ($router) {
    Route::get('/', [HafalanController::class, 'show']);
    Route::get('/show/{id?}', [HafalanController::class, 'show']);
    Route::get('/show-id/{id}', [HafalanController::class, 'show_Id']);
    Route::get('/show-hafalan-bywali', [HafalanController::class, 'show_bywali']);
    Route::get('/laporan/{id?}', [HafalanController::class, 'laporan']);
    Route::get('/siswa-hafalan-show/{id?}', [HafalanController::class, 'siswa_hafalan_show']);
    Route::post('/store', [HafalanController::class, 'store']);
    Route::post('/update/{id}', [HafalanController::class, 'update']);
    Route::get('/destroy/{id}', [HafalanController::class, 'destroy']);
});


Route::group([
    'middleware' =>  ["web"],
    'prefix' => "register-siswa"
], function ($router) {
    Route::get('/', [PendaftaranController::class, 'show']);
    Route::get('/show_detail/{id}', [PendaftaranController::class, 'show_detail']);
    Route::get('/show_update/{id}', [PendaftaranController::class, 'show_update']);
    Route::get('/show-data', [PendaftaranController::class, 'show_data']);
    Route::get('/form', [PendaftaranController::class, 'form']);
    Route::post('/store', [PendaftaranController::class, 'store']);
    Route::post('/update/{id}', [PendaftaranController::class, 'update']);
    Route::get('/destroy/{id}', [PendaftaranController::class, 'destroy']);
    Route::get('/acc/{id}', [PendaftaranController::class, 'acc']);
    Route::get('/reject/{id}', [PendaftaranController::class, 'reject']);
    Route::get('/laporan', [PendaftaranController::class, 'laporan']);
});
Route::group([
    'middleware' =>  ["web"],
    'prefix' => "siswa_register"
], function ($router) {
    Route::get('/', [SiswaController::class, 'show']);
    Route::get('/show-pimpinan', [SiswaController::class, 'showPimpinan']);
    Route::get('/show_detail/{id}', [SiswaController::class, 'show_detail']);
    Route::get('/show_update/{id}', [SiswaController::class, 'show_update']);
    Route::get('/show-data', [SiswaController::class, 'show_data']);
    Route::get('/form', [SiswaController::class, 'form']);
    Route::post('/store', [SiswaController::class, 'store']);
    Route::post('/update/{id}', [SiswaController::class, 'update']);
    Route::get('/destroy/{id}', [SiswaController::class, 'destroy']);
});

Route::group([
    'middleware' =>  ["web"],
    'prefix' => "wa"
], function ($router) {
    Route::get('/scann', [MessageController::class, 'show']);
});

Route::group([
    'middleware' =>  ["web"],
    'prefix' => "news"
], function ($router) {
    Route::get('/', [BeritaController::class, 'show']);
    Route::get('/get-all', [BeritaController::class, 'getAll']);
    Route::get('/get-id/{id}', [BeritaController::class, 'getId']);
    Route::post('/store', [BeritaController::class, 'store']);
    Route::post('/update/{id}', [BeritaController::class, 'update']);
    Route::delete('/destroy/{id}', [BeritaController::class, 'destroy']);
});
Route::group([
    'middleware' =>  ["web"],
    'prefix' => "berita"
], function ($router) {
    Route::get('/', [BeritawebController::class, 'show']);
    Route::get('/get-all', [BeritawebController::class, 'getAll']);
    Route::get('/beritaview/{id}', [BeritawebController::class, 'getId']);
});

Route::group([
    'middleware' =>  ["web"],
    'prefix' => "daftarmandiri"
], function ($router) {
    Route::get('/', [WebsiteController::class, 'index']);
    Route::get('/form', [WebsiteController::class, 'form']);
    Route::post('/store', [WebsiteController::class, 'store']);
});
Route::group([
    'middleware' =>  ["web"],
    'prefix' => "/"
], function ($router) {
    Route::get('/', [WebsiteController::class, 'index']);
    Route::get('/tentang', [WebsiteController::class, 'tentang']);
    Route::get('/kontak', [WebsiteController::class, 'kontak']);
    Route::get('/visi', [WebsiteController::class, 'visi']);
    Route::get('/misi', [WebsiteController::class, 'misi']);
});


Route::get('/tseting', [WebsiteController::class, 'test']);


Route::group([
    'middleware' =>  ["web"],
    'prefix' => "pimpinan"
], function ($router) {
    Route::get('/', [PimpinanController::class, 'show']);
    Route::get('/show-data', [PimpinanController::class, 'show_data']);
    Route::get('/show-santri', [PimpinanController::class, 'show_santri']);
    Route::post('/', [PimpinanController::class, 'store']);
    Route::post('/update/{id}', [PimpinanController::class, 'update']);
    Route::get('/destroy/{id}', [PimpinanController::class, 'destroy']);
    Route::get('/hafalan', [PimpinanController::class, 'show_hafalan']);
    Route::get('/laporan/{id?}', [PimpinanController::class, 'laporan']);


});