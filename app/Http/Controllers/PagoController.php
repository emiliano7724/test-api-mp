<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagoController extends Controller
{
    public function successPay(Request $request)
    {
        $paymentId = $request->payment_id;
        $endpoint = config('constants.API_PAY') . $paymentId . "?access_token=" . config('constants.MP_ACCESS_TOKEN');
        $res = Http::get($endpoint)->json();
       
        return json_encode($res);
    }
}
