<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')->prefix('admin')->group(function(){
    Route::get('/register/user', [App\Http\Controllers\Backend\Auth\RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

    Route::post('/register/user', [App\Http\Controllers\Backend\Auth\RegisteredUserController::class, 'store'])
                ->middleware('guest');

    Route::get('/login', [App\Http\Controllers\Backend\Auth\AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

    Route::post('/login', [App\Http\Controllers\Backend\Auth\AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

    Route::get('/forgot-password', [App\Http\Controllers\Backend\Auth\PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

    Route::post('/forgot-password', [App\Http\Controllers\Backend\Auth\PasswordResetLinkController::class, 'store'])
                    ->middleware('guest')
                    ->name('password.email');

    Route::get('/reset-password/{token}', [App\Http\Controllers\Backend\Auth\NewPasswordController::class, 'create'])
                    ->middleware('guest')
                    ->name('password.reset');

    Route::post('/reset-password', [App\Http\Controllers\Backend\Auth\NewPasswordController::class, 'store'])
                    ->middleware('guest')
                    ->name('password.update');

    Route::post('/logout', [App\Http\Controllers\Backend\Auth\AuthenticatedSessionController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('logout');
});

/**
 * for frontend route
 *
 */


Route::get('/register', [App\Http\Controllers\Frontend\Auth\RegisteredUserController::class, 'create'])
->middleware('guest')
->name('register');

Route::post('/register', [App\Http\Controllers\Frontend\Auth\RegisteredUserController::class, 'store'])
->middleware('guest');

Route::get('/login', [App\Http\Controllers\Frontend\Auth\AuthenticatedSessionController::class, 'create'])
->middleware('guest')
->name('login');

Route::post('/login', [App\Http\Controllers\Frontend\Auth\AuthenticatedSessionController::class, 'store'])

->middleware('guest');
Route::get('/forgot-password', [App\Http\Controllers\Frontend\Auth\PasswordResetLinkController::class, 'create'])
->middleware('guest')
->name('password.request');

Route::post('/forgot-password', [App\Http\Controllers\Frontend\Auth\PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [App\Http\Controllers\Frontend\Auth\NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [App\Http\Controllers\Frontend\Auth\NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', [App\Http\Controllers\Frontend\Auth\EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

Route::post('/verify-email', [App\Http\Controllers\Frontend\Auth\EmailVerificationPromptController::class, 'Resend'])
    ->middleware('auth')
    ->name('verification.resend');

Route::get('/verify-email/{id}/{hash}', [App\Http\Controllers\Frontend\Auth\VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [App\Http\Controllers\Frontend\Auth\EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
Route::get('/confirm-password', [App\Http\Controllers\Frontend\Auth\ConfirmablePasswordController::class, 'show'])
->middleware('auth')
->name('password.confirm');

Route::post('/confirm-password', [App\Http\Controllers\Frontend\Auth\ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

Route::post('/logout', [App\Http\Controllers\Frontend\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
