<?php
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Employee\ReportController;
use App\Http\Controllers\Employee\AssociateController;
use App\Http\Controllers\Employee\TestQueueController;
use App\Http\Controllers\Employee\SalesOrderController;
use App\Http\Controllers\Employee\SalesInvoiceController;
use App\Http\Controllers\Employee\ReferralDoctorController;
use App\Http\Controllers\Employee\Auth\NewPasswordController;
use App\Http\Controllers\Employee\Auth\VerifyEmailController;
use App\Http\Controllers\Employee\Auth\RegisteredUserController;
use App\Http\Controllers\Employee\Auth\PasswordResetLinkController;
use App\Http\Controllers\Employee\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Employee\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Employee\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Employee\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Employee\PatientController as EmployeePatientController;

Route::group(['middleware' => ['guest:employee'], 'prefix' => 'employee', 'as' => 'employee.'], function () {

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

});
//==========================================================================================================================
//========================== auth:admin ====================================================================================
//==========================================================================================================================
Route::group(['middleware' => ['auth:employee'], 'prefix' => 'employee', 'as' => 'employee.'], function () {
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

    Route::get('reset-password', [NewPasswordController::class, 'create'])->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    Route::post('reset-password', [NewPasswordController::class, 'password_update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    //=================== employee Dashboard ========================
    Route::get( '/dashboard' , function () {
        return view('employee.dashboard');
    })->name('dashboard');
    Route::get('/', function () {
        return view('employee.dashboard');
    })->name('dashboard');

//==========================================================================================================================
//========================== Patient ====================================================================================
//==========================================================================================================================
    Route::get('patient', [EmployeePatientController::class, 'index'])->name('patient.index');
    Route::get('patient/create', [EmployeePatientController::class, 'create'])->name('patient.create');
    Route::post('patient/store', [EmployeePatientController::class, 'store'])->name('patient.store');
    // Route::post('patient/store', function(){
    //     return redirect()->route('employee.patient.index');
    // })->name('patient.store');
    Route::get('patient/select/{id}', [EmployeePatientController::class, 'select'])->name('patient.select');
    Route::get('patient/show/{id}', [EmployeePatientController::class, 'show'])->name('patient.show');
    Route::get('patient/edit/{id}', [EmployeePatientController::class, 'edit'])->name('patient.edit');
    Route::post('patient/update/{id}', [EmployeePatientController::class, 'update'])->name('patient.update');
    Route::delete('patient/{id}', [EmployeePatientController::class, 'destroy'])->name('patient.delete');

//==========================================================================================================================
//========================== Associate ====================================================================================
//==========================================================================================================================
    Route::get('associate', [AssociateController::class, 'index'])->name('associate.index');
    Route::get('associate/create', [AssociateController::class, 'create'])->name('associate.create');
    Route::post('associate/store', [AssociateController::class, 'store'])->name('associate.store');
    Route::get('associate/select/{id}', [AssociateController::class, 'select'])->name('associate.select');
    Route::get('associate/show/{id}', [AssociateController::class, 'show'])->name('associate.show');
    Route::get('associate/edit/{id}', [AssociateController::class, 'edit'])->name('associate.edit');
    Route::post('associate/update/{id}', [AssociateController::class, 'update'])->name('associate.update');
    Route::delete('associate/{id}', [AssociateController::class, 'destroy'])->name('associate.delete');
//==========================================================================================================================
//========================== Doctor ====================================================================================
//==========================================================================================================================
    Route::get('doctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::get('doctor/create', [DoctorController::class, 'create'])->name('doctor.create');
    Route::post('doctor/store', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('doctor/show/{id}', [DoctorController::class, 'show'])->name('doctor.show');
    Route::get('doctor/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::post('doctor/update/{id}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('doctor/{id}', [DoctorController::class, 'destroy'])->name('doctor.delete');

//==========================================================================================================================
//========================== ReferralDoctor ====================================================================================
//==========================================================================================================================
    Route::get('referral_doctor', [ReferralDoctorController::class, 'index'])->name('referral_doctor.index');
    Route::get('referral_doctor/create', [ReferralDoctorController::class, 'create'])->name('referral_doctor.create');
    Route::post('referral_doctor/store', [ReferralDoctorController::class, 'store'])->name('referral_doctor.store');
    Route::get('referral_doctor/show/{id}', [ReferralDoctorController::class, 'show'])->name('referral_doctor.show');
    Route::get('referral_doctor/edit/{id}', [ReferralDoctorController::class, 'edit'])->name('referral_doctor.edit');
    Route::post('referral_doctor/update/{id}', [ReferralDoctorController::class, 'update'])->name('referral_doctor.update');
    Route::delete('referral_doctor/{id}', [ReferralDoctorController::class, 'destroy'])->name('referral_doctor.delete');

    //==========================================================================================================================
//========================== order or booking ====================================================================================
//==========================================================================================================================
    Route::get('so', [SalesOrderController::class, 'index'])->name('sales_order.index');
    Route::get('so/create', [SalesOrderController::class, 'create'])->name('sales_order.create');
    Route::post('so/create', [SalesOrderController::class, 'store'])->name('sales_order.store');
    Route::get('so/show/{id}', [SalesOrderController::class, 'show'])->name('sales_order.show');
    Route::get('so/edit/{id}', [SalesOrderController::class, 'edit'])->name('sales_order.edit');
    Route::post('so/update/{id}', [SalesOrderController::class, 'update'])->name('sales_order.update');
    Route::delete('so/{id}', [SalesOrderController::class, 'destroy'])->name('sales_order.delete');
    Route::get('so/quick_view', [SalesOrderController::class, 'quick_view'])->name('sales_order.quickview');


    //==========================================================================================================================
//========================== invoice or booking ====================================================================================
//==========================================================================================================================
    Route::get('si', [SalesInvoiceController::class, 'index'])->name('sales_invoice.index');
    Route::get('si/invoice/search', [SalesInvoiceController::class, 'sales_invoice_search'])->name('sales.invoice.search');

    Route::get('si/create', [SalesInvoiceController::class, 'create'])->name('sales_invoice.create');
    Route::post('si/create', [SalesInvoiceController::class, 'store'])->name('sales_invoice.store');
    Route::get('si/show/{id}', [SalesInvoiceController::class, 'show'])->name('sales_invoice.show');
    Route::get('si/edit/{id}', [SalesInvoiceController::class, 'edit'])->name('sales_invoice.edit');
    Route::post('si/update/{id}', [SalesInvoiceController::class, 'update'])->name('sales_invoice.update');
    Route::delete('si/{id}', [SalesInvoiceController::class, 'destroy'])->name('sales_invoice.delete');
    Route::get('si/test_delete/{id}', [SalesInvoiceController::class, 'test_delete'])->name('sales_invoice.test_delete');
    Route::get('si/return/{id}', [SalesInvoiceController::class, 'init_sales_return'])->name('sales_invoice.return_initiate');
    Route::post('si/payback/{id}', [SalesInvoiceController::class, 'payback'])->name('sales_invoice.payback');
    Route::get('sales_invoice/pay_now/{id}', [SalesInvoiceController::class, 'pay_now'])->name('sales_invoice.pay_now');
    Route::post('sales_invoice/pay', [SalesInvoiceController::class, 'pay'])->name('sales_invoice.pay');
    Route::get('/booking/money_receipt/{id}', [SalesInvoiceController::class, 'money_receipt'])->name('money_receipt');
//==========================================================================================================================
//========================== Test Search ====================================================================================
//==========================================================================================================================
    Route::get('test_search', [SalesOrderController::class, 'search'])->name('test_search.index');
    Route::post('add_to_order', [SalesOrderController::class, 'add_to_order'])->name('sales_order.add_to_order');
    Route::post('delete_from_order', [SalesOrderController::class, 'delete_from_order'])->name('sales_order.delete_from_order');
    Route::get('sales_order_preview', [SalesOrderController::class, 'sales_order_preview'])->name('sales_order.sales_order_preview');
    Route::get('quick_preview', [SalesOrderController::class, 'quick_preview'])->name('sales_order.quick_preview');

//==========================================================================================================================
//========================== Test Preview ====================================================================================
//==========================================================================================================================
    Route::get('change_test_date', [SalesOrderController::class, 'change_test_date'])->name('sales_order.change_test_date');
    Route::get('delete_from_order_preview/{id}', [SalesOrderController::class, 'delete_from_order_preview'])->name('sales_order.delete_from_order_preview');
    Route::post('sales_order/discount_apply', [SalesOrderController::class, 'discount_apply'])->name('sales_order.discount_apply');

    Route::get('sales_order/generate_invoice', [SalesOrderController::class, 'generate_invoice'])->name('sales_order.generate_invoice');


    //==========================================================================================================================
//========================== Test Queue ====================================================================================
//==========================================================================================================================
    Route::get('test_queue', [TestQueueController::class, 'index'])->name('test_queue.index');
    Route::get('test_queue/fetch', [TestQueueController::class, 'fetch'])->name('test_queue.fetch');
    Route::get('test_queue/search', [TestQueueController::class, 'test_queue_search'])->name('test_queue.search');
    Route::post('test_queue/create', [TestQueueController::class, 'store'])->name('test_queue.store');
    Route::get('test_queue/show/{id}', [TestQueueController::class, 'show'])->name('test_queue.show');
    Route::get('test_queue/edit/{id}', [TestQueueController::class, 'edit'])->name('test_queue.edit');
    Route::post('test_queue/update/{id}', [TestQueueController::class, 'update'])->name('test_queue.update');
    Route::delete('test_queue/{id}', [TestQueueController::class, 'destroy'])->name('test_queue.delete');
    Route::get('resetcode',[TestQueueController::class,'resetcode'])->name('test_queue.resetcode');
    Route::post('savecode',[TestQueueController::class,'savecode'])->name('test_prepare.savecode');
    Route::get('test_queue/pdf/{id}',[TestQueueController::class,'getpdf'])->name('test_queue.getpdf');

//==========================================================================================================================
//========================== Report ====================================================================================
//==========================================================================================================================
    Route::get('report', [ReportController::class, 'collection_report'])->name('report.collection');
    Route::get('report/collection/search', [ReportController::class, 'collection_search'])->name('report.collection.search');

//command route
    Route::get('/optimize_clear', function () {
        // Artisan::call('storage:link');
        // Artisan::call('config:cache');
        // Artisan::call('cache:clear');
        // Artisan::call('view:clear');
        // Artisan::call('route:clear');
        // Artisan::call('config:clear');
        Artisan::call('optimize:clear');
        // Artisan::call('optimize');
        // Artisan::call('config:cache');
        // Artisan::call('view:cache');
        // Artisan::call('route:cache');
        return  Redirect()->back()->with('success', 'Route clear !');
    });
    Route::get('/view_clear', function () {
        Artisan::call('view:clear');
        return  Redirect()->back()->with('success', 'Route clear !');
    });

    Route::get('/route_cache', function () {
          Artisan::call('route:cache');
          return  Redirect()->back()->with('success', 'Route clear !');
    });
    Route::get('/route_clear', function () {
        Artisan::call('route:clear');
      return  Redirect()->back()->with('success', 'Route clear !');
  });

});
