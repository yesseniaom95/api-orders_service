<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdditionsRequest;
use App\Services\AdditionService;
use Illuminate\Http\Request;

class AdditionController extends Controller
{
    public function __construct(
        private AdditionService $additionsService)
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

    public function updateAddition(AdditionsRequest $request, string $addition_id)
    {
        $addition = $this->additionsService->updateAddition(
            $request->validated(),
            $addition_id
        );

        return response()->json(
            [
                'message' => 'Adición actualizado correctamente',
                'addition' => $addition
            ], 200);

    }
}
