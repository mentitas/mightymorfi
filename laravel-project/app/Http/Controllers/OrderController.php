<?php

namespace App\Http\Controllers;
use App\Models\Restaurant; 
use App\Models\Order; 
use App\Http\Requests\RestaurantUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{

    public function orders()
    {   
        $orders = Order::select('restaurant', 'table', 'content','status')->get();
        return response()->json($orders);
    }

    // Me copio de locations() :3
    public function ordersFromRestaurant($restaurantId)
    {   
        $orders = Order::where('restaurant', $restaurantId)
               ->select('restaurant', 'table', 'content', 'status')
               ->get();
        return response()->json($orders);
    }

}
