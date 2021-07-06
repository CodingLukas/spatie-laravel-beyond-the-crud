<?php

namespace Domain\Subscribers;

use Domain\Invoices\Events\InvoiceSavingEvent;
use Illuminate\Events\Dispatcher;

class InvoiceSubscriber
{
    private CalculateInvoiceTotalPriceAction $calculatePricesAction;

    public function __construct(CalculateInvoiceTotalPriceAction $calculatePricesAction)
    {
        $this->calculatePricesAction = $calculatePricesAction;
    }

    public function saving(InvoiceSavingEvent $event): void
    {
        $invoice = $event->invoice;

        $invoice->total_price = ($this->calculatePricesAction)($invoice);
    }

    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen(
            InvoiceSavingEvent::class,
            self::class . '@saving'
        );
    }
}
