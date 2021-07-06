<?php

namespace App\Http\Controllers;

use Domain\Invoices\Models\Invoice;
use Domain\Invoices\Models\InvoiceLine;
use Domain\Units\Models\Unit;
use Illuminate\Http\Request;
use Spatie\Period\Period;

class UnitBookingController extends Controller
{
    public function __invoke()
    {
       $units = Unit::all();

       $type = 'type-A';

       $period = Period::make('2021-12-01','2020-15-05');

        $unit = $units
            ->onlyActive()
            ->whereType($type)
            ->availableInPeriod($period)
            ->sortByPriority()
            ->first();
    }
}
