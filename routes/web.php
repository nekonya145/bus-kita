<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;

Route::get('/', [GeneralController::class, 'index']);
Route::get('/manajemen-bus', [BusController::class, 'manajemen_bus']);
Route::get('/manajemen-jadwal', [BusController::class, 'manajemen_jadwal']);
Route::get('/live-monitoring', [GeneralController::class, 'live_monitoring']);

Route::get('/login', [ProfileController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [ProfileController::class, 'masuk'])->middleware('guest');

// Route::post('/register', [ProfileController::class, 'register'])->middleware('guest');