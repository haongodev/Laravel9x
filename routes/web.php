<?php

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

Route::get('/mypage',[MyPageController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::any('api/login', [Authenticate::class, 'login']);
require __DIR__.'/auth.php';

