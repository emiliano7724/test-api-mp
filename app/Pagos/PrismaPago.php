<?php

namespace App\Reports;


use Barryvdh\DomPDF\PDF;


class PrismaPago implements PagoInterface
{
    private $view = 'pdf.order';

    /**
    * @var PDF
    */
    private $pdf;

    /**
    * DompdfReport constructor.
    * @param PDF $pdf
    */
    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
    * @param $data
    * @return PagoInterface
    */
    public function preparePay($data) : PagoInterface
    {
        //logica de la prepracion de pago de Prisma
        return $this;
    }
}

