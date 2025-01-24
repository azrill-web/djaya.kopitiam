<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ImageController;



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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/dashboard/menus', [MenuController::class, 'index'])->name('dashboard.menus.index');
Route::get('/dashboard/menus/create', [MenuController::class, 'create'])->name('dashboard.menus.create');
Route::post('/dashboard/menus', [MenuController::class, 'store'])->name('dashboard.menus.store');

Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders.index');
Route::post('/dashboard/orders', [OrderController::class, 'store'])->name('dashboard.orders.store');

Route::get('/dashboard/checkout/{menu}', [OrderController::class, 'checkout'])->name('dashboard.checkout');
Route::post('/dashboard/checkout', [OrderController::class, 'processCheckout'])->name('dashboard.checkout.process');

Route::post('/dashboard/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('dashboard.admin.orders.updateStatus');

Route::delete('dashboard./admin/orders/{order}', [OrderController::class, 'destroy'])->name('dashboard.admin.orders.destroy');

Route::get('/dashboard/admin/orders', [OrderController::class, 'adminIndex'])->name('dashboard.admin.orders.index');

Route::get('/dashboard/orders/search', [OrderController::class, 'search'])->name('dashboard.orders.search');

// Rute untuk menampilkan formulir edit
Route::get('/dashboard/menus/{menu}/edit', [MenuController::class, 'edit'])->name('dashboard.menus.edit');

// Rute untuk memperbarui menu
Route::put('/dashboard/menus/{menu}', [MenuController::class, 'update'])->name('dashboard.menus.update');

// Rute untuk menghapus menu
Route::delete('/dashboard/menus/{menu}', [MenuController::class, 'destroy'])->name('dashboard.menus.destroy');

Route::get('/dashboard/images', [ImageController::class, 'index'])->name('dashboard.images.index');
Route::get('/dashboard/images/create', [ImageController::class, 'create'])->name('dashboard.images.create');
Route::post('/dashboard/images', [ImageController::class, 'store'])->name('dashboard.images.store');
Route::get('/dashboard/images/{image}/edit', [ImageController::class, 'edit'])->name('dashboard.images.edit');
Route::put('/dashboard/images/{image}', [ImageController::class, 'update'])->name('dashboard.images.update');
Route::delete('/dashboard/images/{image}', [ImageController::class, 'destroy'])->name('dashboard.images.destroy');

Route::get('/dashboard/admin/orders/{order}/nota', [OrderController::class, 'generateNota'])->name('dashboard.admin.orders.nota');

Route::get('/dashboard/orders/filter', [OrderController::class, 'filterByCategory'])->name('dashboard.orders.filter');