<?php


namespace Domain\Invoices\Actions;


use Domain\Client\Models\Client;
use Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Domain\Invoices\Models\Invoice;
use Domain\Invoices\Models\InvoiceLine;

class SaveInvoiceAction
{
    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ): Invoice
    {
        $invoice = Invoice::create([
            'number' => $data->number,
            'client_id' => $client->id
        ]);

        foreach ($data->invoiceLines as $invoiceLineData) {
            InvoiceLine::create([
                'invoice_id' => $invoice->id,
                'description' => $invoiceLineData->description,
                'item_amount' => $invoiceLineData->itemAmount,
                'item_price' => $invoiceLineData->itemPrice,
                'vat_percentage' => $invoiceLineData->vatPercentage,
                'total_price_excluding_vat' => $invoiceLineData->totalPriceExcludingVat,
                'total_price_including_vat' => $invoiceLineData->totalPriceIncludingVat,
            ]);
        }

        return $invoice->refresh();
    }
}
