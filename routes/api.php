<?php

use App\Http\Controllers\AdditionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComboOptionsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Models\OrderItem;
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
    Route::middleware('role:admin|mesero|cajero|cocinero')->group(function () {
        
        // Productos (Lectura)
        
        Route::get('/products/{id}', [ProductController::class, 'productDetails']);

        // Categorías (Lectura)
        Route::get('/categories', [CategoryController::class, 'listCategory']);
        Route::get('/categories/{id}', [CategoryController::class, 'categoryDetails']);

        // Mesas (Lectura)
        Route::get('/tables', [TableController::class, 'listTables']);
        Route::get('/tables/{id}', [TableController::class, 'tableDetails']);

        //Crear orden
        Route::post('/orders', [OrderController::class, 'createOrder']);

        //listar las ordenes para el rol de cocina.
        Route::get('/orders-list', [OrderController::class, 'listOrders']);

        //Actualiza el estado desde el rol de cocina. Id es el identificador de la orden.
        Route::put('/update-order/{id}', [OrderController::class, 'inPreparation']);

        //Actualiza el estado de la order-item.
        Route::put('/update-order-item/{id}/{id_item}', [OrderItemController::class, 'updateStatus']);
    });


    // Permisos exclusivos de Administración
    Route::middleware('role:admin')->group(function () {

        // Productos (Escritura / Eliminación)
        Route::post('/products', [ProductController::class, 'createProduct']);
        Route::put('/products/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);

        //Lista todos los productos del rol administrador.
        Route::get('/products', [ProductController::class, 'listProducts']);

        // Categorías (Escritura)
        Route::post('/categories', [CategoryController::class, 'createCategory']);
        Route::put('/categories/{id}', [CategoryController::class, 'updateCategory']);

        // Mesas (Escritura)
        Route::post('/tables', [TableController::class, 'createTables']);
        Route::put('/tables/{id}', [TableController::class, 'updateTable']);

        //Adiciones
        Route::post('/additions', [AdditionController::class, 'createAdditions']);
        Route::put('/update-addition/{id}', [AdditionController::class, 'updateAddition']);

        //Combo
        Route::post('/combo-options', [ComboOptionsController::class, 'createCombo']);
        Route::put('/combo-options/{id}', [ComboOptionsController::class, 'updateCombo']);
        Route::get('/combo-options', [ComboOptionsController::class, 'listCombo']);
    
        //User
        Route::get('/user-list', [UserController::class, 'listUser']);
        Route::post('/register-user', [UserController::class, 'registerUser']);
    
    });

});