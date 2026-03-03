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

        // Listado principal de admin
        Route::get('/products', [ProductController::class, 'adminIndex'])->name('products');

        // Ruta para mostrar el formulario de creación (LA QUE TE FALTABA)
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

        // Ruta para procesar el guardado
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

        // Ruta para mostrar el formulario de edición
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

        // Ruta para procesar la actualización
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

        // Ruta para eliminar
        Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

});
