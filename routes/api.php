<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeActivityController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\WorkScheduleController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    Route::resource('employee', EmployeeController::class)->except([
        'create', 'edit'
    ]);
    
    Route::get('employee-activity/calendar', [EmployeeActivityController::class, 'calendar']);
    Route::resource('employee-activity', EmployeeActivityController::class)->except([
        'create', 'show', 'edit', 'update', 'destroy'
    ]);

    Route::resource('presence', PresenceController::class);

    Route::get('salary', [SalaryController::class, 'index'])->name('salary.index');
    Route::get('salary/export', [SalaryController::class, 'export'])->name('salary.export');

    Route::resource('work-schedule', WorkScheduleController::class)->except([
        'create', 'edit'
    ]);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    
    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
