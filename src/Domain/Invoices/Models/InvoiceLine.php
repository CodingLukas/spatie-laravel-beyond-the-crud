<?php

namespace Domain\Invoices\Models;

use Domain\Invoices\Collections\InvoiceLineCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
{
    use HasFactory;

    public function newCollection(array $models = []): InvoiceLineCollection
    {
        return new InvoiceLineCollection($models);
    }
}
