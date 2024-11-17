<?php

namespace App\Http\Controllers;
use App\Models\Restaurant; 
use App\Models\Order; 
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

        return Redirect::route('restaurant');
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
        $order->delete();
        
        return Redirect::route('restaurant');
    }
}
