<?php

use App\Http\Controllers\Users\Appointments\AppointmentsController as AppointmentsAppointmentsController;
use App\Http\Controllers\Users\Auth\ForgotPasswordController as AuthForgotPasswordController;
use App\Http\Controllers\Users\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Users\Auth\ResetPasswordController as AuthResetPasswordController;
use App\Http\Controllers\Users\Dashboard\DashboardController as DashboardDashboardController;
use App\Http\Controllers\Users\Diagnosis\DiagnosisController;
use App\Http\Controllers\Users\Lens\FramePrescriptionsController;
use App\Http\Controllers\Users\Lens\LensPowerController;
use App\Http\Controllers\Users\Lens\LensPrescriptionController;
use App\Http\Controllers\Users\Medicine\MedicineController;
use App\Http\Controllers\Users\Orders\OrdersController;
use App\Http\Controllers\Users\Orders\OrderTracksController;
use App\Http\Controllers\Users\Patients\PatientsController as PatientsPatientsController;
use App\Http\Controllers\Users\Payments\BillingController;
use App\Http\Controllers\Users\Payments\CloseBillsController;
use App\Http\Controllers\Users\Payments\PaymentDetailsController as PaymentsPaymentDetailsController;
use App\Http\Controllers\Users\Payments\PaymentsBillController;
use App\Http\Controllers\Users\Payments\RemittanceController;
use App\Http\Controllers\Users\Procedure\ProcedureController;
use App\Http\Controllers\Users\Schedule\DoctorSchedulesController;
use App\Http\Controllers\Users\Treatment\TreatmentController;
use App\Http\Controllers\Users\Users\UsersController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:web', 'preventBackHistory'])->group(function () {

    Route::get('/login', [AuthLoginController::class, 'index'])->name('login');

    Route::post('/login', [AuthLoginController::class, 'store']);

    Route::get('/forgot/password', [AuthForgotPasswordController::class, 'index'])->name('forgot.password');

    Route::post('/forgot/password', [AuthForgotPasswordController::class, 'store']);

    Route::get('/reset/password/{token}', [AuthResetPasswordController::class, 'index'])->name('reset.password');

    Route::post('reset/password/store', [AuthResetPasswordController::class, 'store'])->name('reset.password.store');
});

Route::middleware(['auth:web', 'preventBackHistory'])->group(function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        Route::get('/index', [DashboardDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('appointments')->name('appointments.')->group(function () {

        Route::get('/index', [AppointmentsAppointmentsController::class, 'index'])->name('index');

        Route::get('/create', [AppointmentsAppointmentsController::class, 'create'])->name('create');

        Route::post('/store', [AppointmentsAppointmentsController::class, 'store'])->name('store');

        Route::post('/show', [AppointmentsAppointmentsController::class, 'show'])->name('show');

        Route::get('/{id}/view', [AppointmentsAppointmentsController::class, 'view'])->name('view');
    });

    Route::prefix('/users')->name('users.')->group(function () {

        Route::get('/index', [UsersController::class, 'index'])->name('index');

        Route::post('/update', [UsersController::class, 'update'])->name('update');

        Route::post('/update/password', [UsersController::class, 'update_password'])->name('update.password');

        Route::post('/logout', [UsersController::class, 'logout'])->name('logout');
    });

    Route::prefix('patients')->name('patients.')->group(function () {

        Route::get('/index', [PatientsPatientsController::class, 'index'])->name('index');

        Route::get('/create', [PatientsPatientsController::class, 'create'])->name('create');

        Route::post('/create', [PatientsPatientsController::class, 'store']);

        Route::post('/show', [PatientsPatientsController::class, 'show'])->name('show');

        Route::get('/{id}/view', [PatientsPatientsController::class, 'view'])->name('view');

        Route::get('/{id}/edit', [PatientsPatientsController::class, 'edit'])->name('edit');

        Route::post('/{id}/edit', [PatientsPatientsController::class, 'update']);

        Route::post('/delete', [PatientsPatientsController::class, 'destroy'])->name('delete');
    });

    Route::prefix('payments')->name('payments.')->group(function () {

        Route::prefix('details')->name('details.')->group(function () {

            Route::post('/store', [PaymentsPaymentDetailsController::class, 'store'])->name('store');
        });

        Route::prefix('bills')->name('bills.')->group(function () {

            Route::get('/index', [PaymentsBillController::class, 'index'])->name('index');

            Route::get('/{id}/create', [PaymentsBillController::class, 'create'])->name('create');

            Route::post('/store', [PaymentsBillController::class, 'store'])->name('store');

            Route::post('/show', [PaymentsBillController::class, 'show'])->name('show');

            Route::get('/{id}/view', [PaymentsBillController::class, 'view'])->name('view');

            Route::get('/{id}/edit', [PaymentsBillController::class, 'edit'])->name('edit');

            Route::post('/update/agreed/amount', [PaymentsBillController::class, 'update_agreed'])->name('update.agreed.amount');

            Route::post('/update/consultation', [PaymentsBillController::class, 'update_consultation'])->name('update.consultation');

            Route::get('/{d}/print', [PaymentsBillController::class, 'print'])->name('print');
        });

        Route::prefix('close/bills')->name('close.bills.')->group(function () {

            Route::get('/index', [CloseBillsController::class, 'index'])->name('index');

            Route::post('/store', [CloseBillsController::class, 'store'])->name('store');

            Route::post('/show', [CloseBillsController::class, 'show'])->name('show');

            Route::get('/{id}/view', [CloseBillsController::class, 'view'])->name('view');

            Route::post('/update/lpo', [CloseBillsController::class, 'update_lpo'])->name('update.lpo');

            Route::get('/{id}/print', [CloseBillsController::class, 'print'])->name('print');
        });

        Route::prefix('billing')->name('billing.')->group(function () {

            Route::post('/store', [BillingController::class, 'store'])->name('store');

            Route::post('/update/paid', [BillingController::class, 'update_payment_bill'])->name('update.paid');
        });

        Route::prefix('remittance')->name('remittance.')->group(function () {

            Route::get('/index', [RemittanceController::class, 'index'])->name('index');

            Route::post('/store', [RemittanceController::class, 'store'])->name('store');

            Route::get('/{id}/view', [RemittanceController::class, 'view'])->name('view');

            Route::post('/show', [RemittanceController::class, 'show'])->name('show');

            Route::post('update/bill', [RemittanceController::class, 'update_bill'])->name('update.bill');
        });
    });

    Route::prefix('doctor/schedules')->name('doctor.schedules.')->group(function () {

        Route::get('/index', [DoctorSchedulesController::class, 'index'])->name('index');

        Route::post('/store', [DoctorSchedulesController::class, 'store'])->name('store');

        Route::post('/show', [DoctorSchedulesController::class, 'show'])->name('show');

        Route::get('/{id}/view', [DoctorSchedulesController::class, 'view'])->name('view');
    });

    Route::prefix('diagnosis')->name('diagnosis.')->group(function () {

        Route::post('/store', [DiagnosisController::class, 'store'])->name('store');

        Route::post('/show', [DiagnosisController::class, 'show'])->name('show');

        Route::post('/update', [DiagnosisController::class, 'update'])->name('update');
    });

    Route::prefix('treatment')->name('treatment.')->group(function () {

        Route::get('/{id}/create', [TreatmentController::class, 'create'])->name('create');
    });

    Route::prefix('lens')->name('lens.')->group(function () {

        Route::prefix('power')->name('power.')->group(function () {

            Route::post('/store', [LensPowerController::class, 'store'])->name('store');

            Route::post('/show', [LensPowerController::class, 'show'])->name('show');

            Route::post('/update', [LensPowerController::class, 'update'])->name('update');
            
        });

        Route::prefix('prescription')->name('prescription.')->group(function () {

            Route::post('/store', [LensPrescriptionController::class, 'store'])->name('store');

            Route::post('/show', [LensPrescriptionController::class, 'show'])->name('show');
        });

        Route::prefix('frame/prescription')->name('frame.prescription.')->group(function () {

            Route::post('/store', [FramePrescriptionsController::class, 'store'])->name('store');

            Route::post('/show', [FramePrescriptionsController::class, 'show'])->name('show');
        });
    });

    Route::prefix('medicine')->name('medicine.')->group(function () {

        Route::get('/{id}', [MedicineController::class, 'index'])->name('index');

        Route::post('/store', [MedicineController::class, 'store'])->name('store');

        Route::post('/show', [MedicineController::class, 'show'])->name('show');

        Route::post('/delete', [MedicineController::class, 'destroy'])->name('delete');
    });

    Route::prefix('procedure')->name('procedure.')->group(function () {

        Route::post('/store', [ProcedureController::class, 'store'])->name('store');
    });

    Route::prefix('orders')->name('orders.')->group(function () {

        Route::get('/index', [OrdersController::class, 'index'])->name('index');

        Route::post('/store', [OrdersController::class, 'store'])->name('store');

        Route::post('/show', [OrdersController::class, 'show'])->name('show');

        Route::get('/{id}/view', [OrdersController::class, 'view'])->name('view');

        Route::post('/{id}/update', [OrdersController::class, 'update'])->name('update');

        Route::post('/send/mail', [OrdersController::class, 'send_mail'])->name('send.mail');
    });

    Route::prefix('order/track')->name('order.track.')->group(function () {

        Route::post('/store', [OrderTracksController::class, 'store'])->name('store');
    });
});
