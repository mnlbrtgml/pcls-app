<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TransactController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Auth/Login');
// });

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/customers', [CustomerController::class, 'Index'])->name('customers.index');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');

Route::get('/transacts', [TransactController::class, 'Index'])->name('transacts.index');
Route::post('/transacts/store', [TransactController::class, 'store'])->name('transacts.store');

Route::get('/schedules', [ScheduleController::class, 'Index'])->name('schedules.index');
Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store');

Route::get('/reports', [ReportController::class, 'Index'])->name('reports.index');