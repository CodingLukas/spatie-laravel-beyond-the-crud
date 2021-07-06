<?php


namespace Domain\Invoices\Actions;


use Domain\Invoices\Models\Invoice;
use Domain\Invoices\States\Paid;

class PayInvoiceAction
{
    public function __invoke(Invoice $invoice): void
    {
        $invoice->status->transitionTo(Paid::class);
    }
}
