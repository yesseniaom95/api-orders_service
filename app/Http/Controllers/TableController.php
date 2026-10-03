<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Services\TableService;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class TableController extends Controller
{

    public function __construct(
        private TableService $tableService
    ){}

    public function createTables(TableRequest $request) {

        $tables = $this->tableService->createTable($request->validated());

        return response()->json([
            'message' => 'Mesa creada correctamente.',
            'table'   => $tables
        ], 200);
    }

    public function listTables(Request $request){
        $par_pages = $request->query('par_pages', 15);
        $tables = $this->tableService->listTables($par_pages);
        return response()->json(
            [$tables],200);
    }

    public function updateTable(TableRequest $request, string $id_table){

        $tables = $this->tableService->updateTable(
            $request->validated(),
            $id_table);

        return response()->json(
            [
                'message' => 'Mesa actualizada correctamente',
                'table'   => $tables
            ], 200);
    }

    public function tableDetails(string $id_table){
        $table = $this->tableService->listDetails($id_table);

        return response()->json([
            'table' => $table
        ], 200);
    }
}
