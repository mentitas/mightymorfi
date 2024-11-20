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

    // ¡Cambiar! La llamada a la base de datos debe estar adentro del modelo Restaurant 
    public function locations()
    {
        $restaurants = Restaurant::select('name', 'latitude', 'longitude','horarios','menu')->get();
        return response()->json($restaurants);
    }

    public function getRestaurantInfo(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        return response()->json($restaurant);
    }

    public function update(RestaurantUpdateRequest $request, $restaurantId): RedirectResponse
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $restaurant->fill($request->validated());
        $restaurant->save();

        return Redirect::route('restaurant');
    }

    public function createRestaurant(Request $request){
        Restaurant::factory()->create([
            'name'=> $request->input('data')['name'],
            'owner_id' => $request->user(),
            'address' => $request->input('data')['address'],
            'menu' => $request->input('data')['menu'],
            'tables' => $request->input('data')['menu'],
            'timetable' => $request->input('data')['timetable'],
            'contact' => $request->input('data')['contact'],
            'latitude' => $request->input('data')['latitude'],
            'longitude' => $request->input('data')['longitude']
        ]);
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
        $restaurant = Restaurant::where('owner_id', $request->user()->id)->findOrFail($restaurantId);
        $orders = Order::where('restaurant',$restaurantId)->select('restaurant', 'table', 'content', 'status', 'id')->get();
        return Inertia::render('Restaurant/RestaurantOrders', [
            'restaurant' => $restaurant,
            'orders' => $orders
        ]);
    }

    //Render pagina lista restaurants
    public function viewList(Request $request): Response
    {
        $restaurants = Restaurant::where('owner_id', $request->user()->id)->get();
        return Inertia::render('Restaurant/RestaurantList', [
            'restaurants' => $restaurants
        ]);
    }

    

}
