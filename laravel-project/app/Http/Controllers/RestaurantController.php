<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant; 

class RestaurantController extends Controller
{

    public function locations()
    {
        $restaurants = Restaurant::select('name', 'latitude', 'longitude','horarios','menu')->get();
        return response()->json($restaurants);
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
    /*
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }
    */

}
