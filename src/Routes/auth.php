<?php

use Daugt\Controllers\Auth\LoginController;
use Daugt\Controllers\Auth\OTPController;
use Illuminate\Support\Facades\Route;
use Daugt\Controllers\Auth\AuthenticatedSessionController;
use Daugt\Controllers\Auth\ConfirmablePasswordController;
use Daugt\Controllers\Auth\EmailVerificationNotificationController;
use Daugt\Controllers\Auth\EmailVerificationPromptController;
use Daugt\Controllers\Auth\NewPasswordController;
use Daugt\Controllers\Auth\PasswordResetLinkController;
use Daugt\Controllers\Auth\RegisteredUserController;
use Daugt\Controllers\Auth\VerifyEmailController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::group(['middleware' => ['web', ProtectAgainstSpam::class]], function () {


    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');

    Route::get('/login', function () {
        return view('daugt::auth.login');
    })->name('login');

    Route::post('/login', LoginController::class)
        ->middleware('guest');

    Route::get('/login/otp', [OTPController::class, 'view'])->name('login.otp')
        ->middleware('guest');

    Route::post('/login/otp', [OTPController::class, 'check'])->name('login.otp.verify')
        ->middleware('guest');

    Route::get('/login/otp/link', [OTPController::class, 'checkLink'])->name('login.otp.verify.link')
        ->middleware('guest', config('daugt.multitenancy') ? 'signed:relative' : 'signed');

    Route::get('/login/password', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('login.password');

    Route::post('/login/password', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->middleware(config('daugt.multitenancy') ? 'auth:tenant' : 'auth')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware([config('daugt.multitenancy') ? 'auth:tenant' : 'auth', config('daugt.multitenancy') ? 'signed:relative' : 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware([config('daugt.multitenancy') ? 'auth:tenant' : 'auth', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware(config('daugt.multitenancy') ? 'auth:tenant' : 'auth')
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware(config('daugt.multitenancy') ? 'auth:tenant' : 'auth');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware(config('daugt.multitenancy') ? 'auth:tenant' : 'auth')
        ->name('logout');
});
