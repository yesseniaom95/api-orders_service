<?php

use App\Http\Controllers\AdditionsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ComboOptionsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TablesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS (Protegidas con Rate Limiter contra fuerza bruta) ---
Route::middleware('throttle:login')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


// --- RUTAS PROTEGIDAS (Requieren Token Sanctum válido) ---
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Permisos para personal operativo: Admin, Mesero y Cajero
    Route::middleware('role:admin|mesero|cajero')->group(function () {
        
        // Productos (Lectura)
        Route::get('/products', [ProductsController::class, 'listProducts']);
        Route::get('/products/{id}', [ProductsController::class, 'productDetails']);

        // Categorías (Lectura)
        Route::get('/categories', [CategoriesController::class, 'listCategory']);
        Route::get('/categories/{id}', [CategoriesController::class, 'categoryDetails']);

        // Mesas (Lectura)
        Route::get('/tables', [TablesController::class, 'listTables']);
        Route::get('/tables/{id}', [TablesController::class, 'tableDetails']);
    });

    // Permisos exclusivos de Administración
    Route::middleware('role:admin')->group(function () {

        // Productos (Escritura / Eliminación)
        Route::post('/products', [ProductsController::class, 'createProduct']);
        Route::put('/products/{id}', [ProductsController::class, 'updateProduct']);
        Route::delete('/products/{id}', [ProductsController::class, 'deleteProduct']);

        // Categorías (Escritura)
        Route::post('/categories', [CategoriesController::class, 'createCategory']);
        Route::put('/categories/{id}', [CategoriesController::class, 'updateCategory']);

        // Mesas (Escritura)
        Route::post('/tables', [TablesController::class, 'createTables']);
        Route::put('/tables/{id}', [TablesController::class, 'updateTable']);
        Route::post('/orders', [OrdersController::class, 'createOrder']);

        //Adiciones
        Route::post('/additions', [AdditionsController::class, 'createAdditions']);

        //Combo
        Route::post('/combo-options', [ComboOptionsController::class, 'createCombo']);
        Route::put('/combo-options/{id}', [ComboOptionsController::class, 'updateCombo']);
        Route::get('/combo-options', [ComboOptionsController::class, 'listCombo']);//PENDIENTE DE VALIDAR
    });

});