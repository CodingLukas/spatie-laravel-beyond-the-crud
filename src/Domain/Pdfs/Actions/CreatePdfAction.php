<?php


namespace Domain\Pdfs\Actions;


use Domain\Payments\Models\Payment;
use Domain\Payments\Payable;

class CreatePdfAction
{
    public function __invoke(Payable $payable): Payment
    {

    }
}
