<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\DTOs\OrderData;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request, OrderService $service)
    {
        $data = OrderData::fromArray($request->validated());

        $order = $service->create($data);

        return response()->json([
            'data' => [
                'id' => $order->id,
                'status' => $order->status,
                'total_amount' => $order->total_amount,
                'created_at' => $order->created_at,
            ]
        ], 201);
    }
}