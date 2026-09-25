<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct(
            private CategoryService $categoryService
    ) {}

    public function createCategory(CategoryRequest $request){

        $category = $this->categoryService->createCategory($request->validated());

        return response()->json([
            'message' => 'Categoria creada correctamente',
            'category'  => $category
        ], 200);
    }

    public function listCategory(Request $request){

        $per_page = $request->query('per_page', 15);

        $category = $this->categoryService->listCategory();

        return response()->json([
            'category' => $category
        ], 200);
    }

    public function categoryDetails(string $id_category){

        $category  = $this->categoryService->categoryDetails($id_category);

        return response()->json([
            'category' => $category
        ],200);
    }

    public function updateCategory(CategoryRequest $request, string $id_category){

        $category = $this->categoryService->updateCategory(
            $request->validated(),
            $id_category);

        return response()->json([
            'message'  => 'Categoria actualizado correctamente',
            'category' => $category
        ],200);

    }

}
