<?php

use App\Http\Controllers\Admin\AssociateController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\CollectionCentreController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\DiscountTypeController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LabCentreController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PaymentModeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TestCategoryController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\TestGroupController;
use App\Http\Controllers\Admin\TestReportController;
use App\Http\Controllers\Admin\TestUnitController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

//==========================================================================================================================
//========================== auth:admin ====================================================================================
//==========================================================================================================================
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
//=================== Admin Dashboard ========================
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/test', function () {
        return view('admin.dashboard');
    })->name('test');
    Route::get('/package', function () {
        return view('admin.dashboard');
    })->name('package');

    //==========================================================================================================================
//========================== test ====================================================================================
//==========================================================================================================================

    Route::get('test', [TestController::class, 'index'])->name('test.index');
    Route::get('test/create', [TestController::class, 'create'])->name('test.create');
    Route::post('test/create', [TestController::class, 'store'])->name('test.store');
    Route::get('test/show/{id}', [TestController::class, 'show'])->name('test.show');
    Route::get('test/edit/{id}', [TestController::class, 'edit'])->name('test.edit');
    Route::post('test/update/{id}', [TestController::class, 'update'])->name('test.update');
    Route::delete('test/{id}', [TestController::class, 'destroy'])->name('test.delete');
    Route::get('test/get/cat_group', [TestController::class, 'GetCategoryByGroupID'])->name('get-category-by-groupid');
    Route::get('test/package/delete/{id}', [PackageController::class, 'delete_test_package'])->name('delete_test_package');

    //==========================================================================================================================
//========================== TestCategory ====================================================================================
//==========================================================================================================================
    Route::get('test_category', [TestCategoryController::class, 'index'])->name('test_category.index');
    Route::get('test_category/create', [TestCategoryController::class, 'create'])->name('test_category.create');
    Route::post('test_category/create', [TestCategoryController::class, 'store'])->name('test_category.store');
    Route::get('test_category/show/{id}', [TestCategoryController::class, 'show'])->name('test_category.show');
    Route::get('test_category/edit/{id}', [TestCategoryController::class, 'edit'])->name('test_category.edit');
    Route::post('test_category/update/{id}', [TestCategoryController::class, 'update'])->name('test_category.update');
    Route::get('test_category/delete/{id}', [TestCategoryController::class, 'destroy'])->name('test_category.delete');

    //==========================================================================================================================
//========================== TestGroup ====================================================================================
//==========================================================================================================================
    Route::get('test_group', [TestGroupController::class, 'index'])->name('test_group.index');
    Route::get('test_group/create', [TestGroupController::class, 'create'])->name('test_group.create');
    Route::post('test_group/create', [TestGroupController::class, 'store'])->name('test_group.store');
    Route::get('test_group/show/{id}', [TestGroupController::class, 'show'])->name('test_group.show');
    Route::get('test_group/edit/{id}', [TestGroupController::class, 'edit'])->name('test_group.edit');
    Route::post('test_group/update/{id}', [TestGroupController::class, 'update'])->name('test_group.update');
    Route::get('test_group/delete/{tpid}', [TestGroupController::class, 'destroy'])->name('test_group.delete');
    //==========================================================================================================================
//========================== TestReport ====================================================================================
//==========================================================================================================================
    Route::get('test_report/config/{id}', [TestReportController::class, 'config'])->name('test_report.config');
    Route::get('test_report/config_examination/{id}', [TestReportController::class, 'config_examination'])->name('test_report.config_examination');
    Route::post('test_report/store_examination', [TestReportController::class, 'store'])->name('test_report.store_examination');

    //==========================================================================================================================
//========================== TestUnit ====================================================================================
//==========================================================================================================================
    Route::get('test_unit', [TestUnitController::class, 'index'])->name('test_unit.index');
    Route::get('test_unit/create', [TestUnitController::class, 'create'])->name('test_unit.create');
    Route::post('test_unit/create', [TestUnitController::class, 'store'])->name('test_unit.store');
    Route::get('test_unit/show/{id}', [TestUnitController::class, 'show'])->name('test_unit.show');
    Route::get('test_unit/edit/{id}', [TestUnitController::class, 'edit'])->name('test_unit.edit');
    Route::post('test_unit/update/{id}', [TestUnitController::class, 'update'])->name('test_unit.update');
    Route::get('test_unit/delete/{id}', [TestUnitController::class, 'destroy'])->name('test_unit.delete');

    //==========================================================================================================================
//========================== package ====================================================================================
//==========================================================================================================================
    Route::get('package', [PackageController::class, 'index'])->name('package.index');
    Route::get('package/create', [PackageController::class, 'create'])->name('package.create');
    Route::get('package/gettest', [PackageController::class, 'gettest'])->name('package.gettest');
    Route::post('package/create', [PackageController::class, 'store'])->name('package.store');
    Route::get('package/show/{id}', [PackageController::class, 'show'])->name('package.show');
    Route::get('package/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('package/edit/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::delete('package/{id}', [PackageController::class, 'destroy'])->name('package.delete');

//==========================================================================================================================
//========================== DiscountType ====================================================================================
//==========================================================================================================================
    Route::get('discount_type', [DiscountTypeController::class, 'index'])->name('discount_type.index');
    Route::get('discount_type/create', [DiscountTypeController::class, 'create'])->name('discount_type.create');
    Route::post('discount_type/create', [DiscountTypeController::class, 'store'])->name('discount_type.store');
    Route::get('discount_type/show/{id}', [DiscountTypeController::class, 'show'])->name('discount_type.show');
    Route::get('discount_type/edit/{id}', [DiscountTypeController::class, 'edit'])->name('discount_type.edit');
    Route::post('discount_type/edit/{id}', [DiscountTypeController::class, 'update'])->name('discount_type.update');
    Route::delete('discount_type/{id}', [DiscountTypeController::class, 'destroy'])->name('discount_type.delete');

//==========================================================================================================================
//========================== PaymentMode ====================================================================================
//==========================================================================================================================
    Route::get('payment_mode', [PaymentModeController::class, 'index'])->name('payment_mode.index');
    Route::get('payment_mode/create', [PaymentModeController::class, 'create'])->name('payment_mode.create');
    Route::post('payment_mode/create', [PaymentModeController::class, 'store'])->name('payment_mode.store');
    Route::get('payment_mode/show/{id}', [PaymentModeController::class, 'show'])->name('payment_mode.show');
    Route::get('payment_mode/edit/{id}', [PaymentModeController::class, 'edit'])->name('payment_mode.edit');
    Route::post('payment_mode/edit/{id}', [PaymentModeController::class, 'update'])->name('payment_mode.update');
    Route::delete('payment_mode/{id}', [PaymentModeController::class, 'destroy'])->name('payment_mode.delete');

//==========================================================================================================================
//========================== Employee ====================================================================================
//==========================================================================================================================
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('employee/create', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('employee/edit/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');

//==========================================================================================================================
//========================== Patient ====================================================================================
//==========================================================================================================================
    Route::get('patient', [PatientController::class, 'index'])->name('patient.index');
    Route::get('patient/create', [PatientController::class, 'create'])->name('patient.create');
    Route::post('patient/create', [PatientController::class, 'store'])->name('patient.store');
    Route::get('patient/show/{id}', [PatientController::class, 'show'])->name('patient.show');
    Route::get('patient/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit');
    Route::post('patient/edit/{id}', [PatientController::class, 'update'])->name('patient.update');
    Route::delete('patient/{id}', [PatientController::class, 'destroy'])->name('patient.delete');

//==========================================================================================================================
//========================== Doctor ====================================================================================
//==========================================================================================================================
    Route::get('doctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::get('doctor/create', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('doctor/create', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('doctor/show/{id}', [DoctorController::class, 'show'])->name('doctor.show');
    Route::get('doctor/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::post('doctor/edit/{id}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('doctor/{id}', [DoctorController::class, 'destroy'])->name('doctor.delete');

//==========================================================================================================================
//========================== Employee ====================================================================================
//==========================================================================================================================
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('employee/create', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('employee/edit/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');

//==========================================================================================================================
//========================== Associate ====================================================================================
//==========================================================================================================================
    Route::get('associate', [AssociateController::class, 'index'])->name('associate.index');
    Route::get('associate/create', [AssociateController::class, 'create'])->name('associate.create');
    Route::post('associate/create', [AssociateController::class, 'store'])->name('associate.store');
    Route::get('associate/show/{id}', [AssociateController::class, 'show'])->name('associate.show');
    Route::get('associate/edit/{id}', [AssociateController::class, 'edit'])->name('associate.edit');
    Route::post('associate/edit/{id}', [AssociateController::class, 'update'])->name('associate.update');
    Route::delete('associate/{id}', [AssociateController::class, 'destroy'])->name('associate.delete');

//==========================================================================================================================
//========================== LabCentre ====================================================================================
//==========================================================================================================================
    Route::get('lab_centre', [LabCentreController::class, 'index'])->name('lab_centre.index');
    Route::get('lab_centre/create', [LabCentreController::class, 'create'])->name('lab_centre.create');
    Route::post('lab_centre/create', [LabCentreController::class, 'store'])->name('lab_centre.store');
    Route::get('lab_centre/show/{id}', [LabCentreController::class, 'show'])->name('lab_centre.show');
    Route::get('lab_centre/edit/{id}', [LabCentreController::class, 'edit'])->name('lab_centre.edit');
    Route::post('lab_centre/edit/{id}', [LabCentreController::class, 'update'])->name('lab_centre.update');
    Route::delete('lab_centre/{id}', [LabCentreController::class, 'destroy'])->name('lab_centre.delete');

//==========================================================================================================================
//========================== CollectionCentre ====================================================================================
//==========================================================================================================================
    Route::get('collection_centre', [CollectionCentreController::class, 'index'])->name('collection_centre.index');
    Route::get('collection_centre/create', [CollectionCentreController::class, 'create'])->name('collection_centre.create');
    Route::post('collection_centre/create', [CollectionCentreController::class, 'store'])->name('collection_centre.store');
    Route::get('collection_centre/show/{id}', [CollectionCentreController::class, 'show'])->name('collection_centre.show');
    Route::get('collection_centre/edit/{id}', [CollectionCentreController::class, 'edit'])->name('collection_centre.edit');
    Route::post('collection_centre/edit/{id}', [CollectionCentreController::class, 'update'])->name('collection_centre.update');
    Route::delete('collection_centre/{id}', [CollectionCentreController::class, 'destroy'])->name('collection_centre.delete');

//==========================================================================================================================
//========================== Department ====================================================================================
//==========================================================================================================================
    Route::get('department', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('department/create', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('department/show/{id}', [DepartmentController::class, 'show'])->name('department.show');
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('department/edit/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('department/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');

//==========================================================================================================================
//========================== Designation ====================================================================================
//==========================================================================================================================
    Route::get('designation', [DesignationController::class, 'index'])->name('designation.index');
    Route::get('designation/create', [DesignationController::class, 'create'])->name('designation.create');
    Route::post('designation/create', [DesignationController::class, 'store'])->name('designation.store');
    Route::get('designation/show/{id}', [DesignationController::class, 'show'])->name('designation.show');
    Route::get('designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
    Route::post('designation/edit/{id}', [DesignationController::class, 'update'])->name('designation.update');
    Route::get('designation/{id}', [DesignationController::class, 'destroy'])->name('designation.delete');

//==========================================================================================================================
//========================== Report ====================================================================================
//==========================================================================================================================
    Route::get('report', [ReportController::class, 'collection_report'])->name('report.collection');
    Route::get('report/collection/search', [ReportController::class, 'collection_search'])->name('report.collection.search');

});
