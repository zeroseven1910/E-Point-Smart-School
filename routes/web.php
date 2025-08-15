<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViolationsController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes yang memerlukan authentication
Route::middleware(['auth'])->group(function () {
    
    // Dashboard - bisa diakses semua role
    Route::get('/dashboard', [DashboardController::class, 'guru'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'tataTertib'])->name('dashboard');

    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('classes', ClassController::class);
        Route::resource('students', StudentController::class);
        Route::resource('violations', ViolationsController::class);
        Route::get('/admin/reports', function () {
            return view('admin.reports');
        })->name('admin.reports');
    });
    
    // Teacher routes
    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/teacher/dashboard', function () {
            return view('teacher.dashboard');
        })->name('teacher.dashboard');
        Route::resource('points', PointController::class);
    });
    
    // Student routes
    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/dashboard', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
        Route::get('/student/points', [PointController::class, 'myPoints'])->name('student.points');
    });
});