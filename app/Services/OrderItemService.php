<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemService{

    /* Actualiza el estado del orderItem de 'en_preparacion' a 'listo'.
    *
    * @param string $order_id, $order_item
    * @return $order 
    */
    public function updateStatus(string $order_id, string $order_item){

        //Valida que la orden exista
        $order = Order::findOrFail($order_id);

        // Verifica que la orden esté en estado 'en_preparacion'; si no lo está, responde con HTTP 422 (Unprocessable Entity).       
        if($order->status !== 'en_preparacion'){
            return response()->json([
                'message' => 'No se puede actualizar el ítem porque la orden aún no está en preparación.'
            ], 422);
        }

        $order = OrderItem::where('id', $order_item)
        ->where('order_id', $order_id)
        ->firstOrFail(); // Si la orden no está en_preparacion o no existe, lanza 404

        // 2. Actualizamos el ítem
        $order->update([
            'status' => 'listo'
        ]);

        return response()->json(
            [
                $order
            ],200);
    }
}