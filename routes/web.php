<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeFurloughController;
use App\Http\Controllers\SettingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('settings', SettingController::class);

    Route::get('/employees/{employee}/furloughs/propose', [EmployeeFurloughController::class, 'create'])
        ->name('employees.furloughs.create');
    Route::post('/employees/{employee}/furloughs/propose', [EmployeeFurloughController::class, 'store'])
        ->name('employees.furloughs.store');
});
