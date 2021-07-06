<?php

namespace Domain\Units\Models;

use Domain\Invoices\Collections\InvoiceLineCollection;
use Domain\Units\Collections\UnitCollection;
use Domain\Units\QueryBuilders\UnitQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Unit extends Model
{
    use HasFactory;

    public function newCollection(array $models = []): UnitCollection
    {
        return new UnitCollection($models);
    }

    public function newEloquentBuilder($query): UnitQueryBuilder
    {
        return new UnitQueryBuilder($query);
    }
}
