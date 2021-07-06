<?php

namespace Domain\Invoices\Actions;

use Domain\Client\Models\Client;
use Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Domain\Invoices\Models\Invoice;
use Domain\Invoices\Models\InvoiceLine;
use Domain\Payments\Actions\CreatePaymentAction;
use Domain\Pdfs\Actions\CreatePdfAction;

class CreateInvoiceAction
{
    private CalculateInvoicePricesAction $calculateInvoicePricesAction;
    private DetermineInvoiceNumber $determineInvoiceNumber;
    private SaveInvoiceAction $saveInvoiceAction;
    private CreatePaymentAction $createPaymentAction;
    private CreatePdfAction $createPdfAction;
    private SendInvoiceMailAction $sendInvoiceMailAction;

    public function __construct(CalculateInvoicePricesAction $calculateInvoicePricesAction, DetermineInvoiceNumber $determineInvoiceNumber, SaveInvoiceAction $saveInvoiceAction, CreatePaymentAction $createPaymentAction, CreatePdfAction $createPdfAction, SendInvoiceMailAction $sendInvoiceMailAction)
    {
        $this->calculateInvoicePricesAction = $calculateInvoicePricesAction;
        $this->determineInvoiceNumber = $determineInvoiceNumber;
        $this->saveInvoiceAction = $saveInvoiceAction;
        $this->createPaymentAction = $createPaymentAction;
        $this->createPdfAction = $createPdfAction;
        $this->sendInvoiceMailAction = $sendInvoiceMailAction;
    }

    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ): Invoice
    {
        $data = ($this->calculateInvoicePricesAction)($client, $data);

        $data = ($this->determineInvoiceNumber)($client, $data);

        $invoice = ($this->saveInvoiceAction)($client, $data);

        $payment = ($this->createPaymentAction)($invoice);

        $pdf = ($this->createPdfAction)($invoice);

        ($this->sendInvoiceMailAction)($invoice, $pdf, $payment);

        return $invoice;
    }
}
