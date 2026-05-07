<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');

// customer
Route::post('/livechat/register', [LiveChatController::class, 'register'])
    ->name('livechat.register');
Route::get('/queue/{id}', [LiveChatController::class, 'queue'])
    ->name('queue.room');
Route::get('/chat-session/{id}/status', [LiveChatController::class, 'status'])
    ->name('chat.status');
Route::get('reload-captcha',[RegisterController::class,'reloadCaptcha'])->name('reloadCaptcha');

// service desk
Route::group(['middleware' => 'guest'], function () {
    // login
    Route::get('home',[HomeController::class,'index'])->name('login');
    Route::post('login/authenticate',[LoginController::class,'authenticate'])->name('login.authenticate');
   
});

// logout
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

});