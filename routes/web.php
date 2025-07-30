<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\ClassController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    
    // Dashboard Routes
    Route::get('/dashboard/guru', [DashboardController::class, 'guru'])->name('dashboard.guru');
    Route::get('/dashboard/tata-tertib', [DashboardController::class, 'tataTertib'])->name('dashboard.tata-tertib');
    
    // Student Routes
    Route::resource('students', StudentController::class);
    Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
    
    // Point Routes
    Route::resource('points', PointController::class);
    Route::get('/points/history/{student}', [PointController::class, 'history'])->name('points.history');
    
    // Violation and Achievement Routes
    Route::resource('violations', ViolationController::class);
    
    // Class Routes
    Route::resource('classes', ClassController::class);
    
});
