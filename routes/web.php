<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UmrahBatchController;
use App\Http\Controllers\UmrahManifestController;
use App\Http\Controllers\SavingTransactionController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\Datatables\UsersDatatablesController;
use App\Http\Controllers\Datatables\UmrahBatchDatatablesController;
use App\Http\Controllers\Datatables\SavingTransactionDatatablesController;
use App\Http\Controllers\Datatables\UmrahManifestDatatablesController;
use App\Http\Controllers\Select2\BankAccountSelect2Controller;
use App\Http\Controllers\Select2\UserSelect2Controller;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/datatables', [App\Http\Controllers\Datatables\UsersDatatablesController::class, 'index'])->name('user-datatables');

Route::get('/umrah-batch/datatables', [App\Http\Controllers\Datatables\UmrahBatchDatatablesController::class, 'index'])->name('umrah-batch-datatables');
Route::get('/saving-transaction/datatables', [App\Http\Controllers\Datatables\SavingTransactionDatatablesController::class, 'index'])->name('saving-transaction-datatables');

Route::get('/umrah-manifest/datatables', [App\Http\Controllers\Datatables\UmrahManifestDatatablesController::class, 'index'])->name('umrah-manifest-datatables');

//Select2 Groups
Route::get('bank-account/select2', [App\Http\Controllers\Select2\BankAccountSelect2Controller::class, 'index']);
Route::get('user/selectFormUmrahManifest', [App\Http\Controllers\Select2\UserSelect2Controller::class, 'selectUserForUmrahManifest']);

Route::get('my-profile', [App\Http\Controllers\MyProfileController::class, 'index']);
Route::post('my-profile/complete-profile', [App\Http\Controllers\MyProfileController::class, 'completeProfile']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('umrah-batch', UmrahBatchController::class);
    Route::resource('saving-transaction', SavingTransactionController::class);
    Route::resource('umrah-manifest', UmrahManifestController::class);

});