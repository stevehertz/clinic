<?php

use App\Http\Controllers\Admin\Payments\BillingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Payments\PaymentsController;
use App\Http\Controllers\Admin\Payments\ClosedBillsController;
use App\Http\Controllers\Admin\Payments\PaymentDetailsController;

Route::prefix('payments')->name('payments.')->group(function () {

    Route::prefix('bills')->name('bills.')->group(function () {
        Route::get('/{id}', [PaymentsController::class, 'index'])->name('index');
        Route::get('/{payment_id}/show', [PaymentsController::class, 'show'])->name('show');
        Route::get('/{id}/{payment_id}/view', [PaymentsController::class, 'view'])->name('view');
        Route::get('/{id}/{payment_id}/print', [PaymentsController::class, 'print'])->name('print');
    });

    Route::prefix('closed/bills')->name('closed.bills.')->group(function () {
        Route::get('/{id}', [ClosedBillsController::class, 'index'])->name('index');
        Route::get('/{paymentBill}/show', [ClosedBillsController::class, 'show'])->name('show');
        Route::get('/{id}/view', [ClosedBillsController::class, 'view'])->name('view');
        Route::get('/{id}/print', [ClosedBillsController::class, 'print'])->name('print');
    });
});


Route::prefix('payments/details')->name('payments.details.')->group(function () {

    Route::post('/store', [PaymentDetailsController::class, 'store'])->name('store');
});


Route::prefix('billing')->name('billing.')->group(function(){

    Route::get('/{clinic}', [BillingController::class, 'index'])->name('index');

});