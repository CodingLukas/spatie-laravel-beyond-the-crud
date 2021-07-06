<?php


namespace Domain\Invoices\States;


class Overdue implements InvoiceState
{

    public function getColour(): string
    {
        return 'red';
    }
}
