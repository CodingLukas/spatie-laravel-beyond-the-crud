<?php


namespace Domain\Invoices\Observers;


use Domain\Invoices\Models\Invoice;
use Domain\Invoices\Models\InvoiceLine;

class InvoiceObserver
{
    public function saving(Invoice $invoice): void
    {
        $invoice->total_price = $invoice->invoiceLines
            ->sum(fn(InvoiceLine $invoiceLine) => $invoiceLine->total_price);
    }
}
