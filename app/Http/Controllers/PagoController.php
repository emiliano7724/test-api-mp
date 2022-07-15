<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Support\Carbon;
use App\Models\Plataforma;
use App\Models\Estado;
use Illuminate\Support\Facades\DB;
use App\Models\ItemPago;

class PagoController extends Controller
{

    public function prepararPago(Request $request)
    {
         $data = [
            "id_cliente_api_pago" => 1,  // este ID identifica a BASA en este caso ver donde podria estas guardado
            "id_plataforma_pago" => 1, // MP
            "items" => [
                [
                    "title" => "Reserva de turno",
                    "quantity" => 5,
                    "unit_price" => 11,
                    "description" =>"description",
                    "category_id" => null,
                    "picture_url" => null,
                    "currency_id" => null
                ],
                 ]
        ];
       
        //$data= (object)$data; 
        $data = (object)$data;
    
        switch ($data->id_plataforma_pago) {
            case 1: //MERCADO PAGO -- id de la tabla plataformas
                //con el id del cliente buscamos su token de mercado pago y su key
                $credenciales = Cliente::select('token_mp', 'key_mp')
                    ->where('id', $data->id_cliente_api_pago)
                    ->first();
       
                SDK::setAccessToken($credenciales->token_mp);

                // Crea un objeto de preferencia
                $preference = new Preference();

                $preference->back_urls = array(
                    "success" => route('returnPagoExitosoMP'),
                    "failure" => "http://www.tu-sitio/failure",
                    "pending" => "http://www.tu-sitio/pending"
                );
             
            
                $preference->auto_return = "approved";
                // Crea un ítem en la preferencia

                // Seteamos el los Items
                $arrayItems = array();
                foreach ($data->items as $item) {
                    $i = (object)$item;

                    $item = new Item();
                    $item->title = $i->title;
                    $item->quantity = $i->quantity;
                    $item->unit_price = $i->unit_price;

                    array_push($arrayItems, $item);
                }

                $preference->items = $arrayItems;
                $preference->save();
    
                $key = $credenciales->key_mp;

/* return json_encode($preference);
                return response()->json($preference); */
            //  return response()->json(['preference'=>json_decode(json_encode($preference))]);
             //   return response()->json(['preference'=>$preference]);
                return view('pago', compact('preference', 'key'));
                break;
        }
    }

    public function successPayMP(Request $request)
    {

        DB::beginTransaction();
        try {
            $data = (object)$request->all();

            //aca guardamos el pago de acuerdo a los datos q necesita cada plataforma

            $pago = Pago::create([
                'fecha' => Carbon::now(),
                'preference_id' => $data->preference_id,
                'payment_id' => $data->payment_id,
                'site_id' => $data->site_id,
                'id_plataforma' => Plataforma::where('nombre', "Mercado Pago")->first()->id,
                'collection_id' => $data->collection_id,
                'collection_status' => $data->collection_status,
                'status' => $data->status,
                'external_reference' => $data->external_reference,
                'payment_type' => $data->payment_type,
                'merchant_order_id' => $data->merchant_order_id,
                'processing_mode' => $data->processing_mode,
                'merchant_account_id' => $data->merchant_account_id,
                'id_estado' => null  // luego de saber el estado actualizamos este campo
            ]);

            //guardar el pacient (dni),  el pago y el turno
            $paymentId = $data->payment_id;

            //aca ver el acces token si lo recuperamos con el cliente logueado ahora se lo pasamos asi
            $endpoint = config('constants.API_PAY') . $paymentId . "?access_token=" . config('constants.MP_ACCESS_TOKEN');
            $res = Http::get($endpoint)->json();

            $resObject = (object) $res;
            // recuperamos el status del pago para actualizar la tabla pagos
            $pago->id_estado = Estado::where('descripcion', $resObject->status_detail)->first()->id;
            $pago->update();

            // Recueramos los items y los persistimos
            //ver si esto deberia hacerle el cliente del api y no la api
            $items = $resObject->additional_info['items'];
            foreach ($items as $i) {
                $i=(object)$i;
             
                ItemPago::create(
                    [
                        'id_pago' => $pago->id,
                        'title' => $i->title,
                        'quantity' => $i->quantity,
                        'unit_price' => $i->unit_price,
                        'description' => $i->description,
                        'category_id' => $i->category_id,
                        'picture_url' => $i->picture_url,
                     
                    ]
                );
            }
            DB::commit();
            // devolvemoes esta info para que la api cliente la procese
            return json_encode($res);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollback();
        }
    }
}
