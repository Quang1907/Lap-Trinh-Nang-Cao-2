<?php

namespace  App\Http\Controllers;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Login\FacebookController;
use App\Http\Controllers\Api\Login\GoogleController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('', 'index')->name('home');
    Route::get('shop/{slug?}', 'shop')->name('shop');
    Route::get('search', 'search')->name('search');
    Route::get('shop-detail/{slug?}', 'shopDetail')->name('shop-detail');
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'handleGoogleRedirect')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::controller(FacebookController::class)->group(function () {
    Route::get('auth/facebook', 'handleFacebookRedirect')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

Route::group(['prefix' => 'admin', 'middleware' => 'AdminRight'], function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dasboard');
        Route::get('file', 'filemanager')->name('admin.file');
    });

    Route::resource('products', ProductController::class);

    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'index')->name('categories.index');
        Route::post('categories', 'store');
        Route::delete('categories/{id}', 'destroy');
        Route::get('categories/{id}', 'edit');
        Route::put('categories/{id}', 'update');
        Route::get('allCategory', 'allCategory');
        Route::get('categories/search/{key}', 'search');
    });

    Route::controller(AccountController::class)->group(function () {
        Route::delete('account/{id}', 'destroy')->name('account.destroy');
        Route::delete('account/{id}/clear', 'clear')->name('account.clear');
        Route::put('account/{id}', 'restore')->name('account.restore');
        Route::get('account/recycle.html', 'recycle')->name('account.recycle');
        Route::get('account/index.html', 'index')->name('account.index');
    });
});
