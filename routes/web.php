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

Route::get('/', [ProductController::class, 'home'])->name('home');
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

        Route::get('/', function () {
            return view('admin.index');
        })->name('dashboard');

        Route::get('/products', [ProductController::class, 'adminIndex'])->name('products');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/users', [UserController::class, 'getAll'])->name('users');
        Route::post('/users/save', [UserController::class, 'saveUser'])->name('users.save');
        Route::delete('/users/delete', [UserController::class, 'deleteUser'])->name('users.delete');
    });

});
