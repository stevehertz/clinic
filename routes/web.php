<?php

use App\Http\Controllers\Admin\Admins\AdminsController;
use App\Http\Controllers\Admin\Appointments\AppointmentsController;
use App\Http\Controllers\Admin\Assets\AssetConditionsController;
use App\Http\Controllers\Admin\Assets\AssetsController;
use App\Http\Controllers\Admin\Assets\AssetTransferController;
use App\Http\Controllers\Admin\Assets\AssetTypesController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ClientType\ClientTypeController;
use App\Http\Controllers\Admin\Clinics\ClinicsController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Doctors\DoctorsController;
use App\Http\Controllers\Admin\Frames\FrameBrandsController;
use App\Http\Controllers\Admin\Frames\FrameColorsController;
use App\Http\Controllers\Admin\Frames\FrameMaterialsController;
use App\Http\Controllers\Admin\Frames\FramesController;
use App\Http\Controllers\Admin\Frames\FrameShapesController;
use App\Http\Controllers\Admin\Frames\FrameSizesController;
use App\Http\Controllers\Admin\Frames\FramesStocksController;
use App\Http\Controllers\Admin\Frames\FrameTypeController;
use App\Http\Controllers\Admin\Glasses\SunGlassesColorsController;
use App\Http\Controllers\Admin\Glasses\SunGlassesController;
use App\Http\Controllers\Admin\Glasses\SunGlassesShapesController;
use App\Http\Controllers\Admin\Glasses\SunGlassesSizesController;
use App\Http\Controllers\Admin\Glasses\SunGlassesStocksController;
use App\Http\Controllers\Admin\Insurances\InsurancesController;
use App\Http\Controllers\Admin\Lens\ContactLensController;
use App\Http\Controllers\Admin\Lens\LensPrescriptionController as LensLensPrescriptionController;
use App\Http\Controllers\Admin\LensMaterial\LensMaterialsController;
use App\Http\Controllers\Admin\LensType\LensTypeController;
use App\Http\Controllers\Admin\Medicine\MedcineController;
use App\Http\Controllers\Admin\Orders\OrdersController as OrdersOrdersController;
use App\Http\Controllers\Admin\Organization\OrganizationController;
use App\Http\Controllers\Admin\Patients\PatientsController;
use App\Http\Controllers\Admin\Payments\ClosedBillsController;
use App\Http\Controllers\Admin\Payments\PaymentDetailsController;
use App\Http\Controllers\Admin\Payments\PaymentsController;
use App\Http\Controllers\Admin\Payments\RemittanceController as PaymentsRemittanceController;
use App\Http\Controllers\Admin\Reports\ClinicReportsController;
use App\Http\Controllers\Admin\Reports\ReportsController;
use App\Http\Controllers\Admin\Schedules\DoctorSchedulesController as SchedulesDoctorSchedulesController;
use App\Http\Controllers\Admin\Settings\Clinics\ClinicSettingsController;
use App\Http\Controllers\Admin\Status\StatusController;
use App\Http\Controllers\Admin\Users\UsersController as UsersUsersController;
use App\Http\Controllers\Admin\Workshops\WorkshopsController;
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
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|---------------------------------------------------------
| Landing Page Routes
|---------------------------------------------------------
*/

Route::middleware('preventBackHistory')->group(function () {

    Route::view('/', 'front.pages.index')->name('home');
});


/*
|---------------------------------------------------------
| Admin Routes
|---------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Auth Group
    Route::middleware(['guest:admin', 'preventBackHistory'])->group(function () {

        Route::view('login', 'admin.auth.login')->name('login');

        Route::post('login', [LoginController::class, 'store']);

        Route::view('register', 'admin.auth.register')->name('register');

        Route::post('register', [RegisterController::class, 'store']);

        Route::get('forget/password', [ForgotPasswordController::class, 'index'])->name('forget.password');

        Route::post('forget/password', [ForgotPasswordController::class, 'store']);

        Route::get('reset/password/{token}', [ResetPasswordController::class, 'index'])->name('reset.password');

        Route::post('reset/password/store', [ResetPasswordController::class, 'store'])->name('reset.password.store');
    });

    // Admin Dashboard Group
    Route::middleware(['auth:admin', 'preventBackHistory'])->group(function () {

        // Admin Organization Auth Group
        Route::prefix('organization')->name('organization.')->group(function () {

            Route::get('/index', [OrganizationController::class, 'index'])->name('index');

            Route::get('/create', [OrganizationController::class, 'create'])->name('create');

            Route::post('/store', [OrganizationController::class, 'store'])->name('store');

            Route::post('/show', [OrganizationController::class, 'show'])->name('show');

            Route::get('/view', [OrganizationController::class, 'view'])->name('view');

            Route::post('/update', [OrganizationController::class, 'update'])->name('update');
        });

        // settings
        Route::prefix('settings')->name('settings.')->group(function () {

            Route::prefix('clinics')->name('clinics.')->group(function () {

                Route::get('/index', [ClinicSettingsController::class, 'index'])->name('index');

                Route::prefix('assets')->name('assets.')->group(function () {

                    Route::prefix('type')->name('type.')->group(function () {

                        Route::get('/index', [AssetTypesController::class, 'index'])->name('index');

                        Route::post('/store', [AssetTypesController::class, 'store'])->name('store');

                        Route::post('/show', [AssetTypesController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [AssetTypesController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [AssetTypesController::class, 'destroy'])->name('delete');
                    });

                    Route::prefix('conditions')->name('conditions.')->group(function () {

                        Route::get('/index', [AssetConditionsController::class, 'index'])->name('index');

                        Route::post('/store', [AssetConditionsController::class, 'store'])->name('store');

                        Route::post('/show', [AssetConditionsController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [AssetConditionsController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [AssetConditionsController::class, 'destroy'])->name('delete');
                    });
                });

                Route::prefix('frames')->name('frames.')->group(function () {

                    Route::prefix('type')->name('type.')->group(function () {

                        Route::get('/index', [FrameTypeController::class, 'index'])->name('index');

                        Route::post('/store', [FrameTypeController::class, 'store'])->name('store');

                        Route::post('/show', [FrameTypeController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [FrameTypeController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [FrameTypeController::class, 'destroy'])->name('delete');
                    });

                    Route::prefix('materials')->name('materials.')->group(function () {

                        Route::get('/index', [FrameMaterialsController::class, 'index'])->name('index');

                        Route::post('/store', [FrameMaterialsController::class, 'store'])->name('store');

                        Route::post('/show', [FrameMaterialsController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [FrameMaterialsController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [FrameMaterialsController::class, 'destroy'])->name('delete');
                    });

                    Route::prefix('brands')->name('brands.')->group(function () {

                        Route::get('/index', [FrameBrandsController::class, 'index'])->name('index');

                        Route::post('/store', [FrameBrandsController::class, 'store'])->name('store');

                        Route::post('/show', [FrameBrandsController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [FrameBrandsController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [FrameBrandsController::class, 'destroy'])->name('delete');
                    });

                    Route::prefix('sizes')->name('sizes.')->group(function () {

                        Route::get('/index', [FrameSizesController::class, 'index'])->name('index');

                        Route::post('/store', [FrameSizesController::class, 'store'])->name('store');

                        Route::post('/show', [FrameSizesController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [FrameSizesController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [FrameSizesController::class, 'destroy'])->name('delete');
                    });

                    Route::prefix('colors')->name('colors.')->group(function () {

                        Route::get('/index', [FrameColorsController::class, 'index'])->name('index');

                        Route::post('/store', [FrameColorsController::class, 'store'])->name('store');

                        Route::post('/show', [FrameColorsController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [FrameColorsController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [FrameColorsController::class, 'destroy'])->name('delete');
                    });

                    Route::prefix('shapes')->name('shapes.')->group(function () {

                        Route::get('/index', [FrameShapesController::class, 'index'])->name('index');

                        Route::post('/store', [FrameShapesController::class, 'store'])->name('store');

                        Route::post('/show', [FrameShapesController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [FrameShapesController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [FrameShapesController::class, 'destroy'])->name('delete');
                    });
                });

                Route::prefix('glasses')->name('glasses.')->group(function () {

                    Route::prefix('colors')->name('colors.')->group(function () {

                        Route::get('/index', [SunGlassesColorsController::class, 'index'])->name('index');

                        Route::post('/store', [SunGlassesColorsController::class, 'store'])->name('store');

                        Route::post('/show', [SunGlassesColorsController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [SunGlassesColorsController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [SunGlassesColorsController::class, 'destroy'])->name('delete');
                    });

                    Route::prefix('shapes')->name('shapes.')->group(function () {

                        Route::get('/index', [SunGlassesShapesController::class, 'index'])->name('index');

                        Route::post('/store', [SunGlassesShapesController::class, 'store'])->name('store');

                        Route::post('/show', [SunGlassesShapesController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [SunGlassesShapesController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [SunGlassesShapesController::class, 'destroy'])->name('delete');

                    });

                    Route::prefix('sizes')->name('sizes.')->group(function(){

                        Route::get('/index', [SunGlassesSizesController::class, 'index'])->name('index');

                        Route::post('/store', [SunGlassesSizesController::class, 'store'])->name('store');

                        Route::post('/show', [SunGlassesSizesController::class, 'show'])->name('show');

                        Route::post('/{id}/update', [SunGlassesSizesController::class, 'update'])->name('update');

                        Route::delete('/{id}/delete', [SunGlassesSizesController::class, 'destroy'])->name('delete');

                    });
                });
            });
        });

        Route::prefix('status')->name('status.')->group(function () {

            Route::get('/index', [StatusController::class, 'index'])->name('index');

            Route::post('/store', [StatusController::class, 'store'])->name('store');

            Route::post('/show', [StatusController::class, 'show'])->name('show');

            Route::post('/update', [StatusController::class, 'update'])->name('update');

            Route::post('/delete', [StatusController::class, 'destroy'])->name('delete');
        });

        Route::prefix('client/type')->name('client.type.')->group(function () {

            Route::get('/index', [ClientTypeController::class, 'index'])->name('index');

            Route::post('/store', [ClientTypeController::class, 'store'])->name('store');

            Route::post('/show', [ClientTypeController::class, 'show'])->name('show');

            Route::post('/update', [ClientTypeController::class, 'update'])->name('update');

            Route::post('/delete', [ClientTypeController::class, 'destroy'])->name('delete');
        });

        Route::prefix('insurance')->name('insurance.')->group(function () {

            Route::get('/index', [InsurancesController::class, 'index'])->name('index');

            Route::post('/store', [InsurancesController::class, 'store'])->name('store');

            Route::post('/show', [InsurancesController::class, 'show'])->name('show');

            Route::post('/update', [InsurancesController::class, 'update'])->name('update');

            Route::post('/delete', [InsurancesController::class, 'destroy'])->name('delete');
        });

        Route::prefix('personal')->name('personal.')->group(function () {

            Route::get('/index', [AdminsController::class, 'index'])->name('index');

            Route::post('/update', [AdminsController::class, 'update'])->name('update');

            Route::post('/update/password', [AdminsController::class, 'update_password'])->name('update.password');

            Route::post('/logout', [AdminsController::class, 'logout'])->name('logout');
        });

        Route::prefix('clinics')->name('clinics.')->group(function () {

            Route::get('/index', [ClinicsController::class, 'index'])->name('index');

            Route::post('/store', [ClinicsController::class, 'store'])->name('store');

            Route::post('/show', [ClinicsController::class, 'show'])->name('show');

            Route::get('/{id}', [ClinicsController::class, 'view'])->name('view');

            Route::post('/update', [ClinicsController::class, 'update'])->name('update');
        });

        // clinics Reports
        Route::prefix('clinics/reports')->name('clinics.reports.')->group(function(){

            Route::get('/index', [ClinicReportsController::class, 'index'])->name('index');

            Route::get('/export', [ClinicReportsController::class, 'export'])->name('export');

        });

        Route::prefix('dashboard')->name('dashboard.')->group(function () {

            Route::get('/{id}', [DashboardController::class, 'index'])->name('index');
        });

        Route::prefix('patients')->name('patients.')->group(function () {

            Route::get('/{id}', [PatientsController::class, 'index'])->name('index');

            Route::get('/{id}/create', [PatientsController::class, 'create'])->name('create');

            Route::post('/store', [PatientsController::class, 'store'])->name('store');

            Route::post('/show', [PatientsController::class, 'show'])->name('show');

            Route::get('/{id}/view', [PatientsController::class, 'view'])->name('view');

            Route::get('/{id}/edit', [PatientsController::class, 'edit'])->name('edit');

            Route::post('/update', [PatientsController::class, 'update'])->name('update');

            Route::get('/{id}/export', [PatientsController::class, 'export'])->name('export');

            Route::post('/delete', [PatientsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('payments')->name('payments.')->group(function(){

            Route::prefix('bills')->name('bills.')->group(function(){

                Route::get('/{id}', [PaymentsController::class, 'index'])->name('index');

                Route::post('/show', [PaymentsController::class, 'show'])->name('show');

                Route::get('/{id}/view', [PaymentsController::class, 'view'])->name('view');

                Route::get('/{id}/print', [PaymentsController::class, 'print'])->name('print');

            });

            Route::prefix('closed/bills')->name('closed.bills.')->group(function(){

                Route::get('/{id}', [ClosedBillsController::class, 'index'])->name('index');

                Route::post('/show', [ClosedBillsController::class, 'show'])->name('show');

                Route::get('/{id}/view', [ClosedBillsController::class, 'view'])->name('view');

                Route::get('/{id}/print', [ClosedBillsController::class, 'print'])->name('print');

            });

            Route::prefix('remittance')->name('remittance.')->group(function(){

                Route::get('/{id}', [PaymentsRemittanceController::class, 'index'])->name('index');

                Route::post('/show', [PaymentsRemittanceController::class, 'show'])->name('show');

                Route::get('/{id}/view', [PaymentsRemittanceController::class, 'view'])->name('view');

                Route::post('/close', [PaymentsRemittanceController::class, 'close'])->name('close');

            });

        });

        Route::prefix('orders')->name('orders.')->group(function () {

            Route::get('/{id}', [OrdersOrdersController::class, 'index'])->name('index');

            Route::post('/show', [OrdersOrdersController::class, 'show'])->name('show');

            Route::get('/{id}/view', [OrdersOrdersController::class, 'view'])->name('view');

        });

        Route::prefix('payments/details')->name('payments.details.')->group(function () {

            Route::post('/store', [PaymentDetailsController::class, 'store'])->name('store');
        });

        Route::prefix('appointments')->name('appointments.')->group(function () {

            Route::get('/{id}', [AppointmentsController::class, 'index'])->name('index');

            Route::post('/show', [AppointmentsController::class, 'show'])->name('show');

            Route::get('/{id}/view', [AppointmentsController::class, 'view'])->name('view');

            Route::get('/{id}/export', [AppointmentsController::class, 'export'])->name('export');

        });

        // doctor schedules
        Route::prefix('doctor/schedules')->name('doctor.schedules.')->group(function () {

            Route::get('/{id}', [SchedulesDoctorSchedulesController::class, 'index'])->name('index');

            Route::post('/show', [SchedulesDoctorSchedulesController::class, 'show'])->name('show');

            Route::get('/{id}/view', [SchedulesDoctorSchedulesController::class, 'view'])->name('view');

        });

        Route::prefix('lens/type')->name('lens.type.')->group(function () {

            Route::get('/index', [LensTypeController::class, 'index'])->name('index');

            Route::post('/store', [LensTypeController::class, 'store'])->name('store');

            Route::post('/show', [LensTypeController::class, 'show'])->name('show');

            Route::post('/update', [LensTypeController::class, 'update'])->name('update');

            Route::post('/delete', [LensTypeController::class, 'destroy'])->name('delete');
        });

        Route::prefix('lens/material')->name('lens.material.')->group(function () {

            Route::get('/index', [LensMaterialsController::class, 'index'])->name('index');

            Route::post('/store', [LensMaterialsController::class, 'store'])->name('store');

            Route::post('/show', [LensMaterialsController::class, 'show'])->name('show');

            Route::post('/update', [LensMaterialsController::class, 'update'])->name('update');

            Route::post('/delete', [LensMaterialsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('lens')->name('lens.')->group(function (){

            Route::prefix('prescription')->name('prescription.')->group(function(){

                Route::post('/show', [LensLensPrescriptionController::class, 'show'])->name('show');

            });

        });

        // medicine
        Route::prefix('medicine')->name('medicine.')->group(function(){

            Route::get('/{id}', [MedcineController::class, 'index'])->name('index');

        });

        Route::prefix('workshop')->name('workshop.')->group(function () {

            Route::get('/index', [WorkshopsController::class, 'index'])->name('index');

            Route::post('/store', [WorkshopsController::class, 'store'])->name('store');

            Route::post('/show', [WorkshopsController::class, 'show'])->name('show');

            Route::post('/update', [WorkshopsController::class, 'update'])->name('update');

            Route::post('/delete', [WorkshopsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('assets')->name('assets.')->group(function () {

            Route::get('/{id}', [AssetsController::class, 'index'])->name('index');

            Route::post('/store', [AssetsController::class, 'store'])->name('store');

            Route::post('/show', [AssetsController::class, 'show'])->name('show');

            Route::post('/update', [AssetsController::class, 'update'])->name('update');

            Route::delete('/delete', [AssetsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('assets/transfer')->name('asset.tranfer.')->group(function () {

            Route::get('/{id}', [AssetTransferController::class, 'index'])->name('index');

            Route::post('/store', [AssetTransferController::class, 'store'])->name('store');
        });

        // frames
        Route::prefix('frames')->name('frames.')->group(function () {

            Route::get('/{id}', [FramesController::class, 'index'])->name('index');

            Route::get('/{id}/frames', [FramesController::class, 'frames'])->name('frames');

            Route::post('/store', [FramesController::class, 'store'])->name('store');

            Route::post('/show', [FramesController::class, 'show'])->name('show');

            Route::post('/update', [FramesController::class, 'update'])->name('update');

            Route::delete('/delete', [FramesController::class, 'destroy'])->name('delete');
        });

        // frame stocks
        Route::prefix('frame/stocks')->name('frame.stocks.')->group(function () {

            Route::get('/{id}', [FramesStocksController::class, 'stocks'])->name('stocks');

            Route::get('/{id}/index', [FramesStocksController::class, 'index'])->name('index');

            Route::post('/store', [FramesStocksController::class, 'store'])->name('store');

            Route::post('/show', [FramesStocksController::class, 'show'])->name('show');

            Route::post('/update', [FramesStocksController::class, 'update'])->name('update');

            Route::delete('/delete', [FramesStocksController::class, 'destroy'])->name('delete');
        });

        // Sun glasses
        Route::prefix('sun/glasses')->name('sun.glasses.')->group(function () {

            Route::get('/{id}', [SunGlassesController::class, 'index'])->name('index');

            Route::post('/store', [SunGlassesController::class, 'store'])->name('store');

            Route::post('/show', [SunGlassesController::class, 'show'])->name('show');

            Route::post('/update', [SunGlassesController::class, 'update'])->name('update');

            Route::delete('/delete', [SunGlassesController::class, 'destroy'])->name('delete');
        });

        // sun glasses stocks
        Route::prefix('sun/glasses/stocks')->name('sun.glasses.stocks.')->group(function () {

            Route::get('/{id}', [SunGlassesStocksController::class, 'index'])->name('index');

            Route::post('/store', [SunGlassesStocksController::class, 'store'])->name('store');

            Route::post('/show', [SunGlassesStocksController::class, 'show'])->name('show');

            Route::post('/update', [SunGlassesStocksController::class, 'update'])->name('update');

            Route::delete('/delete', [SunGlassesStocksController::class, 'destroy'])->name('delete');
        });

        // users
        Route::prefix('users')->name('users.')->group(function(){

            Route::get('/{id}', [UsersUsersController::class, 'index'])->name('index');

            Route::post('/store', [UsersUsersController::class, 'store'])->name('store');

            Route::delete('/delete', [UsersUsersController::class, 'destroy'])->name('delete');

        });

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {

            Route::get('/{id}/export', [ReportsController::class, 'export'])->name('export');

            Route::get('/{id}', [ReportsController::class, 'index'])->name('index');

        });
    });
});

Route::prefix('users')->name('users.')->group(function () {

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

            Route::prefix('close/bills')->name('close.bills.')->group(function(){

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

            Route::prefix('remittance')->name('remittance.')->group(function(){

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
        });

        Route::prefix('treatment')->name('treatment.')->group(function () {

            Route::get('/{id}/create', [TreatmentController::class, 'create'])->name('create');
        });

        Route::prefix('lens')->name('lens.')->group(function () {

            Route::prefix('power')->name('power.')->group(function () {

                Route::post('/store', [LensPowerController::class, 'store'])->name('store');

                Route::post('/show', [LensPowerController::class, 'show'])->name('show');
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
});
