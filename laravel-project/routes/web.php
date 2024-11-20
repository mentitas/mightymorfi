<?php

use App\Http\Controllers\{RestaurantController, OrderController, ProfileController, MapController, QrCodeController};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// ***mapa y rutas sin autenticar***
// Pagina inicial: muestra el mapa
Route::get('/', [MapController::class, 'view']);

// ***Rutas para obtener recursos de la base de datos**/
// Dado un restaurant id, devuelve la info del restaurant
Route::get('/api/restaurants/{restaurantId}',       [RestaurantController::class,  'getRestaurantInfo']);
// Dado un restaurant id, devuelve las comandas del restaurant.
Route::get('/api/orders/restaurant/{restaurantId}', [OrderController::class,       'ordersFromRestaurant']);
// Dado un user id, devuelve los pedidos del usuarix.
Route::get('/api/orders/user/{userId}',             [OrderController::class,       'ordersFromUser']);

// Devuelve un QR que contiene content.
Route::get('/qr/{content}', [QrCodeController::class, 'generate']);

// ***restaurant***

// Ruta de un QR. Página que muestra los pedidos activos del usuarix
// Y ADEMÁS te deja hacer un pedido en el restaurant y table indicado.
Route::get('/order/{restaurantId}/{table}', function ($restaurantId, $table) {
    return Inertia::render('Order/Order', [
        'canOrder' => true,
        'restaurantId' => $restaurantId,
        'table' => $table,
    ]); 
})->middleware(['auth', 'verified'])->name('order');

// Página que muestra los pedidos activos del usuarix.
Route::get('/order/', function () {
    return Inertia::render('Order/Order', [
        'canOrder' => false,
    ]); 
})->middleware(['auth', 'verified'])->name('order');

// GRUPO DE RUTAS AUTENTICADAS. SON LAS QUE USARIAN LOS DUEÑOS DEL LOCAL
Route::middleware('auth')->group(function () {
    //Rutas para ver el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    //Rutas para ver los restaurantes
    Route::get('/restaurant',           [RestaurantController::class, 'viewList'])->name('restaurant');
    Route::post('/restaurant',          [RestaurantController::class, 'createRestaurant']);
    Route::get('/restaurant/create',    [RestaurantController::class, 'viewCreateForm']);
    Route::get('/restaurant/{id}',      [RestaurantController::class, 'viewOrders'])->name('restaurantById');
    Route::get('/restaurant/edit/{id}', [RestaurantController::class, 'editRestaurant'])->name('restaurantById');
    Route::patch('/restaurant/{id}',    [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::get('/restaurant/qr/{id}',   [QrCodeController::class,     'generate']);


    //Rutas para ver los pedidos
    Route::patch('/order/{id}/{status}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::patch('/order', [OrderController::class, 'store'])->name('order.store');
    Route::delete('/order/{id}', [OrderController::class, 'delete'])->name('order.delete');

});

require __DIR__.'/auth.php';
