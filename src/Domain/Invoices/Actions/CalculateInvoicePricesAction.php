<?php


namespace Domain\Invoices\Actions;


use Domain\Client\Models\Client;
use Domain\Invoices\DataTransferObjects\CreateInvoiceData;

class CalculateInvoicePricesAction
{
    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ): CreateInvoiceData
    {

    }
}
