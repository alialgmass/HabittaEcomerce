<?php

use App\Http\Controllers\api\users\UserAddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\products\ProductController;
use App\Http\Controllers\api\products\WishlistController;
use App\Http\Controllers\api\orders\OrderController;



Route::group(['prefix' => 'users'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('checkOtp', [AuthController::class, 'checkOtp']);
    Route::post('resendOtp', [AuthController::class, 'resendOtp']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('checkPhone', [AuthController::class, 'checkPhone']);
    Route::post('resetPassword', [AuthController::class, 'resetPassword']);
    Route::get('countriesPicker', [AuthController::class, 'countriesPicker']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
Route::group(['middleware' => ['api']], function () {
        Route::resource('home', HomeController::class);
        Route::resource('product', ProductController::class);
        Route::group(['prefix' => 'users','middleware' => ['auth:sanctum']], function () {
                Route::resource('addresses', UserAddressController::class)->except(['update']);
                Route::post('addresses/{address}', [UserAddressController::class, 'update']);
                Route::post('changeDefaultAddress/{address}', [UserAddressController::class, 'changeDefaultAddress']);
            });
        Route::group([ 'middleware' => ['auth:sanctum']], function () {
                Route::resource('wishlists', WishlistController::class);
                Route::resource('orders', OrderController::class);
            });


    }
);
