<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViolationsController;
use App\Http\Controllers\PointController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Hanya untuk user login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard umum → redirect sesuai role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard khusus guru
    Route::get('/dashboard/guru', [DashboardController::class, 'guru'])->name('dashboard.guru');

    // Dashboard khusus tata tertib
    Route::get('/dashboard/tata-tertib', [DashboardController::class, 'tataTertib'])->name('dashboard.tata-tertib');

    // Dashboard siswa
    Route::get('/dashboard/student', function () {
        return view('dashboard.student');
    })->name('dashboard.student');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('classes', ClassController::class);     // classes.index, classes.create, dll
        Route::resource('students', StudentController::class);  // students.index, students.create, dll
        Route::resource('violations', ViolationsController::class);

        Route::get('/admin/reports', function () {
            return view('admin.reports');
        })->name('admin.reports');
    });

    /*
    |--------------------------------------------------------------------------
    | Teacher Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:teacher'])->group(function () {
        Route::resource('points', PointController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Student Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/points', [PointController::class, 'myPoints'])->name('student.points');
    });
});
