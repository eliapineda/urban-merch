<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Cualquiera puede verlas)
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren Login - Middleware 'auth')
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // --- DASHBOARD (Default de Jetstream) ---
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- CARRITO ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::post('/cart/delete', [CartController::class, 'deleteProduct'])->name('cart.delete');

    // --- RESEÑAS (Públicas pero requieren estar logueado para crear) ---
    Route::post('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

    /*
    |----------------------------------------------------------------------
    | Rutas de Administración (Solo para Rol 'admin')
    |----------------------------------------------------------------------
    */
    // Nota: Puedes crear un middleware 'role:admin' más adelante para mayor seguridad.
    Route::prefix('admin')->name('admin.')->group(function () {

        // Gestión de Productos
        Route::get('/products', [ProductController::class, 'adminIndex'])->name('products');
        Route::post('/products/save', [ProductController::class, 'save'])->name('products.save');
        Route::post('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');

        // Gestión de Usuarios
        Route::get('/users', [UserController::class, 'getAll'])->name('users');
        Route::post('/users/save', [UserController::class, 'saveUser'])->name('users.save');
        Route::post('/users/delete', [UserController::class, 'deleteUser'])->name('users.delete');

        // Gestión de Reseñas
        Route::get('/reviews', [ReviewController::class, 'getAll'])->name('reviews');
        Route::post('/reviews/delete', [ReviewController::class, 'deleteReview'])->name('reviews.delete');
    });

});
