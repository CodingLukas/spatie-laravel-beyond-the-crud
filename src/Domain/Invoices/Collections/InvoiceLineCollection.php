<?php


namespace Domain\Invoices\Collections;


use Domain\Invoices\Models\InvoiceLine;
use Illuminate\Database\Eloquent\Collection;

class InvoiceLineCollection extends Collection
{
    public function onlyNegatives(): self
    {
        return $this->filter(
            fn(InvoiceLine $invoiceLine) => $invoiceLine->total_price < 0
        );
    }
}
