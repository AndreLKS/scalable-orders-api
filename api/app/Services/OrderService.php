<?php
namespace App\Services;

use App\Models\Order;
use App\DTOs\OrderData;
use App\Jobs\ProcessOrderJob;
use Illuminate\Support\Facades\Log;

class OrderService
{

    //backoff and tries to handle job retries in case of failure
    public $tries = 3;
    public $backoff = 10; //wait 10 seconds before retrying the job
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