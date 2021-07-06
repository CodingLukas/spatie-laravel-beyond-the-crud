<?php


namespace Domain\Invoices\States;


class Cancelled implements InvoiceState
{

    public function getColour(): string
    {
        return 'gray';
    }

    public function shouldBePaid(): bool
    {
        // TODO: Implement shouldBePaid() method.
    }
}
