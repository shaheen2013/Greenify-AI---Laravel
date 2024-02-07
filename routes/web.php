<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Backend\UserPermissionController;
use App\Http\Controllers\SettingsController;

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


Route::prefix('backend')->group(function () {
    Route::middleware(['backend_guest'])->group(function () {
        Route::get('/', [LoginController::class, "login"])->name('backend.login');
        Route::get('/login', [LoginController::class, "login"])->name('backend.login');
        Route::post('/post_login', [LoginController::class, "postLogin"])->name('backend.post_login');
    });


    Route::group(['middleware' => ['backend_auth']], function () {
        Route::post('/logout', [LoginController::class, "postLogout"])->name('backend.postLogout');
        Route::get('/dashboard', function () {
            return view('backend.dashboard');
        })->name('backend.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('roles', UserRoleController::class);
        Route::resource('permissions', UserPermissionController::class);

        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update/{id}/{type}', 'update')->name('update');
        });
    });
});
