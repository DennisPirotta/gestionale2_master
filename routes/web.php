<?php

use App\Http\Controllers\AccessKeyController;
use App\Http\Controllers\BugReportController;
use App\Http\Controllers\BusinessHourController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EngagementController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HourController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\TechnicalReportController;
use App\Http\Controllers\TechnicalReportDetailsController;
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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/access-keys', AccessKeyController::class);
    Route::resource('/bugs-report', BugReportController::class);
    Route::resource('/business-hours', BusinessHourController::class);
    Route::resource('/customers', CustomerController::class);
    Route::resource('/engagements', EngagementController::class);
    Route::resource('/expense-reports', ExpenseReportController::class);
    Route::resource('/holidays', HolidayController::class);
    Route::resource('/home', HomeController::class);
    Route::resource('/hours',HourController::class);
    Route::resource('/locations', LocationController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/order-details', OrderDetailsController::class);
    Route::resource('/technical-reports', TechnicalReportController::class);
    Route::resource('/technical-report-details', TechnicalReportDetailsController::class);
    Route::resource('/user', UserController::class);

});
