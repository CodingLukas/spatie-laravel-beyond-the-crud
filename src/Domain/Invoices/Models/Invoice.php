<?php

namespace Domain\Invoices\Models;

use Domain\Client\Models\Client;
use Domain\Invoices\Events\InvoiceSavingEvent;
use Domain\Invoices\Observers\InvoiceObserver;
use Domain\Payments\Payable;
use Domain\Pdfs\ToPdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model implements Payable, ToPdf
{
    use HasFactory;

    protected $dispatchesEvents = [
      'saving' => InvoiceSavingEvent::class
    ];

    protected static function boot()
    {
        parent::boot();

        self::observe(InvoiceObserver::class);
    }

    public function invoiceLines(): HasMany
    {
        return $this->hasMany(InvoiceLine::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function getTotalPrice(): int
    {
        return $this->invoiceLines->sum(
            fn(InvoiceLine $invoiceLine) => $invoiceLine->total_price_including_vat
        );
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
