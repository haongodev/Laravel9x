<?php

use App\Http\Controllers\CreditRegistrationController;
use App\Http\Controllers\MyPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authenticate;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'mypage','middleware'=>'auth'],function() {
    Route::get('/',[MyPageController::class, 'index'])->name('mypage');

    Route::group(['prefix' => 'credit-registration'],function() {
        Route::get('/',[CreditRegistrationController::class, 'index'])->name('creditRegistration');
        Route::get('/typeSelected',[CreditRegistrationController::class, 'typeSelected'])->name('typeSelected');
        Route::post('/typeSelected',[CreditRegistrationController::class, 'searchTypeSelected'])->name('searchTypeSelected');
        Route::get('/creditRegistry',[CreditRegistrationController::class, 'creditRegistry'])->name('creditRegistry');
        Route::post('/handleCreditRegistry',[CreditRegistrationController::class, 'handleCreditRegistry'])->name('handleCreditRegistry');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::any('api/login', [Authenticate::class, 'login']);
require __DIR__.'/auth.php';

