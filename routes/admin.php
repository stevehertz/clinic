<?php
// Admin Auth Group
use App\Http\Controllers\Admin\Admins\AdminsController;
use App\Http\Controllers\Admin\Appointments\AppointmentsController;
use App\Http\Controllers\Admin\Assets\AssetConditionsController;
use App\Http\Controllers\Admin\Assets\AssetsController;
use App\Http\Controllers\Admin\Assets\AssetTransferController;
use App\Http\Controllers\Admin\Assets\AssetTypesController;
use App\Http\Controllers\Admin\Assets\WorkshopAssetsController;
use App\Http\Controllers\Admin\Assets\WorkshopAssetTransferController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ClientType\ClientTypeController;
use App\Http\Controllers\Admin\Clinics\ClinicsController;
use App\Http\Controllers\Admin\Coating\CoatingController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Doctors\DoctorsController;
use App\Http\Controllers\Admin\Frames\FrameBrandsController;
use App\Http\Controllers\Admin\Frames\FrameColorsController;
use App\Http\Controllers\Admin\Frames\FrameMaterialsController;
use App\Http\Controllers\Admin\Frames\FramePurchasesController;
use App\Http\Controllers\Admin\Frames\FramesController;
use App\Http\Controllers\Admin\Frames\FrameShapesController;
use App\Http\Controllers\Admin\Frames\FrameSizesController;
use App\Http\Controllers\Admin\Frames\FramesStocksController;
use App\Http\Controllers\Admin\Frames\FrameTransfersController;
use App\Http\Controllers\Admin\Frames\FrameTypeController;
use App\Http\Controllers\Admin\Glasses\SunGlassesColorsController;
use App\Http\Controllers\Admin\Glasses\SunGlassesController;
use App\Http\Controllers\Admin\Glasses\SunGlassesShapesController;
use App\Http\Controllers\Admin\Glasses\SunGlassesSizesController;
use App\Http\Controllers\Admin\Glasses\SunGlassesStocksController;
use App\Http\Controllers\Admin\Insurances\InsurancesController;
use App\Http\Controllers\Admin\Lens\ContactLensController;
use App\Http\Controllers\Admin\Lens\LensController;
use App\Http\Controllers\Admin\Lens\LensIndicesController;
use App\Http\Controllers\Admin\Lens\LensPrescriptionController as LensLensPrescriptionController;
use App\Http\Controllers\Admin\Lens\LensPurchasesController;
use App\Http\Controllers\Admin\LensMaterial\LensMaterialsController;
use App\Http\Controllers\Admin\LensType\LensTypeController;
use App\Http\Controllers\Admin\Medicine\MedcineController;
use App\Http\Controllers\Admin\Orders\OrdersController as OrdersOrdersController;
use App\Http\Controllers\Admin\Orders\WorkshopOrdersController;
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
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Status\StatusController;
use App\Http\Controllers\Admin\Technicians\TechniciansController;
use App\Http\Controllers\Admin\Users\UsersController as UsersUsersController;
use App\Http\Controllers\Admin\Vendors\VendorsController;
use App\Http\Controllers\Admin\Workshops\WorkshopsController;
use App\Http\Controllers\Admin\Sales\WorkshopSalesController;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------
| Admin Routes
|---------------------------------------------------------
*/

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

            // Route::get('/index', [ClinicSettingsController::class, 'index'])->name('index');

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

                Route::prefix('sizes')->name('sizes.')->group(function () {

                    Route::get('/index', [SunGlassesSizesController::class, 'index'])->name('index');

                    Route::post('/store', [SunGlassesSizesController::class, 'store'])->name('store');

                    Route::post('/show', [SunGlassesSizesController::class, 'show'])->name('show');

                    Route::post('/{id}/update', [SunGlassesSizesController::class, 'update'])->name('update');

                    Route::delete('/{id}/delete', [SunGlassesSizesController::class, 'destroy'])->name('delete');
                });
            });
        });

        Route::prefix('workshops')->name('workshops.')->group(function(){

            Route::prefix('vendors')->name('vendors.')->group(function(){

                Route::get('/index', [VendorsController::class, 'index'])->name('index');

                Route::post('/store', [VendorsController::class, 'store'])->name('store');

                Route::post('/show', [VendorsController::class, 'show'])->name('show');

                Route::post('/{id}/update', [VendorsController::class, 'update'])->name('update');

                Route::delete('/{id}/delete', [VendorsController::class, 'destroy'])->name('delete');

            });

            Route::prefix('coating')->name('coating.')->group(function(){

                Route::get('/index', [CoatingController::class, 'index'])->name('index');

                Route::post('/store', [CoatingController::class, 'store'])->name('store');

                Route::post('/{id}/show', [CoatingController::class, 'show'])->name('show');

                Route::post('/{id}/update', [CoatingController::class, 'update'])->name('update');

                Route::delete('/{id}/delete', [CoatingController::class, 'destroy'])->name('delete');

            });

            Route::prefix('lens/index')->name('lens.index.')->group(function(){

                Route::get('/index', [LensIndicesController::class, 'index'])->name('index');

                Route::post('/store', [LensIndicesController::class, 'store'])->name('store');

                Route::post('/{id}/show', [LensIndicesController::class, 'show'])->name('show');

                Route::post('/{id}/update', [LensIndicesController::class, 'update'])->name('update');

                Route::delete('/{id}/delete', [LensIndicesController::class, 'destroy'])->name('delete');

            });

            Route::prefix('lens/type')->name('lens.type.')->group(function(){

                Route::get('index', [LensTypeController::class, 'index'])->name('index');

                Route::post('/store', [LensTypeController::class, 'store'])->name('store');

                Route::post('/show', [LensTypeController::class, 'show'])->name('show');

                Route::post('/update', [LensTypeController::class, 'update'])->name('update');

                Route::delete('/delete', [LensTypeController::class, 'destroy'])->name('delete');

            });

            Route::prefix('lens/material')->name('lens.material.')->group(function(){

                Route::get('/index', [LensMaterialsController::class, 'index'])->name('index');

                Route::post('/store', [LensMaterialsController::class, 'store'])->name('store');

                Route::post('/show', [LensMaterialsController::class, 'show'])->name('show');

                Route::post('/update', [LensMaterialsController::class, 'update'])->name('update');

                Route::delete('/delete', [LensMaterialsController::class, 'destroy'])->name('delete');

            });

        });

        Route::get('/index', [SettingsController::class, 'index'])->name('index');
        
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
    Route::prefix('clinics/reports')->name('clinics.reports.')->group(function () {

        Route::get('/index', [ClinicReportsController::class, 'index'])->name('index');

        Route::get('/export', [ClinicReportsController::class, 'export'])->name('export');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        Route::get('/{id}', [DashboardController::class, 'index'])->name('index');

        Route::get('/{id}/workshop', [DashboardController::class, 'workshop'])->name('workshop.index');
        
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

    Route::prefix('payments')->name('payments.')->group(function () {

        Route::prefix('bills')->name('bills.')->group(function () {

            Route::get('/{id}', [PaymentsController::class, 'index'])->name('index');

            Route::post('/show', [PaymentsController::class, 'show'])->name('show');

            Route::get('/{id}/view', [PaymentsController::class, 'view'])->name('view');

            Route::get('/{id}/print', [PaymentsController::class, 'print'])->name('print');
        });

        Route::prefix('closed/bills')->name('closed.bills.')->group(function () {

            Route::get('/{id}', [ClosedBillsController::class, 'index'])->name('index');

            Route::post('/show', [ClosedBillsController::class, 'show'])->name('show');

            Route::get('/{id}/view', [ClosedBillsController::class, 'view'])->name('view');

            Route::get('/{id}/print', [ClosedBillsController::class, 'print'])->name('print');
        });

        Route::prefix('remittance')->name('remittance.')->group(function () {

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

    Route::prefix('lens')->name('lens.')->group(function(){

        Route::get('/{id}/index', [LensController::class, 'index'])->name('index');

        Route::post('/store', [LensController::class, 'store'])->name('store');

        Route::post('/show', [LensController::class, 'show'])->name('show');

        Route::post('/update', [LensController::class, 'update'])->name('update');

        Route::delete('/delete', [LensController::class, 'destroy'])->name('delete');

    });

    Route::prefix('lens/purchase')->name('lens.purchase.')->group(function(){

        Route::get('/{id}/index', [LensPurchasesController::class, 'index'])->name('index');

        Route::get('/{id}/download', [LensPurchasesController::class, 'download'])->name('download');

        Route::post('/store', [LensPurchasesController::class, 'store'])->name('store');

        Route::post('/show', [LensPurchasesController::class, 'show'])->name('show');

        Route::post('/update', [LensPurchasesController::class, 'update'])->name('update');

        Route::delete('/delete', [LensPurchasesController::class, 'destroy'])->name('delete');
        
    });

    

   

    Route::prefix('lens/prescription')->name('lens.prescription.')->group(function () {

        Route::post('/show', [LensLensPrescriptionController::class, 'show'])->name('show');
        
    });

    // medicine
    Route::prefix('medicine')->name('medicine.')->group(function () {

        Route::get('/{id}', [MedcineController::class, 'index'])->name('index');
    });

    Route::prefix('workshop')->name('workshop.')->group(function () {

        Route::get('/index', [WorkshopsController::class, 'index'])->name('index');

        Route::post('/store', [WorkshopsController::class, 'store'])->name('store');

        Route::post('/show', [WorkshopsController::class, 'show'])->name('show');

        Route::get('/{id}/view', [WorkshopsController::class, 'view'])->name('view');

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

    // frame purchases
    Route::prefix('frame/purchases')
        ->name('frame.purchases.')
        ->group(function () {
            Route::get('/{id}', [FramePurchasesController::class, 'index'])->name('index');
            Route::post('/store', [FramePurchasesController::class, 'store'])->name('store');
            Route::delete('/delete', [FramePurchasesController::class, 'destroy'])->name('delete');
        });

    Route::prefix('frame/transfers')
        ->name('frame.transfers.')
        ->group(function() {

            Route::get('/{id}', [FrameTransfersController::class, 'index'])->name('index');

            Route::post('/store', [FrameTransfersController::class, 'store'])->name('store');

            Route::delete('/delete', [FrameTransfersController::class, 'destroy'])->name('delete');

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
    Route::prefix('users')->name('users.')->group(function () {

        Route::get('/{id}', [UsersUsersController::class, 'index'])->name('index');

        Route::post('/store', [UsersUsersController::class, 'store'])->name('store');

        Route::delete('/delete', [UsersUsersController::class, 'destroy'])->name('delete');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {

        Route::get('/{id}/export', [ReportsController::class, 'export'])->name('export');

        Route::get('/{id}', [ReportsController::class, 'index'])->name('index');
    });

    // Technicians
    Route::prefix('workshop/technicians')->name('workshop.technicians.')->group(function(){

        Route::get('/{id}/index', [TechniciansController::class, 'index'])->name('index');

        Route::post('/store', [TechniciansController::class, 'store'])->name('store');

        Route::delete('/{id}/delete', [TechniciansController::class, 'destroy'])->name('delete');

    });

    // Workshop Assets
    Route::prefix('workshop/assets')->name('workshop.assets.')->group(function(){

        Route::get('/{id}', [WorkshopAssetsController::class, 'index'])->name('index');

        Route::post('/store', [WorkshopAssetsController::class, 'store'])->name('store');

        Route::post('/show', [WorkshopAssetsController::class, 'show'])->name('show');

        Route::post('/update', [WorkshopAssetsController::class, 'update'])->name('update');

        Route::delete('/delete', [WorkshopAssetsController::class, 'destroy'])->name('delete');

    });

    Route::prefix('workshop/assets/transfer')->name('workshop.assets.transfer.')->group(function(){

        Route::get('/{id}', [WorkshopAssetTransferController::class, 'index'])->name('index');

        Route::post('/store', [WorkshopAssetTransferController::class, 'store'])->name('store');

        Route::post('/show', [WorkshopAssetTransferController::class, 'show'])->name('show');

    });

    Route::prefix('workshop/orders')->name('workshop.orders.')->group(function(){

        Route::get('/{id}', [WorkshopOrdersController::class, 'index'])->name('index');

        Route::post('/show', [WorkshopOrdersController::class, 'show'])->name('show');

        Route::get('/{id}/view', [WorkshopOrdersController::class, 'view'])->name('view');

    });

    Route::prefix('workshop/sales')->name('workshop.sales.')->group(function(){

        Route::get('/{id}', [WorkshopSalesController::class, 'index'])->name('index');
        
    });

});
