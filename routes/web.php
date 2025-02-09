<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\PlatformAccountController;
use App\Http\Controllers\LiveStreamActivityController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\Datatables\UsersDatatablesController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/datatables', [App\Http\Controllers\Datatables\UsersDatatablesController::class, 'index'])->name('user-datatables');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);


    Route::get('user/select2Streamer', [App\Http\Controllers\Select2\UserSelect2Controller::class, 'selectStreamer']);
    Route::resource('users', UserController::class);

    Route::get('platform/datatables', [App\Http\Controllers\Datatables\PlatformDatatablesController::class, 'index'])->name('platform-datatables');
    Route::get('platform/{id}/plaform-account-datatables', [App\Http\Controllers\Datatables\PlatformAccountDatatablesController::class, 'getByPlatform']);
    Route::resource('platform', PlatformController::class);


    Route::get('platform-account/select2', [App\Http\Controllers\Select2\PlatformAccountSelect2Controller::class, 'index']);
    Route::resource('platform-account', PlatformAccountController::class);


    Route::get('live-stream-activity/datatables', [App\Http\Controllers\Datatables\LiveStreamActivityDatatablesController::class, 'index'])->name('live-stream-activity-datatables');
    Route::resource('live-stream-activity', LiveStreamActivityController::class);

    Route::get('my-profile', [App\Http\Controllers\MyProfileController::class, 'index']);
    Route::post('my-profile/complete-profile', [App\Http\Controllers\MyProfileController::class, 'completeProfile']);
    

});