<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function listProducts()
    {
        $products = $this->productService->listProducts();

        return response()->json([
            'products' => $products
        ]);
    }

    public function createProduct(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());

        return response()->json([
            'message' => 'Producto creado correctamente',
            'product' => $product], 200);
    }

    public function productDetails(string $product_id){
        $product = $this->productService->productDetails($product_id);

        return response()->json([
            'producto' => $product
        ]);
    }

    public function updateProduct( ProductRequest $request, string $product_id)
    {
        $product = $this->productService->updateProduct(
            $request->validated(),
            $product_id);

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'producto' => $product
        ],200);
    }

    public function deleteProduct(string $product_id){
        $product = $this->productService->deleteProduct($product_id);

        return response()->json([
            'product' => $product
        ]);
    }
}
