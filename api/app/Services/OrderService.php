<?php
namespace App\Services;

use App\Models\Order;
use App\DTOs\OrderData;
use App\Jobs\ProcessOrderJob;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function create(OrderData $data): Order
    {
        Log::info('Creating order', [
            'user_id' => $data->user_id,
            'total_amount' => $data->total_amount,
        ]);

        $order = Order::create([
            'user_id' => $data->user_id,
            'total_amount' => $data->total_amount,
            'status' => 'pending'
        ]);

        ProcessOrderJob::dispatch($order);

        Log::info('Order created and dispatched to queue', [
            'order_id' => $order->id
        ]);

        return $order;
    }
}