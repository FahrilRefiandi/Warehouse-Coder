<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenangDatangController;
use App\Http\Controllers\JenisBenangController;
use App\Http\Controllers\WarnaBenangController;
use App\Http\Controllers\SatuanBenangController;
use App\Http\Controllers\ProduksiLembaranController;
use App\Http\Controllers\MotifSarungController;
use App\Http\Controllers\SarungController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ShiftKerjaController;

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

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/benang-datang', BenangDatangController::class)->middleware(['wh1']);
Route::post('/sort/benang-datang',[BenangDatangController::class,'sortDate'])->middleware(['wh1']);

// Management Data WH1
Route::resource('/jenis-benang', JenisBenangController::class)->middleware(['wh1']);
Route::resource('/warna', WarnaBenangController::class)->middleware(['wh1']);
Route::resource('/satuan', SatuanBenangController::class)->middleware(['wh1']);
Route::resource('/motif-sarung', MotifSarungController::class)->middleware(['wh1']);
// Management Data WH1


Route::resource('/produksi-lembaran', ProduksiLembaranController::class)->middleware(['wh1']);
Route::resource('/mesin', MesinController::class)->middleware(['wh1']);
Route::resource('/shift-kerja', ShiftKerjaController::class)->middleware(['wh1']);

Route::resource('/sarung', SarungController::class)->middleware(['wh1']);

// Pindahkan Sarung
// Pindahkan Ke WH2
Route::get('/kirim-barang/napes',[PengirimanController::class,'kirimKeNapes'])->middleware(['wh1']);
Route::post('/kirim-barang/napes/{id}',[PengirimanController::class,'kirimKeNapesPost'])->middleware(['wh1']);

// Pindahkan Sarung

require __DIR__.'/auth.php';
