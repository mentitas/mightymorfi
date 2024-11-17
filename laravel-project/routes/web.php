<?php

use App\Http\Controllers\{RestaurantController, OrderController, ProfileController, MapController};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// ***mapa y rutas sin autenticar***
Route::get('/', [MapController::class, 'view']);

// Estas rutas hay que eliminarlas y pasar los datos por medio de Inertia usando props
Route::get('/api/restaurants/{restaurantId}',       [RestaurantController::class,  'getRestaurantInfo']);
Route::get('/api/restaurants/user/{userId}',        [RestaurantController::class,  'restaurantsFromUser']);
Route::get('/api/orders/restaurant/{restaurantId}', [OrderController::class,       'ordersFromRestaurant']);
Route::get('/api/orders/user/{userId}',             [OrderController::class,       'ordersFromUser']);

// ***restaurant***
// Estas rutas hay que ver en que se usan ????
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

//Esto seria para ver los pedidos desde la vista Restaurant o desde la vista Cliente?
Route::get('/order/', function () {
    return Inertia::render('Order/Order', [
        'canOrder' => false
    ]); 
})->middleware(['auth', 'verified'])->name('order');

// GRUPO DE RUTAS AUTENTICADAS. SON LAS QUE USARIAN LOS DUENIOS DEL LOCAL
Route::middleware('auth')->group(function () {
    //Rutas para ver el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rutas para ver los restaurantes
    //Route::get('/restaurant/', [RestaurantController::class, ''])->name('restaurant.edit');
    Route::get('/restaurant/create', [RestaurantController::class, 'view']);
    Route::patch('/restaurant/{id}',  [RestaurantController::class, 'update'])->name('restaurant.update');

    //Rutas para ver los pedidos
    Route::patch('/order/{id}/{status}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::patch('/order', [OrderController::class, 'store'])->name('order.store');
    Route::patch('/order/{id}', [OrderController::class, 'delete'])->name('order.delete');

});

require __DIR__.'/auth.php';
