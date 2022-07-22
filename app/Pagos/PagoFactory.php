<?php

namespace App\Pagos;


use InvalidArgumentException;

class PagoFactory implements PagoFactoryInterface
{
private $app;

private $aliases = [
'mercadopago' => 'MERCADO PAGO',
'prisma' => 'PRISMA',
];

public function __construct($app)
{

$this->app = $app;
}

/**
* @param $type
* @return PagoInterface
* @throws InvalidArgumentException
*/
public function create($type) : PagoInterface
{
$pagoClass = __NAMESPACE__.'\\'.ucfirst($type).'Pago';

if (!array_key_exists($type, $this->aliases)) {
throw new InvalidArgumentException("Pago {$type} no existe");
}

if (!class_exists($pagoClass)) {
throw new InvalidArgumentException("Clase {$pagoClass} no existe");
}

return new $pagoClass();
}
}