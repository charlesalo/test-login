<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grouping routes that require authentication
Route::middleware('auth')->group(function () {
    // Existing Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Product routes using resource controller
    Route::resource('products', ProductController::class);

    // Cart routes
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Admin routes
    Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
        // List users (Admin Dashboard)
        Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
        
        // Edit user information
        Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
        
        // Promote user as admin
        Route::get('/users/{user}/promote', [AdminController::class, 'promote'])->name('admin.users.promote');
        Route::post('/users/{user}/promote', [AdminController::class, 'promoteUser'])->name('admin.users.promoteUser');
    });

    // Admin dashboard route
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

});

require __DIR__.'/auth.php';
