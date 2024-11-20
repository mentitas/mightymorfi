<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\{Restaurant}; 

class QrCodeController extends Controller
{   

    public function generate(Request $request, $id)
    {   
            $restaurant = Restaurant::where('owner_id', $request->user()->id)->findOrFail($id);
            $tables = $restaurant['tables'];
            $qrCodes = [];

            for ($table = 1; $table <= $tables; $table++) {
                $url = 'http://127.0.0.1:8000/order/' . $id . '/' . $table; // TODO: Cambiar URL!!!
                $qrCode = QrCode::format('png')->size(200)->generate($url);
                $qrCodes[] = 'data:image/png;base64,' . base64_encode($qrCode);
                
            }
                
            return Inertia::render('Restaurant/RestaurantQRs', [
                'restaurant' => $restaurant,
                'qrs' => $qrCodes
            ]);

    }

}
