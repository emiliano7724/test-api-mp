<?php

namespace App\Pagos;
use Illuminate\Http\JsonResponse;


interface PagoInterface
{
    /**
    * @param $data
    * @return PagoInterface
    */
    public function preparePay($data): JsonResponse;
}