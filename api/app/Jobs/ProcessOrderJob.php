<?php
namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessOrderJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order) {}

    public function handle(): void
    {
        Log::info('Processing order', [
            'order_id' => $this->order->id
        ]);

        $this->order->update([
            'status' => 'completed'
        ]);

        Log::info('Order completed', [
            'order_id' => $this->order->id
        ]);
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('Order processing failed', [
            'order_id' => $this->order->id,
            'error' => $exception->getMessage()
        ]);
        $this->order->update([
            'status' => 'failed'
        ]);
    }
}