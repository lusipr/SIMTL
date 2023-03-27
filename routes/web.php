<?php

use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringTLController;
use App\Http\Controllers\NcController;
use App\Http\Controllers\NcrController;
use App\Http\Controllers\NcrResourceController;
use App\Http\Controllers\OfiController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\TindakLanjutNcrController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/get/status-nc', [NcController::class, 'api_status_nc'])->middleware('auth');
Route::get('/get/status-ncr', [NcrController::class, 'api_status_ncr'])->middleware('auth');
Route::get('/get/status-ofi', [OfiController::class, 'api_status_ofi'])->middleware('auth');

Route::get('/data-nc', [NcController::class, 'index'])->middleware('auth')->name('data-nc');
Route::get('/data-nc/add', [NcController::class, 'index_add'])->middleware('auth');
Route::post('/data-nc/add', [NcController::class, 'store_add'])->middleware('auth');
Route::get('/data-nc/form/{nc:id_nc}', [NcController::class, 'index_form_nc'])->middleware('auth');
Route::post('/data-nc/form/{nc:id_nc}', [NcController::class, 'store_form_nc'])->middleware('auth');
Route::get('/data-nc/edit/{nc:id_nc}', [NcController::class, 'index_edit'])->middleware('auth');
Route::post('/data-nc/edit/{nc:id_nc}', [NcController::class, 'store_edit'])->middleware('auth');
Route::get('/data-nc/delete/{nc:id_nc}/{ref_page?}', [NcController::class, 'delete'])->middleware('auth');
Route::get('/data-nc/tlnc/input/{nc:id_nc}/{ref_page?}', [NcController::class, 'index_tlnc'])->middleware('auth');
Route::post('/data-nc/tlnc/input/{nc:id_nc}/{ref_page?}', [NcController::class, 'store_tlnc'])->middleware('auth');
Route::get('/data-nc/tlnc/view/{nc:id_nc}/{ref_page?}', [NcController::class, 'view_tlnc'])->middleware('auth');
Route::get('/data-nc/excel', [NcController::class, 'excel'])->middleware('auth')->name('excel-nc');

Route::get('/data-nc/print/{nc:id_nc}', [NcController::class, 'print'])->middleware('auth');

Route::get('/data-ncr', [NcrController::class, 'index'])->middleware('auth')->name('data-ncr');
Route::get('/data-ncr/add', [NcrController::class, 'index_add'])->middleware('auth');
Route::post('/data-ncr/add', [NcrController::class, 'store_add'])->middleware('auth');
Route::get('/data-ncr/form/{ncr:id_ncr}', [NcrController::class, 'index_form_ncr'])->middleware('auth');
Route::post('/data-ncr/form/{ncr:id_ncr}', [NcrController::class, 'store_form_ncr'])->middleware('auth');
Route::get('/data-ncr/edit/{ncr:id_ncr}', [NcrController::class, 'index_edit'])->middleware('auth');
Route::post('/data-ncr/edit/{ncr:id_ncr}', [NcrController::class, 'store_edit'])->middleware('auth');
Route::get('/data-ncr/delete/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'delete'])->middleware('auth');
Route::get('/data-ncr/tlncr/input/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'index_tlncr'])->middleware('auth');
Route::post('/data-ncr/tlncr/input/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'store_tlncr'])->middleware('auth');
Route::get('/data-ncr/tlncr/view/{ncr:id_ncr}/{ref_page?}', [NcrController::class, 'view_tlncr'])->middleware('auth');
Route::get('/data-ncr/excel', [NcrController::class, 'excel'])->middleware('auth')->name('excel-ncr');

Route::get('/data-ncr/print/{ncr:id_ncr}', [NcrController::class, 'print'])->middleware('auth');

Route::get('/data-ofi', [OfiController::class, 'index'])->middleware('auth')->name('data-ofi');
Route::get('/data-ofi/add', [OfiController::class, 'index_add'])->middleware('auth');
Route::post('/data-ofi/add', [OfiController::class, 'store_add'])->middleware('auth');
Route::get('/data-ofi/form/{ofi:id_ofi}', [OfiController::class, 'index_form_ofi'])->middleware('auth');
Route::post('/data-ofi/form/{ofi:id_ofi}', [OfiController::class, 'store_form_ofi'])->middleware('auth');
Route::get('/data-ofi/edit/{ofi:id_ofi}', [OfiController::class, 'index_edit'])->middleware('auth');
Route::post('/data-ofi/edit/{ofi:id_ofi}', [OfiController::class, 'store_edit'])->middleware('auth');
Route::get('/data-ofi/delete/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'delete'])->middleware('auth');
Route::get('/data-ofi/tlofi/input/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'index_tlofi'])->middleware('auth');
Route::post('/data-ofi/tlofi/input/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'store_tlofi'])->middleware('auth');
Route::get('/data-ofi/tlofi/view/{ofi:id_ofi}/{ref_page?}', [OfiController::class, 'view_tlofi'])->middleware('auth');
Route::get('/data-ofi/excel', [OfiController::class, 'excel'])->middleware('auth')->name('excel-ofi');

Route::get('/data-ofi/print/{ofi:id_ofi}', [OfiController::class, 'print'])->middleware('auth');

Route::get('/monitoring-tl', [MonitoringTLController::class, 'index'])->middleware('auth');
Route::get('/monitoring-tl/excel', [MonitoringTLController::class, 'excel'])->middleware('auth');

Route::get('/data-user', [UserController::class, 'index'])->middleware('auth')->name('data-user');
Route::get('/data-user/add', [UserController::class, 'index_add'])->middleware('auth')->name('data-user-add');
Route::post('/data-user/add', [UserController::class, 'store_add'])->middleware('auth');
Route::get('/data-user/edit/{user}', [UserController::class, 'index_edit'])->middleware('auth')->name('data-user-edit');
Route::post('/data-user/edit/{user}', [UserController::class, 'store_edit'])->middleware('auth');
Route::get('/data-user/delete/{user}', [UserController::class, 'delete'])->middleware('auth');

Route::get('/data-departemen', [DepartemenController::class, 'index'])->middleware('auth')->name('data-departemen');
Route::get('/data-departemen/add', [DepartemenController::class, 'index_add'])->middleware('auth')->name('data-departemen-add');
Route::post('/data-departemen/add', [DepartemenController::class, 'store_add'])->middleware('auth');
Route::get('/data-departemen/edit/{user}', [DepartemenController::class, 'index_edit'])->middleware('auth')->name('data-departemen-edit');
Route::post('/data-departemen/edit/{user}', [DepartemenController::class, 'store_edit'])->middleware('auth');
Route::get('/data-departemen/delete/{user}', [DepartemenController::class, 'delete'])->middleware('auth');

Route::get('/data-tema', [TemaController::class, 'index'])->middleware('auth')->name('data-tema');
Route::get('/data-tema/add', [TemaController::class, 'index_add'])->middleware('auth')->name('data-tema-add');
Route::post('/data-tema/add', [TemaController::class, 'store_add'])->middleware('auth');
Route::get('/data-tema/edit/{user}', [TemaController::class, 'index_edit'])->middleware('auth')->name('data-tema-edit');
Route::post('/data-tema/edit/{user}', [TemaController::class, 'store_edit'])->middleware('auth');
Route::get('/data-tema/delete/{user}', [TemaController::class, 'delete'])->middleware('auth');
