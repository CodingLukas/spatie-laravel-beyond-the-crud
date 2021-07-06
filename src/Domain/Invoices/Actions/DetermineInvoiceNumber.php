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
    ): CreateInvoiceData
    {
        $latestInvoiceNumber = Invoice::query()->latestNumber();

        return $data->withNumber(
            str_pad(
                ((int)$latestInvoiceNumber) + 1,
                3,
                '0',
                STR_PAD_LEFT
            )
        );
    }
}
