<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Services\OrderItemService;

class OrderItemController extends Controller
{

    public function __construct( 
        private OrderItemService $orderItemService)
    {}

    /* Actualiza el estado de la order item de 'en_preparacion' a 'listo'
    *
    * Delega la lógica de negocio al servicio de order items y retorna la orden item actualizada
    *
    * @param string $order_id, $order_item. 
    */
    public function updateStatus(string $order_id, string $order_item){
        return $this->orderItemService->updateStatus($order_id, $order_item);
    }
}
