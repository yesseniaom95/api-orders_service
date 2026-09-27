<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersRequest;
use App\Models\Additions;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder(OrdersRequest $request)
    {
        // Pasa los datos validados del request al servicio
        $order = $this->orderService->createOrder(
            $request->all(),
            auth()->id()
        );

        return response()->json([
            'message'      => 'Orden creada con éxito',
            'order_id'     => $order->id,
            'total_amount' => $order->total_amount
        ], 201);
    }
}