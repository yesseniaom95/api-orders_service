<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role: [admin, mesero]')->group(function () {
        Route::get('/products', [ProductsController::class, 'listProducts']);
        Route::get('/product/{id}', [ProductsController::class, 'productDetails']);
        
        //CATEGORIAS
        Route::get('/category', [CategoriesController::class, 'listCategory']);
        Route::get('/category/{id}', [CategoriesController::class, 'categoryDetails']);
    });

    Route::middleware('role:admin')->group(function(){

    //PRODUCTOS
    
    //PDTA: Falta funcionalidad para cargar varias categorias a la vez.
        Route::post('/products', [ProductsController::class, 'createProduct']);
        Route::put('/products/{id}', [ProductsController::class, 'updateProduct']);
        Route::delete('/product/{id}', [ProductsController::class, 'deleteProduct']);

    //CATEGORIAS

    //PDTA: Falta funcionalidad para cargar varias categorias a la vez.
        Route::post('/category', [CategoriesController::class, 'createCategory']); 
        Route::put('/category/{id}', [CategoriesController::class, 'updateCategory']);
        
    });

});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);