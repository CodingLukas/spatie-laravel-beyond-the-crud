<?php


namespace Domain\Invoices\States;


class Pending implements InvoiceState
{

    public function getColour(): string
    {
        return 'white';
    }
}
