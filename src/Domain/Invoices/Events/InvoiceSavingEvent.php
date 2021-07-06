<?php


namespace Domain\Invoices\Events;


use Domain\Invoices\Models\Invoice;

class InvoiceSavingEvent
{
    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}
