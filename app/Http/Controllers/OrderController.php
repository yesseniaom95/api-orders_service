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

class OrderController extends Controller
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

    public function listOrders(){

        $order = $this->orderService->listOrders();

        return response()->json(
            [
                $order
            ], 200);
    }

    /**
     * Cambia el estado de una orden a "en preparación".
     *
     * Delega la lógica de negocio al servicio de órdenes y retorna la orden actualizada.
     *
     * @param string $order_id Identificador único de la orden.
     */
    public function inPreparation(string $order_id)
    {
        $order = $this->orderService->inPreparation($order_id);

        return $order;
    }
}