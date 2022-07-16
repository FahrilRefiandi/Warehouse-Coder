<?php

use App\Http\Controllers\KardusController;
use Illuminate\Support\Facades\Route;

Route::resource('/kardus', KardusController::class);
