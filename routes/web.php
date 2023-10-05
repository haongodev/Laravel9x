<?php

use App\Http\Controllers\CreditRegistrationController;
use App\Http\Controllers\CurrentLearningSituationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\SakuraSetController;
use App\Http\Controllers\FaceSheetController;
use App\Http\Controllers\ReflectionsheetController;
use App\Http\Controllers\InitiativetableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authenticate;
use App\Events\MessageSent;
use Illuminate\Http\Request;
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


Route::get('/send-email', [SakuraSetController::class, 'testMail']);

Route::group(['prefix' => 'mypage','middleware'=>'auth'],function() {
    Route::post('message', function (Request $request) {
        broadcast(new MessageSent(auth()->user(), $request->input('message')));
        return $request->input('message');
    });

    Route::get('/',[MyPageController::class, 'index'])->name('mypage');

    Route::group(['prefix' => 'cls'],function() {
        Route::get('/',[CurrentLearningSituationController::class, 'index'])->name('cls');
        Route::get('/getSumCoreByYear/{year}',[CurrentLearningSituationController::class, 'getSumCoreByYear'])->name('getSumCoreByYear');
        Route::get('/getStudyScoreBwMonth/{date}',[CurrentLearningSituationController::class, 'getStudyScoreBwMonth'])->name('getStudyScoreBwMonth');

    });
    Route::group(['prefix' => 'credit-registration'],function() {
        Route::get('/',[CreditRegistrationController::class, 'index'])->name('creditRegistration');
        Route::get('/typeSelected',[CreditRegistrationController::class, 'typeSelected'])->name('typeSelected');
        Route::post('/typeSelected',[CreditRegistrationController::class, 'searchTypeSelected'])->name('searchTypeSelected');
        Route::get('/creditRegistry',[CreditRegistrationController::class, 'creditRegistry'])->name('creditRegistry');
        Route::post('/handleCreditRegistry',[CreditRegistrationController::class, 'handleCreditRegistry'])->name('handleCreditRegistry');
        Route::post('/handleCreditUpdate',[CreditRegistrationController::class, 'handleCreditUpdate'])->name('handleCreditUpdate');
        Route::post('/getBranchQuestion',[CreditRegistrationController::class, 'getBranchQuestion'])->name('getBranchQuestion');
        Route::post('/getLinkQuestion',[CreditRegistrationController::class, 'getLinkQuestion'])->name('getLinkQuestion');
        Route::post('/getBranchHisQuestion',[CreditRegistrationController::class, 'getBranchHisQuestion'])->name('getBranchHisQuestion');
        Route::get('/creditEdit',[CreditRegistrationController::class, 'creditEdit'])->name('creditEdit');
        Route::post('/handleCreditRegistry/{id?}',[CreditRegistrationController::class, 'handleCreditRegistry'])->name('handleCreditRegistry');
        Route::post('/popup-registered',[CreditRegistrationController::class, 'popupRegistered'])->name('popupRegistered');
        Route::post('/validateViewVideo',[CreditRegistrationController::class, 'validateViewVideo'])->name('validateViewVideo');
        Route::post('/validateViewVideoEdit',[CreditRegistrationController::class, 'validateViewVideoEdit'])->name('validateViewVideoEdit');
    });

    Route::group(['prefix' => 'sakuraSet'],function() {
        Route::get('/',[SakuraSetController::class, 'index'])->name('sakuraSet');
        Route::get('/yourTry',[SakuraSetController::class, 'yourTry'])->name('yourTry');
        Route::post('/sakuraUpdate',[SakuraSetController::class, 'update'])->name('sakuraUpdate');
        Route::post('/sakuraCheckMark',[SakuraSetController::class, 'checkMark'])->name('sakuraCheckMark');
        Route::post('/sakuraUnCheckMark',[SakuraSetController::class, 'unCheckMark'])->name('sakuraUnCheckMark');
        Route::post('/sakuraDelete',[SakuraSetController::class, 'delete'])->name('sakuraDelete');
        Route::get('/getSheet',[SakuraSetController::class, 'getSheet'])->name('sakuraSheet');
        Route::post('/sakuraBackup',[SakuraSetController::class, 'backup'])->name('sakuraBackup');
        Route::post('/sakuraUpload',[SakuraSetController::class, 'upload'])->name('sakuraUpload');
        Route::post('/updateShareFaceSheet',[SakuraSetController::class, 'updateShareFaceSheet'])->name('sakuraUpdateShareFaceSheet');
        Route::post('/removeShareFaceSheet',[SakuraSetController::class, 'removeShareFaceSheet'])->name('sakuraRemoveShareFaceSheet');
        Route::post('/updateShareReflectionSheet',[SakuraSetController::class, 'updateShareReflectionSheet'])->name('updateShareReflectionSheet');
        Route::post('/sakuraRemoveReflectionSheet',[SakuraSetController::class, 'sakuraRemoveReflectionSheet'])->name('sakuraRemoveReflectionSheet');
        // A015
        Route::post('/updateShareInitiativeTable',[SakuraSetController::class, 'updateShareInitiativeTable'])->name('updateShareInitiativeTable');
        Route::post('/sakuraRemoveInitiativeTable',[SakuraSetController::class, 'sakuraRemoveInitiativeTable'])->name('sakuraRemoveInitiativeTable');
        Route::post('/sakuraUpdateScheduled',[SakuraSetController::class, 'updateScheduled'])->name('sakuraUpdateScheduled');
        // A017
        Route::get('/registerReviewer',[SakuraSetController::class, 'registerReviewer'])->name('registerReviewer');
        Route::post('/searchMemberToReview',[SakuraSetController::class, 'searchMemberToReview'])->name('searchMemberToReview');
        Route::post('/addMemberToReview',[SakuraSetController::class, 'addMemberToReview'])->name('addMemberToReview');

    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::any('api/login', [Authenticate::class, 'login'])->name('api_login');
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

