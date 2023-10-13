<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\MemberController;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('admin.login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('admin.login');

Route::any('/logout', [AuthenticatedSessionController::class, 'logout'])
    ->name('admin.logout');

Route::group(['middleware'=>'auth:admin'],function() {
    Route::get('/',[IndexController::class, 'index'])->name('admin.index');
    Route::post('/',[IndexController::class, 'changePassWord'])->name('admin.change.password');
    Route::get('/member/detail/{login_id}',[MemberController::class, 'detail'])->name('admin.member.detail');
    Route::get('/member/list_file/{login_id}',[MemberController::class, 'listFile'])->name('admin.member.list_file');
});
