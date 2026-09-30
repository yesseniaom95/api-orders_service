<?php

namespace App\Services;

use App\Events\OrderCreatedEvent;
use App\Models\Additions;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Procesa la creación de una orden, calcula los subtotales y ocupa la mesa.
     *
     * @param array $data
     * @param int|null $userId
     * @return Order
     */
    public function createOrder(array $data, ?int $userId = null): Order
    {
        $order =  DB::transaction(function () use ($data, $userId) {
            
            // 1. Crear la orden principal
            $order = Order::create([
                'table_id'     => $data['table_id'],
                'user_id'      => $userId ?? $data['user_id'] ?? null,
                'origin'       => $data['origin'] ?? 'caja_pc',
                'status'       => 'abierto',
                'total_amount' => 0,
            ]);

            $calculatedTotal = 0;

            // 2. Procesar ítems solicitados
            foreach ($data['items'] as $itemData) {
                
                $product = Product::findOrFail($itemData['product_id']);
                $itemSubtotal = $product->price * $itemData['quantity'];

                $orderItem = $order->items()->create([
                    'product_id'    => $product->id,
                    'quantity'      => $itemData['quantity'],
                    'unit_price'    => $product->price,
                    'kitchen_notes' => $itemData['kitchen_notes'] ?? null,
                    'status'        => 'pendiente',
                ]);

                // 3. Procesar adiciones por ítem
                if (!empty($itemData['additions'])) {
                    foreach ($itemData['additions'] as $additionData) {
                        $addition = Additions::where('id', $additionData['id'])
                            ->where('product_id', $product->id)
                            ->firstOrFail();
                        
                        $orderItem->itemAdditions()->create([
                            'addition_id'      => $addition->id,
                            'additional_price' => $addition->additional_price,
                        ]);

                        $itemSubtotal += ($addition->additional_price * $itemData['quantity']);
                    }
                }

                $calculatedTotal += $itemSubtotal;
            }

            // 4. Actualizar total acumulado
            $order->update(['total_amount' => $calculatedTotal]);

            // 5. Ocupar la mesa
            Table::where('id', $data['table_id'])->update(['status' => 'ocupada']);

            return $order;
        });

        event(new OrderCreatedEvent($order));

        return $order;
    }

    public function listOrders(int $perPage = 15)
    {
        return Order::whereDate('ordered_at', Carbon::today())
        ->orderBy('ordered_at', 'asc')
        ->paginate($perPage);
    }
}