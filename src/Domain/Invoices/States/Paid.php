<?php


namespace Domain\Invoices\States;


class Paid implements InvoiceState
{

    public function getColour(): string
    {
        return 'green';
    }
}
