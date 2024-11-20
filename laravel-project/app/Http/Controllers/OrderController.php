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

    // ¡Cambiar! La llamada a la base de datos debe estar adentro del modelo Order
    public function orders()
    {   
        $orders = Order::select('restaurant', 'table', 'content','status')->get();
        return response()->json($orders);
    }

    // Me copio de locations() :3
    public function ordersFromRestaurant($restaurantId)
    {   
        $orders = Order::where('restaurant', $restaurantId)
               ->select('restaurant', 'table', 'content', 'status', 'id')
               ->get();
        return response()->json($orders);
    }

    public function ordersFromUser($userId)
    {
        $orders = Order::where('user_id', $userId)->get();
        return response()->json($orders);
    }

    public function updateStatus(Request $request, $orderId, $status): RedirectResponse
    {

        $order = Order::findOrFail($orderId);
        $order->status = $status;
        $order->save();

        $restaurantId = $order->restaurant;
        return to_route('restaurantById', ['id' => $restaurantId]); // Se rompe
    }

    public function store(Request $request): RedirectResponse
    {
        $order = Order::create([
            'restaurant' => $request["restaurant"],
            'table'      => $request["table"],
            'content'    => $request["content"],
            'status'     => $request["status"],
            'user_id'    => $request["user_id"],
        ]);

        return Redirect::route('order');
    }

    public function delete(Request $request, $orderId): RedirectResponse
    {
        $order = Order::findOrFail($orderId);
        $restaurantId = $order->restaurant;
        $order->delete();

        return to_route('restaurantById', ['id' => $restaurantId]); // Se rompe
    }
}
