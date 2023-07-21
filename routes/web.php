<?php

use App\Http\Controllers\CreditRegistrationController;
use App\Http\Controllers\CurrentLearningSituationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\SakuraSetController;
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

    Route::group(['prefix' => 'cls'],function() {
        Route::get('/',[CurrentLearningSituationController::class, 'index'])->name('cls');
        Route::get('/getSumCoreByYear/{year}',[CurrentLearningSituationController::class, 'getSumCoreByYear'])->name('getSumCoreByYear');
    });
    Route::group(['prefix' => 'credit-registration'],function() {
        Route::get('/',[CreditRegistrationController::class, 'index'])->name('creditRegistration');
        Route::get('/typeSelected',[CreditRegistrationController::class, 'typeSelected'])->name('typeSelected');
        Route::post('/typeSelected',[CreditRegistrationController::class, 'searchTypeSelected'])->name('searchTypeSelected');
        Route::get('/creditRegistry',[CreditRegistrationController::class, 'creditRegistry'])->name('creditRegistry');
        Route::post('/handleCreditRegistry',[CreditRegistrationController::class, 'handleCreditRegistry'])->name('handleCreditRegistry');
        Route::post('/getBranchQuestion',[CreditRegistrationController::class, 'getBranchQuestion'])->name('getBranchQuestion');
        Route::get('/creditEdit',[CreditRegistrationController::class, 'creditEdit'])->name('creditEdit');
        Route::post('/handleCreditRegistry/{id?}',[CreditRegistrationController::class, 'handleCreditRegistry'])->name('handleCreditRegistry');
    });

    Route::group(['prefix' => 'sakuraSet'],function() {
        Route::get('/',[SakuraSetController::class, 'index'])->name('sakuraSet');
        Route::get('/yourTry',[SakuraSetController::class, 'yourTry'])->name('yourTry');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::any('api/login', [Authenticate::class, 'login'])->name('api_login');
require __DIR__.'/auth.php';

