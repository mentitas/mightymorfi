<?php

namespace App\Http\Controllers;

use App\Models\Restaurant; 
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MapController extends Controller
{

    public function view(): Response
    {
        $locations = Restaurant::select('latitude', 'longitude')->get();
        return Inertia::render('Map',[
            'locations' => $locations
        ]);
    }
}
