<?php

namespace App\Http\Controllers;
use App\Models\{Restaurant, Order}; 
use App\Http\Requests\RestaurantUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RestaurantController extends Controller
{

    public function locations()
    {
        $restaurants = Restaurant::location();
        return response()->json($restaurants);
    }

    public function getRestaurantInfo(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::getInfo($restaurantId);
        return response()->json($restaurant);
    }

    public function update(RestaurantUpdateRequest $request, $restaurantId): RedirectResponse
    {
        //$attributes = $request->validated();
        $attributes = [ 'name' => $request->input('name'), 
        'contact'   => $request->input('contact'), 
        'address'   => $request->input('address'), 
        'menu'      => $request->input('menu'), 
        'tables'    => $request->input('tables'),
        'timetable' => $request->input('timetable'),
        'logo'      => $request->input('logo')
        ];

        Restaurant::updateRestaurant($restaurantId, $attributes);
        return Redirect::route('restaurant');
    }

    public function createRestaurant(Request $request)
    {        
        $atributtes = [
            'name'=> $request->input('data')['name'],
            'owner_id' => $request->user(),
            'address' => $request->input('data')['address'],
            'menu' => $request->input('data')['menu'],
            'tables' => $request->input('data')['tables'],
            'timetable' => $request->input('data')['timetable'],
            'contact' => $request->input('data')['contact'],
            'latitude' => $request->input('data')['latitude'],
            'longitude' => $request->input('data')['longitude']
        ];
        Restaurant::newRestaurant($atributtes);    
        return Redirect::route('restaurant');
    }

    //Render pagina creacion restaurant
    public function viewCreateForm(Request $request): Response
    {
        return Inertia::render('Restaurant/RestaurantCreate', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    //Render pagina ordenes de un restaurant
    public function viewOrders(Request $request, $restaurantId): Response
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $orders = Order::getBy('restaurant', $restaurantId);
        
        return Inertia::render('Restaurant/RestaurantOrders', [
            'restaurant' => $restaurant,
            'orders' => $orders
        ]);
    }

    //Render pagina ordenes de un restaurant
    public function editRestaurant(Request $request, $restaurantId): Response
    {   
        $restaurant = Restaurant::where('owner_id', $request->user()->id)->findOrFail($restaurantId);
        return Inertia::render('Restaurant/RestaurantManagement', [
            'restaurant' => $restaurant,
        ]);
    }

    //Render pagina lista restaurants
    public function viewList(Request $request): Response
    {
        $restaurants = Restaurant::getByOwner($request->user()->id);
        return Inertia::render('Restaurant/RestaurantList', [
            'restaurants' => $restaurants
        ]);
    }


    public function delete(Request $request, $restaurantId): RedirectResponse
    {   
        $restaurant = Restaurant::close($restaurantId);
        
        //Restaurant::findOrFail($restaurantId);
        //$restaurant->delete();

        return back();
    }
}