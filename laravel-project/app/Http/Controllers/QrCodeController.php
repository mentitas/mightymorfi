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

    public function generateQR($url){
        $qrCode = QrCode::format('png')->size(200)->generate($url);
        return 'data:image/png;base64,' . base64_encode($qrCode);
    }

    public function generateAllQRs(Request $request, $id)
    {       
        $restaurant = Restaurant::where('owner_id', $request->user()->id)->findOrFail($id);
        $tables = $restaurant['tables'];
        
        $qrCodesNames   = [];
        $qrCodesContent = [];
        $qrCodesImages  = [];

        $qrCodesNames[]   = "pickup";
        $qrCodesContent[] = 'http://127.0.0.1:8000/order/' . $id . '/pickup';
        $qrCodesImages[]  = QrCodeController::generateQR('http://127.0.0.1:8000/order/' . $id . '/pickup');
        
        for ($table = 1; $table <= $tables; $table++) {
            $qrCodesNames[]   = $table;
            $qrCodesContent[] = 'http://127.0.0.1:8000/order/' . $id . '/' . $table;
            $qrCodesImages[]  = QrCodeController::generateQR('http://127.0.0.1:8000/order/' . $id . '/' . $table);
        }

        return Inertia::render('Restaurant/RestaurantQRs', [
            'restaurant' => $restaurant,
            'qrs'  => $qrCodesImages,
            'urls' => $qrCodesContent,
            'names' => $qrCodesNames,
        ]);

    }

}
