<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
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

    Route::get('/projects', function () {
        return view('projects.project-list');
    })->name('project');

    Route::controller(RoleController::class)->group(function(){
        Route::get('/roles','index')->name('role');
        Route::get('/role-create','create')->name('role.create');
        Route::post('/role-store','store')->name('role.store');
        Route::get('/role-edit/{id}','edit')->name('role.edit');
        Route::post('role-update/{id}','update')->name('role.update');
    });
});
