<?php

use App\Http\Controllers\Admin\ActionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SocieteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::group([
    'prefix' => 'Employee',
    'middleware' => ['auth', 'role:Employee']
], function() {
    Route::resource('compte', HomeController::class);
});


Route::group([
    'prefix' => 'Administrateur',
    'middleware' => ['auth', 'role:Administrateur']
], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('admins', AdminController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('societes', SocieteController::class);
    Route::resource('invitations', InvitationController::class);
    Route::resource('actions', ActionController::class);
});
