<?php

use App\Http\Controllers\UserAuthController\RegisterController as UserRegisterController;
use App\Http\Controllers\UserAuthController\LoginController as UserLoginController;
use App\Http\Controllers\AdminAuthController\LoginController as AdminLoginController;
use App\Http\Controllers\AdminAuthController\RegisterController as AdminRegisterController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\UserController\DashboardController as UserDashboardController;
use App\Http\Controllers\AdminController\DashboardController as AdminDashboardController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('users/login', [UserLoginController::class,'loginShow'])->name('users.loginShow');
// Route::get('user/login', [UserLoginController::class,'loginShow'])->name('loginShow');
Route::post('user/login', [UserLoginController::class,'login'])->name('user.login');

Route::middleware(['auth'])->group(function () {

    Route::get('users/dashboard',[UserDashboardController::class,'dashboard'])->name('users.dashboardShow');
    Route::resource('users', UserRegisterController::class);

});

Route::get('admin/login', [AdminLoginController::class,'loginShow'])->name('admins.loginShow');
Route::post('admin/login', [AdminLoginController::class,'login'])->name('admin.login');
Route::get('admin/logout', [AdminLoginController::class, 'logout'])->name('admins.logout');




Route::middleware(['admin'])->group(function () {

    Route::get('admin/dashboard',[AdminDashboardController::class,'dashboard'])->name('admin.dashboard');
    Route::get('admins/profile',[ProfileController::class,'profileShow'])->name('admin.profileShow');
    Route::get('admins/setting',[ProfileController::class,'updatePasswordShow'])->name('admin.updatePasswordShow');
    Route::put('admins/password/{id}',[ProfileController::class,'updatePassword'])->name('admin.updatePassword');
    Route::put('admins/{id}',[ProfileController::class,'updateProfile'])->name('admin.updateProfile');

    Route::put('product/{id}',[ProductController::class,'statusUpdate']);
    Route::resource('products',ProductController::class);


    Route::put('category/{id}',[CategoryController::class,'statusUpdate']);
    Route::resource('categories',CategoryController::class);


});
Route::resource('admin',AdminRegisterController::class);



