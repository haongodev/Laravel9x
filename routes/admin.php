<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::any('admin/login', [LoginController::class, 'login'])
    ->name('admin.login');


Route::any('admin/logout', [LoginController::class, 'logout'])
    ->name('admin.logout');

Route::group(['prefix' => 'admin','middleware'=>'auth:admin'],function() {
    Route::get('/',[IndexController::class, 'index'])->name('admin.index');
});
