<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CodeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('savecode',[CodeController::class,'savecode'])->name('savecode');

Route::get('loadcode',[CodeController::class,'loadcode'])->name('loadcode');
require __DIR__.'/auth.php';


// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth:admin'])->name('admin.dashboard');
Route::group(['middleware' => 'prevent-back-history'],function(){
    require __DIR__.'/adminauth.php';
    require __DIR__.'/employeeauth.php';
    require __DIR__.'/patientauth.php';

});



