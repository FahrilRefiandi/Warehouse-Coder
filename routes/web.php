<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenangDatangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBenangController;
use App\Http\Controllers\WarnaBenangController;
use App\Http\Controllers\SatuanBenangController;
use App\Http\Controllers\ProduksiLembaranController;
use App\Http\Controllers\MotifSarungController;
use App\Http\Controllers\SarungController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ShiftKerjaController;
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

Route::get('/', function () {
    return redirect('login');
});


Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');


Route::resource('/benang-datang', BenangDatangController::class)->middleware(['napes']);
Route::post('/sort/benang-datang',[BenangDatangController::class,'sortDate'])->middleware(['napes']);

// Management Data WH1
Route::resource('/jenis-benang', JenisBenangController::class)->middleware(['napes']);
Route::resource('/warna', WarnaBenangController::class)->middleware(['napes']);
Route::resource('/satuan', SatuanBenangController::class)->middleware(['napes']);
Route::resource('/motif-sarung', MotifSarungController::class)->middleware(['napes']);
// Management Data WH1


Route::resource('/produksi-lembaran', ProduksiLembaranController::class)->middleware(['napes']);
Route::post('/sort/produksi-lembaran',[ProduksiLembaranController::class,'sortDate'])->middleware(['napes']);
Route::resource('/mesin', MesinController::class)->middleware(['napes']);
Route::resource('/shift-kerja', ShiftKerjaController::class)->middleware(['napes']);

Route::resource('/sarung', SarungController::class)->middleware(['napes']);

// Pindahkan Sarung
// Pindahkan Ke WH2
Route::get('/kirim-barang/napes',[PengirimanController::class,'kirimKeNapes'])->middleware(['napes']);
Route::post('/kirim-barang/napes/{id}',[PengirimanController::class,'kirimKeNapesPost'])->middleware(['napes']);

// Pindahkan Sarung

require __DIR__.'/auth.php';
require __DIR__.'/kantor.php';
