<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangDatangController;
use App\Http\Controllers\JenisBenangController;
use App\Http\Controllers\WarnaBenangController;


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

Route::resource('/benang-datang', BarangDatangController::class)->middleware(['wh1']);

Route::resource('/jenis-benang', JenisBenangController::class)->middleware(['wh1']);

Route::resource('/warna-benang', WarnaBenangController::class)->middleware(['wh1']);

require __DIR__.'/auth.php';
