<?php

namespace App\Http\Controllers;

use Domain\Invoices\Models\Invoice;
use Domain\Invoices\Models\InvoiceLine;
use Illuminate\Http\Request;

class DiscountReportsController extends Controller
{
    public function __invoke()
    {
        $invoices = Invoice::query()
            ->with('invoiceLines')
            ->get();

        $negativeLines = $invoices->flatMap(
            fn(Invoice $invoice) => $invoice->invoiceLines->onlyNegatives()
        );
    }
}
