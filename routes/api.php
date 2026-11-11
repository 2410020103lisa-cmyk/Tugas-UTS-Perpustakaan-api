<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\PeminjamanController;

Route::apiResource('buku', BukuController::class);

Route::apiResource('peminjaman', PeminjamanController::class);