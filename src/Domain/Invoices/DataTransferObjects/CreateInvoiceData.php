<?php

namespace Domain\Invoices\DataTransferObjects;

use App\Http\Requests\BookingStoreRequest;
use Domain\Units\Models\Unit;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\Period\Period;

class CreateInvoiceData extends DataTransferObject
{
    public string $number;

    /** @var InvoiceLineData[] */
    public array $invoiceLines;

    public static function fromStoreRequest(BookingStoreRequest $request): CreateInvoiceData
    {
        return new self([
            'name' => $request->input('name'),
            'unit' => Unit::findOrFail($request->input('unit_id')),
            'period' => Period::make(
                $request->input('date_start'),
                $request->input('date_end'),
            )
        ]);
    }


}
