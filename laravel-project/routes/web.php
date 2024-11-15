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

Route::get('/api/restaurants/locations',   [RestaurantController::class,  'locations']);
Route::get('/api/restaurants/{userId}',    [RestaurantController::class,  'restaurantsFromUser']);
Route::get('/api/orders/{restaurantId}',   [OrderController::class,       'ordersFromRestaurant']);
// Route::get('/api/orders/',                  [OrderController::class,      'orders']);

// ***dashboard***
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ***restaurant***
Route::get('/restaurant', function () {
    return Inertia::render('Restaurant/RestaurantList', []);
})->middleware(['auth', 'verified'])->name('restaurant');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route::get('/restaurant/', [RestaurantController::class, ''])->name('restaurant.edit');
    Route::get('/restaurant/create', [RestaurantController::class, 'view']);
    Route::patch('/restaurant/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');
});

require __DIR__.'/auth.php';
