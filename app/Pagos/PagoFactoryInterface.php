<?php

namespace App\Pagos;

use InvalidArgumentException;

interface PagoFactoryInterface
{
/**
* @param $type
* @return PagoInterface
* @throws InvalidArgumentException
*/
public function create($type): PagoInterface;
}