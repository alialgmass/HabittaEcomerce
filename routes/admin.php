<?php

use App\Http\Controllers\admin\AdminPanelController;
use App\Http\Controllers\admin\categories\CategoryController;
use App\Http\Controllers\admin\ContactMessagesController;
use App\Http\Controllers\admin\country\CountriesController;
use App\Http\Controllers\admin\offers\OfferController;
use App\Http\Controllers\admin\orders\OrdersController;
use App\Http\Controllers\admin\products\CouponsController;
use App\Http\Controllers\admin\products\ProductsController;
use App\Http\Controllers\admin\review\ReviewController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [AdminPanelController::class, 'index'])->name('admin.index');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('/read-all-notifications', [AdminPanelController::class, 'readAllNotifications'])->name('admin.notifications.readAll');
    Route::get('/notification/{id}/details', [AdminPanelController::class, 'notificationDetails'])->name('admin.notification.details');

    Route::get('/my-profile', [AdminPanelController::class, 'edit'])->name('myProfile.edit');
    Route::post('/my-profile', [AdminPanelController::class, 'update'])->name('myProfile.update');
    Route::get('/my-password', [AdminPanelController::class, 'EditPassword'])->name('myPassword.edit');
    Route::post('/my-password', [AdminPanelController::class, 'UpdatePassword'])->name('myPassword.update');
    Route::get('/notifications-settings', [AdminPanelController::class, 'EditNotificationsSettings'])->name('admin.notificationsSettings');
    Route::post('/notifications-settings', [AdminPanelController::class, 'UpdateNotificationsSettings'])->name('admin.notificationsSettings.update');

    Route::group(['prefix' => 'contact-messages'], function () {
        Route::get('/', [ContactMessagesController::class, 'index'])->name('admin.contactmessages');
        Route::get('/{id}/details', [ContactMessagesController::class, 'details'])->name('admin.contactmessages.details');
        Route::get('/{id}/delete', [ContactMessagesController::class, 'delete'])->name('admin.contactmessages.delete');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/', [SettingsController::class, 'update'])->name('settings.update');
        Route::get('/{key}/deletePhoto', [SettingsController::class, 'deleteSettingPhoto'])->name('settings.deletePhoto');
    });

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductsController::class);
    Route::get('products/{key}/Images', [ProductsController::class, 'Images'])->name('products.Images');

    Route::resource('categories', CategoryController::class);
    Route::resource('countries', CountriesController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('reviews', ReviewController::class);

    Route::resource('coupons', CouponsController::class);
    Route::resource('orders', OrdersController::class);

});
