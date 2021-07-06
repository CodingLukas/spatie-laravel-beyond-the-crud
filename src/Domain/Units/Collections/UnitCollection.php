<?php


namespace Domain\Units\Collections;


use Domain\Invoices\Models\InvoiceLine;
use Illuminate\Database\Eloquent\Collection;

class UnitCollection extends Collection
{
    public function onlyNegatives(): self
    {
        return $this->filter(
            fn(InvoiceLine $invoiceLine) => $invoiceLine->total_price < 0
        );
    }
}
