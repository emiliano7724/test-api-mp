<?php

namespace App\Pagos;


use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use MercadoPago\SDK;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\Payer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;



class MercadopagoPago implements PagoInterface
{
   

    /**
     * @var SDK MERCADO
     */
    private $obj;

    /**
     * DompdfReport constructor.
     * @param PDF $pdf
     */
    public function __construct( $obj =null)
    {

        $this->obj = $obj;
    }

    /**
     * @param $data
     * @return PagoInterface
     */
    public function preparePay($data): JsonResponse
    {
       
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
        //seteamos los datos del comprador
        $payer = new Payer();
        $payer->name = $data->comprador['nombre'];
        $payer->surname = $data->comprador['apellido'];
        $payer->email = $data->comprador['email'];
        $payer->date_created = Carbon::now();
        $payer->phone =  $data->comprador['telefono'];
        $payer->identification =  $data->comprador['identificacion'];
        $payer->address =  $data->comprador['direccion'];
        // Fin set Comprador
        $preference->payer = $payer;
        $preference->save();

        $key = $credenciales->key_mp;

        $endpoint = config('constants.API_PREFERENCE') . $preference->id . "?access_token=" . config('constants.MP_ACCESS_TOKEN');

        $res = Http::get($endpoint)->json();

        $resObject = (object) $res;

        return response()->json(['preference' => json_decode(json_encode($resObject)), 'key' => $key]);
        
    }
}
