<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    Route::resource('users', UserController::class);
    Route::get('my-profile', [App\Http\Controllers\MyProfileController::class, 'index']);
    Route::post('my-profile/complete-profile', [App\Http\Controllers\MyProfileController::class, 'completeProfile']);
    

});