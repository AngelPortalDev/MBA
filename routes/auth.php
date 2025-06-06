<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');
    // Route::post('register', [RegisteredUserController::class, 'store'])->middleware('throttle:5,60');
    Route::post('register', [RegisteredUserController::class, 'store'])->middleware('throttle:30,480');

    Route::post('instituteRegister', [RegisteredUserController::class, 'instituteRegister'])->name('instituteRegister');
    
    Route::post('teacherRegister', [RegisteredUserController::class, 'teacherRegister'])->name('teacherRegister');


    Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')->middleware(ProtectAgainstSpam::class);

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware(ProtectAgainstSpam::class)->middleware('permission.onboarding');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request')->middleware(ProtectAgainstSpam::class)->middleware('throttle:3,60');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email')->middleware(ProtectAgainstSpam::class)->middleware('throttle:3,60');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset')->middleware(ProtectAgainstSpam::class);

    Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store')->middleware(ProtectAgainstSpam::class);
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});