<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::with('product')->get();

        return response()->json([
            'data' => $orders->map(function (Order $order) {
                return [
                    'order_id' => $order->id,
                    'product_name' => $order->product->product_name,
                    'price' => $order->price,
                ];
            }),
            'total' => $orders->sum('price'),
        ]);
    }
}