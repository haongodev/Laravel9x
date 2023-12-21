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
    Route::get('/member/manage',[MemberController::class, 'userManage'])->name('admin.member.user.manage');
    Route::get('/member/manage/detail/{user_id}',[MemberController::class, 'userDetail'])->name('admin.member.user.detail');
    // edit
    Route::get('/member/manage/edit/{user_id}',[MemberController::class, 'userEdit'])->name('admin.member.user.edit');
    Route::post('/member/manage/confirm/{user_id?}',[MemberController::class, 'userEditConfirm'])->name('admin.member.user.confirm');
    Route::post('/member/manage/edit/{user_id?}',[MemberController::class, 'userUpdate'])->name('admin.member.user.update');
    Route::post('/member/manage/delete}',[MemberController::class, 'userDelete'])->name('admin.member.user.delete');
    // create
    Route::get('/member/manage/create',[MemberController::class, 'userCreate'])->name('admin.member.user.create');
    Route::post('/member/manage/confirm_store',[MemberController::class, 'userStoreConfirm'])->name('admin.member.user.confirm_store');
    Route::post('/member/manage/store',[MemberController::class, 'userStore'])->name('admin.member.user.store');
});
