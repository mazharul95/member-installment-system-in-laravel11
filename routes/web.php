<?php

use App\Http\Controllers\backend\InstallmentController;
use App\Http\Controllers\backend\MemberController;
use App\Http\Controllers\backend\PenaltyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('members', MemberController::class);
    Route::get('members/{member}/penalty', [PenaltyController::class, 'create'])->name('penalties.create');
    Route::post('members/{member}/penalty', [PenaltyController::class, 'store'])->name('penalties.store');
    Route::post('installments/{installment}/pay', [InstallmentController::class, 'makePayment'])->name('installments.pay');
    Route::get('installments/report', [InstallmentController::class, 'report'])->name('installments.report');
});

require __DIR__.'/auth.php';
