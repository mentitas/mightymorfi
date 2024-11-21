<?php

use App\Http\Controllers\{RestaurantController, OrderController, ProfileController, MapController, QrCodeController};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// ***mapa y rutas sin autenticar***
// Pagina inicial: muestra el mapa
Route::get('/', [MapController::class, 'view'])->name('map');

// Devuelve un QR que contiene content.
Route::get('/qr/{content}', [QrCodeController::class, 'generate']);

// ***restaurant***

// GRUPO DE RUTAS AUTENTICADAS. SON LAS QUE USARIAN LOS DUEÑOS DEL LOCAL
Route::middleware('auth')->group(function () {
    //Rutas para ver el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    //Rutas para ver los restaurantes
    Route::get('/restaurant',           [RestaurantController::class, 'viewList'])->name('restaurant');
    Route::post('/restaurant',          [RestaurantController::class, 'createRestaurant']);
    Route::delete('/restaurant/{id}',   [RestaurantController::class, 'delete'])->name('restaurant.delete');
    Route::get('/restaurant/create',    [RestaurantController::class, 'viewCreateForm']);
    Route::get('/restaurant/{id}',      [RestaurantController::class, 'viewOrders'])->name('restaurantById');
    Route::get('/restaurant/edit/{id}', [RestaurantController::class, 'editRestaurant'])->name('restaurantById');
    Route::patch('/restaurant/{id}',    [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::get('/restaurant/qr/{id}',   [QrCodeController::class,     'generateAllQRs']);

    //Rutas para ver los pedidos
    Route::get('/order',                        [OrderController::class, 'viewOrdersFromUser'])->name('order');
    Route::get('/order/{restaurantId}/{table}', [OrderController::class, 'viewOrdersFromUserAtRestaurant'])->name('orderAtRestaurant');
    Route::patch('/order/{id}/{status}',        [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::patch('/order',                      [OrderController::class, 'store'])->name('order.store');
    Route::delete('/order/{id}',                [OrderController::class, 'delete'])->name('order.delete');

});

require __DIR__.'/auth.php';
