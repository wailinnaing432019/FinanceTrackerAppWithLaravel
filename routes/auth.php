<?php

use App\Exports\ExportExcel;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AccountDetailController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;


// GoogleLoginController redirect and callback urls
Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
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




    Route::prefix('/')->group(function () {
    Route::get('income',function(){
        return view('container.income_expense');
    });

Route::prefix('/')->middleware('verified')->group(function () {
Route::get('viewPf',function(){
    return view('container.change_password');
})->name('pf.edit');
    Route::controller(AccountController::class)->group( function()
    {
        Route::get('account','index')->name('account');
        Route::post('account','store')->name('account');
        Route::get('account/{id}','show')->name('account_detail');
        Route::post('account/{id}','update')->name('account_detail');
        Route::get('account/destory/{id}','destroy')->name('account_delete');
    });

    Route::controller(AccountDetailController::class)->group(function(){
        Route::get('transaction/account/{id}','show')->name('transaction_account');
        Route::post('transaction/account/{id}','store')->name('transaction_account');

        Route::get('transaction/account/{account_id}/balance/{id}','balanceView')->name('balance');
        Route::post('transaction/account/{account_id}/balance/{id}','balanceUpdate')->name('balance');

        Route::get('transaction/account/{id}/excel','downloadExcel')->name('downloadExcel');
        Route::get('transaction/account/{id}/pdf','downloadPdf')->name('downloadPdf');
        Route::get('transaction/account/excel/download','downloadAllExcel')->name('downloadAllExcel');
        Route::get('transaction/account/pdf/download','downloadAllPdf')->name('downloadAllPdf');

        Route::get('transactions','allView')->name('transactions');

        Route::post('transactions/search','filterBalance')->name('filterBalance');
    });

    Route::controller(TransactionController::class)->group(function(){
        Route::get('transfer','index')->name('transfer');
        Route::post('transfer','store')->name('transfer');
    });

    Route::controller(SummaryController::class)->group(function(){
       Route::get('summary','index')->name('summary');
    });

    Route::controller(SearchController::class)->group(function(){
        Route::post('transaction/account/balance/search','searchBalance')->name('searchBalance');

    });

    Route::get('/download',function(){
        return  (new ExportExcel)->download('active.pdf',Excel::DOMPDF);
    });
    Route::get('profile/view',function(){
        return view('container.profile');
    });
});
});



});