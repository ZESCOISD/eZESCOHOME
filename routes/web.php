<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
use App\Http\Livewire\Home;
use App\Http\Livewire\ZescoSystems;
use App\Http\Livewire\Login;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\Admin\AdminHome;
use App\Http\Livewire\Admin\ListProducts;
use App\Http\Livewire\Admin\ListUsers;
// use App\Http\Livewire\Register;
use App\Http\Livewire\Admin\ListCategories;
use App\Http\Livewire\Admin\Permissions;
use App\Http\Livewire\Admin\Roles;
use App\Http\Livewire\Admin\ListProductStatus;
use App\Http\Livewire\Admin\ViewReports;
use App\Http\Livewire\Admin\Utilities;
// use App\Http\Controllers\PermissionController;


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


// new routes
Route::get('/',Home::class)->name('ezesco-home');
Route::get('/zesco/how-to',ZescoSystems::class)->name('ezesco-systems');
Route::get('/login',Login::Class)->name('login');
Route::get('/forgotpassword',ForgotPassword::Class)->name('forgot-password');
Route::get('/reset-password/{token}',ResetPassword::Class)->name('password.reset');

// Route::livewire('/forgot-password', 'forgot-password')->layout('layouts.app')->name('password.forgot');
// Route::livewire('/reset-password/{token}', 'reset-password')->layout('layouts.app')->name('password.reset');

// Route::get('/roles', 'PermissionController@Permission');



Route::middleware(['auth'])->group(function () {
    // Authenticated routes here
    Route::get('/admin-menu',AdminHome::class)->name('admin-menu');
    Route::get('/products/manage',ListProducts::class)->name('products.manage');
    Route::get('/users/manage',ListUsers::class)->name('users.manage');
    Route::get('/categories/manage',ListCategories::Class)->name('categories.manage');
    Route::get('/permissions/manage',Permissions::Class)->name('permissions.manage');
    Route::get('/roles/manage',Roles::Class)->name('roles.manage');
    Route::get('/status/manage',ListProductStatus::Class)->name('status.manage');
    Route::get('/reports/manage',ViewReports::Class)->name('reports.manage');
    Route::get('/utilities/manage', Utilities::class)->name('utilities.manage');
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
