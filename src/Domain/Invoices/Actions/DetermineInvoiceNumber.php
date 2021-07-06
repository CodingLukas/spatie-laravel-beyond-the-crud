<?php


namespace Domain\Invoices\Actions;


use Domain\Client\Models\Client;
use Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Domain\Invoices\Models\Invoice;

class DetermineInvoiceNumber
{
    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ) : CreateInvoiceData
    {
        // TODO: Implement __invoke() method.
    }
}
