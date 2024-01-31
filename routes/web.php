<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\BraintreeController;

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

Route::get('/dropin', [BraintreeController::class, 'showDropInForm'])->name('dropin');
Route::post('/process-payment', [BraintreeController::class, 'processPayment'])->name('process-payment');
Route::get('/payment-success', [BraintreeController::class, 'showSuccess'])->name('payment-success');
Route::get('/payment-error', [BraintreeController::class, 'showError'])->name('payment-error');


Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [ApartmentController::class, 'index'])->name('home');
        Route::resource('apartments', ApartmentController::class);
        Route::resource('messages', MessageController::class);
        Route::resource('sponsors', PaymentController::class);
    });

require __DIR__ . '/auth.php';
