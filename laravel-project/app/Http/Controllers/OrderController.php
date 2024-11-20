<?php

namespace App\Http\Controllers;
use App\Models\{Order, Restaurant}; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{

    public function orders()
    {   
        $orders = Order::getAll();
        return response()->json($orders);
    }

    public function ordersFromRestaurant($restaurantId)
    {   
        $orders = Order::getBy('restaurant', $restaurantId);
        return response()->json($orders);
    }

    public function ordersFromUser($userId)
    {
        $orders = Order::getBy('user_id', $userId);
        return response()->json($orders);
    }

    public function updateStatus(Request $request, $orderId, $status): RedirectResponse
    {
        $restaurantId = Order::franchise($orderId);
        Order::updateOrder($orderId, $status);        
        return to_route('restaurantById', ['id' => $restaurantId]);
    }

    public function store(Request $request): RedirectResponse
    {
        $atributtes = [
            'restaurant' => $request["restaurant"],
            'table'      => $request["table"],
            'content'    => $request["content"],
            'status'     => $request["status"],
            'user_id'    => $request["user_id"],
        ];

        $orderId = Order::newOrder($atributtes);
        return Redirect::route('order');
    }

    public function delete(Request $request, $orderId): RedirectResponse
    {
        $order = Order::findOrder($orderId);
        $restaurantId = $order->restaurant;
        
        Order::rejectOrder($orderId);
        return to_route('restaurantById', ['id' => $restaurantId]);
    }
}
