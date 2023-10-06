<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('admin.login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('admin.login');

Route::any('/logout', [AuthenticatedSessionController::class, 'logout'])
    ->name('admin.logout');

Route::group(['middleware'=>'auth:admin'],function() {
    Route::get('/',[IndexController::class, 'index'])->name('admin.index');
});
