<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComboOptionsRequest;
use App\Services\ComboService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ComboOptionsController extends Controller
{
    public function __construct(private ComboService $comboService )
    {}
    public function createCombo(ComboOptionsRequest $request)
    {
        $combo = $this->comboService->createCombo($request->validated());

        return response()->json([$combo], 200);
    }

    public function updateCombo(ComboOptionsRequest $request, string $combo_id)
    {
        $combo = $this->comboService->updateCombo(
            $request->validated(),
            $combo_id
        );

        return response()->json(
            [
                'message' => 'Combo actualizado correctamente.',
                'combo'   => $combo
            ],200);
    }

    public function listCombo()
    {
        $combo = $this->comboService->listCombos();

        return response()->json([
            $combo
        ],200);
    }
}
