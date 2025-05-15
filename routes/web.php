<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;

Route::get('/', [GeneralController::class, 'index']);
Route::get('/manajemen-bus', [GeneralController::class, 'manajemen_bus']);
Route::get('/manajemen-jadwal', [GeneralController::class, 'manajemen_jadwal']);
Route::get('/live-monitoring', [GeneralController::class, 'live_monitoring']);