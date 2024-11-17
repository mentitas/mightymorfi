<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// ***mapa***
Route::get('/', function () {
    return Inertia::render('Map');
});

Route::get('/api/restaurants/locations',            [RestaurantController::class,  'locations']);
Route::get('/api/restaurants/{restaurantId}',       [RestaurantController::class,  'getRestaurantInfo']);
Route::get('/api/restaurants/user/{userId}',        [RestaurantController::class,  'restaurantsFromUser']);
Route::get('/api/orders/restaurant/{restaurantId}', [OrderController::class,       'ordersFromRestaurant']);
Route::get('/api/orders/user/{userId}',             [OrderController::class,       'ordersFromUser']);

// ***dashboard***
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ***restaurant***
Route::get('/restaurant', function () {
    return Inertia::render('Restaurant/RestaurantList', []);
})->middleware(['auth', 'verified'])->name('restaurant');


Route::get('/order/{restaurantId}/{table}', function ($restaurantId, $table) {
    return Inertia::render('Order/Order', [
        'canOrder' => true,
        'restaurantId' => $restaurantId,
        'table' => $table,
    ]); 
})->middleware(['auth', 'verified'])->name('order');


Route::get('/order/', function () {
    return Inertia::render('Order/Order', [
        'canOrder' => false
    ]); 
})->middleware(['auth', 'verified'])->name('order');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route::get('/restaurant/', [RestaurantController::class, ''])->name('restaurant.edit');
    Route::get('/restaurant/create', [RestaurantController::class, 'view']);
    Route::patch('/restaurant/{id}',  [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::patch('/order/{id}/{status}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::patch('/order', [OrderController::class, 'store'])->name('order.store');
    Route::patch('/order/{id}', [OrderController::class, 'delete'])->name('order.delete');

});

require __DIR__.'/auth.php';
