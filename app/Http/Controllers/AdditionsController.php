<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdditionsRequest;
use App\Services\AdditionsService;
use Illuminate\Http\Request;

class AdditionsController extends Controller
{
    public function __construct(
        private AdditionsService $additionsService)
    {
        
    }
    public function createAdditions(AdditionsRequest $request)
    {
        $addition = $this->additionsService->createAdditions($request->validated());

        return response()->json(
            [
                'message' => 'Producto creado correctamente',
                'addition' => $addition
            ], 200);
    }

    public function updateAdditions()
    {
        
    }
}
