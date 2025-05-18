<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GeneralController;

Route::get('/', [GeneralController::class, 'index']);
Route::get('/manajemen-bus', [BusController::class, 'manajemen_bus']);
Route::get('/manajemen-jadwal', [BusController::class, 'manajemen_jadwal']);
Route::get('/live-monitoring', [GeneralController::class, 'live_monitoring']);