<?php

use App\Http\Controllers\Technicians\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:technician', 'preventBackHistory'])->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    
});