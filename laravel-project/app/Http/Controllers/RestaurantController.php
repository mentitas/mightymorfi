<?php

namespace App\Http\Controllers;
use App\Models\Restaurant; 
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

    public function restaurantsFromUser($userId)
    {
        $restaurants = Restaurant::where('owner_id', $userId)->get();
        return response()->json($restaurants);
    }

    public function update2(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            //'description' => 'nullable|string|max:500',
        ]);

        $data = Restaurant::findOrFail($id);
        $data->update([
            'name' => $request->input('name'),
            //'description' => $request->input('description'),
        ]);

        return redirect()->route('edit', $data->id)->with('success', 'Data updated successfully!');
    }


    /**
     * Display the restaurants's profile form.
     */
    /*
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
    */
    /**
     * Update the restaurants's profile information.
     */
    
    public function update(RestaurantUpdateRequest $request, $restaurantId): RedirectResponse
    {

        $restaurant = Restaurant::findOrFail($restaurantId);
        $restaurant->fill($request->validated());
        $restaurant->save();


        return Redirect::route('restaurant');
    }

    public function view(Request $request): Response
    {
        return Inertia::render('Restaurant/RestaurantCreate', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    

}
