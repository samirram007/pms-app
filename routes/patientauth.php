<?php
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Patient\SalesOrderController;
use App\Http\Controllers\Patient\TestReportController;
use App\Http\Controllers\Patient\SalesInvoiceController;
use App\Http\Controllers\Patient\Auth\AuthenticatedSessionController;
Route::group(['middleware' => ['guest:patient'], 'prefix' => 'patient', 'as' => 'patient.'], function () {

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

Route::group(['middleware' => ['auth:patient'], 'prefix' => 'patient', 'as' => 'patient.'], function () {
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
        // return view('patient.dashboard');
        return redirect()->route('patient.sales_invoice.index');
        // return view('patient.sales_invoice.index');
    })->name('dashboard');
    Route::get('/', function () {
        // return view('patient.dashboard');
        return redirect()->route('patient.sales_invoice.index');
        // return view('patient.sales_invoice.index');
    })->name('dashboard');


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
Route::get('/test_report', [TestReportController::class, 'test_report'])->name('test_report');

});
