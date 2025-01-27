<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
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

// ------------------------------login--------------------------
Route::controller(AuthController::class)->group(function () {
    Route::get('', 'index')->name('login'); // Explicitly define the /login route
    Route::post('/login-authenticate', 'authenticate')->name('login.authenticate');
    Route::get('/password-request', 'passwordRequest')->name('password.request');
    Route::get('/logout', 'logout')->name('logout');
});



Route::middleware(['web', 'auth'])->group(function () {



    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('role');
        Route::get('/role-create', 'create')->name('role.create');
        Route::post('/role-store', 'store')->name('role.store');
        Route::get('/role-edit/{id}', 'edit')->name('role.edit');
        Route::post('role-update/{id}', 'update')->name('role.update');
    });

    Route::controller(ShiftController::class)->group(function () {
        Route::get('/shifts', 'index')->name('shift');
        Route::get('/shift-create', 'create')->name('shift.create');
        Route::post('/shift-store', 'store')->name('shift.store');
        Route::get('/shift-edit/{id}', 'edit')->name('shift.edit');
        Route::post('shift-update/{id}', 'update')->name('shift.update');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user');
        Route::get('/user-create', 'create')->name('user.create');
        Route::post('/user-store', 'store')->name('user.store');
        Route::get('/user-edit/{id}', 'edit')->name('user.edit');
        Route::post('user-update/{id}', 'update')->name('user.update');
        Route::get('/user-view/{id}', 'view')->name('user.view');
    });

    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects', 'index')->name('project');
        Route::get('/project-create', 'create')->name('project.create');
        Route::post('/project-store', 'store')->name('project.store');
        Route::get('/project-edit/{id}', 'edit')->name('project.edit');
        Route::post('project-update/{id}', 'update')->name('project.update');
        Route::get('/project-view/{id}', 'view')->name('project.view');
    });
});
