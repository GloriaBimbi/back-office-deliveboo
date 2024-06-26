<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Guest\DashboardController as GuestDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
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

// # Rotte pubbliche
Route::get('/', [GuestDashboardController::class, 'index'])
  ->name('home');

// # Rotte protette
Route::middleware('auth')
  ->prefix('/admin')
  ->name('admin.')
  ->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
      ->name('dashboard');

    Route::patch('dishes/{dish}/update-visible', [DishController::class, 'updateVisible'])->name('dishes.update-visible');
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('dishes', DishController::class);
    Route::get('orders',[ OrderController::class,'index'])->name('orders.index');;
  });

require __DIR__ . '/auth.php';
