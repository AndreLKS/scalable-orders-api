<?php
namespace App\Services;

use App\Models\Order;
use App\DTOs\OrderData;
use App\Jobs\ProcessOrderJob;

class OrderService
{
    public function create(OrderData $data): Order
    {
        $order = Order::create([
            'user_id' => $data->user_id,
            'total_amount' => $data->total_amount,
            'status' => 'pending'
        ]);

        ProcessOrderJob::dispatch($order);

        return $order;
    }
}