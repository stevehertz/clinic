<?php

use App\Http\Controllers\Technicians\Auth\LoginController;
use App\Http\Controllers\Technicians\Dashboard\DashboardController;
use App\Http\Controllers\Technicians\Technicians\TechniciansController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:technician', 'preventBackHistory'])->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::post('/login', [LoginController::class, 'store']);
    
});

Route::middleware(['auth:technician', 'preventBackHistory'])->group(function(){

    Route::prefix('dashboard')->name('dashboard.')->group(function()
    {
        Route::get('/index', [DashboardController::class, 'index'])->name('index');
    });

    Route::prefix('technicians')->name('technicians.')->group(function(){

        Route::get('/index', [TechniciansController::class, 'index'])->name('index');

        Route::post('/update', [TechniciansController::class, 'update'])->name('update');

        Route::post('/update/password', [TechniciansController::class, 'update_password'])->name('update.password');

        Route::post('/logout', [TechniciansController::class, 'logout'])->name('logout');

    });

});