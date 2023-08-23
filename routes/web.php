<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromoterAuthController;
use App\Http\Controllers\PromoterController;
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
    Route::get('/events', 'index')->name('event.list');
});

Route::controller(EventController::class)->group(function () {
    Route::get('', 'index')->name('event.list');
    Route::get('/events', 'index')->name('event.list');
    Route::get('/events/{slug}', 'show')->name('event.detail');


});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerAction')->name('register.action');

    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginAction')->name('login.action');

    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback')->name('auth.google.callback');
});

Route::controller(FacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback')->name('auth.facebook.callback');
});

Route::prefix('promoters')->controller(PromoterAuthController::class)->group(function () {
    Route::get('/register', 'register')->name('promoter.register');
    Route::post('/register', 'registerAction')->name('promoter.register.action');

});


Route::controller(OrderController::class)->group(function () {
    Route::get('/events/{slug}/orders/{package_id}', 'chart')->name('order.chart');
    Route::post('/events/{slug}/orders/{package_id}', 'chartAction')->name('order.chart.action');

    Route::get('/users/orders', 'index')->name('order.list');
    Route::get('/users/orders/{encoded_invoice}', 'show')->name('order.detail');
});


Route::prefix('promoters')->controller(PromoterController::class)->group(function () {
    Route::get('/events', 'event')->name('promoter.event.list');
    Route::get('/events/create', 'createEvent')->name('promoter.event.create');
    Route::post('/events/create', 'createEventAction')->name('promoter.event.create.action');
    Route::get('/events/{encoded_id}', 'showEvent')->name('promoter.event.detail');
    Route::put('/events/{encoded_id}', 'updateEventAction')->name('promoter.event.update.action');

    Route::get('/balances', 'balance')->name('promoter.balance');
    Route::get('/balances/withdraw', 'withdraw')->name('promoter.balance.withdraw');
    Route::post('/balances/withdraw', 'withdrawAction')->name('promoter.balance.withdraw.action');
});
