<?php

use App\Http\Livewire\Admin\AdminHome;
use App\Http\Livewire\Admin\Categories;
use App\Http\Livewire\Admin\FAQS;
use App\Http\Livewire\Admin\ListUsers;
use App\Http\Livewire\Admin\Notice;
use App\Http\Livewire\Admin\ProductsLogs;
use App\Http\Livewire\Admin\Products\ProductsIndex;
use App\Http\Livewire\Admin\Quotes;
use App\Http\Livewire\Admin\Slides;
use App\Http\Livewire\Admin\Statuses;
use App\Http\Livewire\Admin\SuggestionBoxs;
use App\Http\Livewire\Admin\UpcomingEvent;
use App\Http\Livewire\Admin\ViewReports;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Site\LearnMore;
use App\Http\Livewire\Site\Home;
use App\Http\Livewire\System\Permissions;
use App\Http\Livewire\System\Roles;
use App\Http\Livewire\ZescoHome;
use App\Http\Livewire\ZescoSystems;
use Illuminate\Support\Facades\Route;


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
Route::get('/home',Home::class)->name('ezesco-home');
Route::get('/home/contact/us',\App\Http\Livewire\Site\ContactUs::class)->name('ezesco-home.contact.us');
Route::get('/home/how/to',\App\Http\Livewire\Site\HowTo::class)->name('ezesco-home.how.to');
Route::get('/home/learn/more/{product_id}',\App\Http\Livewire\Site\LearnMore::class)->name('ezesco-home.learn.more');
Route::post('/save-suggestion', [\App\Http\Controllers\SystemSuggestionController::class, 'insert'])->name('ezesco-home.suggestion.save');

// Route::get('/',ZescoHome::class)->name('zesco-home');
// Route::get('/zesco/how-to',ZescoSystems::class)->name('ezesco-systems');
// Route::get('/how-to/learn-more/{product_id}',LearnMore::class)->name('learn-more');
Route::get('/login',Login::Class)->name('login');
Route::get('/register',Register::Class)->name('register');
Route::get('/forgotpassword',ForgotPassword::Class)->name('forgot-password');
Route::get('/reset-password/{token}',ResetPassword::Class)->name('password.reset');

// Route::livewire('/forgot-password', 'forgot-password')->layout('layouts.app')->name('password.forgot');
// Route::livewire('/reset-password/{token}', 'reset-password')->layout('layouts.app')->name('password.reset');

// Route::get('/roles', 'PermissionController@Permission');



Route::middleware(['auth'])->group(function () {
    // Authenticated routes here
    Route::get('/admin-menu',AdminHome::class)->name('admin-menu');
    Route::get('/products/manage',ProductsIndex::class)->name('products.manage');
    Route::get('/products/logs',ProductsLogs::class)->name('products.logs');
    Route::get('/users/manage',ListUsers::class)->name('users.manage');
    Route::get('/categories/manage',Categories::Class)->name('categories.manage');
    Route::get('/permissions/manage',Permissions::Class)->name('permissions.manage');
    Route::get('/roles/manage',Roles::Class)->name('roles.manage');
    Route::get('/status/manage',Statuses::Class)->name('status.manage');
    Route::get('/contact-group/manage',\App\Http\Livewire\Admin\ContactGroupIndex::Class)->name('contact.group.manage');
    Route::get('/reports/manage',ViewReports::Class)->name('reports.manage');
    Route::get('/notices/manage', Notice::class)->name('notices.manage');
    Route::get('/events/manage', UpcomingEvent::class)->name('events.manage');
    Route::get('/faqs/manage', FAQS::class)->name('faqs.manage');
    Route::get('/slides/manage', Slides::class)->name('slides.manage');
    Route::get('/quotes/manage', Quotes::class)->name('quotes.manage');
    Route::get('/suggestions/manage', SuggestionBoxs::class)->name('suggestions.manage');
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
