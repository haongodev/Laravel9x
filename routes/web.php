<?php

use App\Http\Controllers\CreditRegistrationController;
use App\Http\Controllers\MyPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'mypage'],function() {
    Route::get('/',[MyPageController::class, 'index'])->name('mypage');

    Route::group(['prefix' => 'credit-registration'],function() {
        Route::get('/',[CreditRegistrationController::class, 'index'])->name('creditRegistration');
        Route::get('/registry',[CreditRegistrationController::class, 'registry'])->name('creditRegistry');
    });
});
