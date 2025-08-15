<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard utama (redirect sesuai role)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Dashboard Guru
Route::get('/dashboard/guru', [DashboardController::class, 'guru'])
    ->middleware(['auth'])
    ->name('dashboard.guru');

// Dashboard Tata Tertib
Route::get('/dashboard/tata-tertib', [DashboardController::class, 'tataTertib'])
    ->middleware(['auth'])
    ->name('dashboard.tataTertib');

// Dashboard Siswa
Route::get('/dashboard/student', function () {
    return view('dashboard.student');
})->middleware(['auth'])
    ->name('student.dashboard');
