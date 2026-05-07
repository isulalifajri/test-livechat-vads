<?php

use App\Http\Controllers\ChatAgentController;
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

// customer chat
Route::get('reload-captcha',[RegisterController::class,'reloadCaptcha'])->name('reloadCaptcha');
Route::post('/livechat/register', [LiveChatController::class, 'register'])
    ->name('livechat.register');
Route::get('/queue/{id}', [LiveChatController::class, 'queue'])
    ->name('queue.room');
Route::get('/chat-session/{id}/status', [LiveChatController::class, 'status'])
    ->name('chat.status');
    // customer realtime messages
Route::get('/livechat/{id}/messages', [LiveChatController::class, 'messages'])
    ->name('livechat.messages');
    // customer send message
Route::post('/livechat/{id}/send', [LiveChatController::class, 'send'])
    ->name('livechat.send');

// service desk
Route::group(['middleware' => 'guest'], function () {
    // login
    Route::get('home',[HomeController::class,'index'])->name('login');
    Route::post('login/authenticate',[LoginController::class,'authenticate'])->name('login.authenticate');
   
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::prefix('chat/livechat')->group(function () {


        // reload list realtime
        Route::get('/reload/list', [ChatAgentController::class, 'reloadList'])
            ->name('chat.livechat.reload');

        // list livechat
        Route::get('/',[ChatAgentController::class, 'index'])
            ->name('chat.livechat');

        // detail chat
        Route::get('/{id}', [ChatAgentController::class, 'show'])
            ->name('chat.livechat.show');

        // realtime messages
        Route::get('/{id}/messages', [ChatAgentController::class, 'messages'])
            ->name('chat.livechat.messages');

        // send message
        Route::post('/{id}/send',[ChatAgentController::class, 'send'])
            ->name('chat.livechat.send');

        // check status + idle
        Route::get('/{id}/status',[ChatAgentController::class, 'status'])
            ->name('chat.livechat.status');

    });

    // logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');


});