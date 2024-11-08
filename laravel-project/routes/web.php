<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::get('/map', function () {
    return Inertia::render('Map');
});

Route::get('/api/restaurants/locations', [RestaurantController::class, 'locations']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/restaurant', function () {
    $user = auth()->user();
    
    $restaurants = $user->restaurants()->get()->toArray();
    $hasRestaurant = $user->restaurants()->exists();
    
    return Inertia::render('Restaurant', [
        'restaurants' => $restaurants,
        'hasRestaurant' => $hasRestaurant,
    ]);
})->middleware(['auth', 'verified'])->name('restaurant');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
