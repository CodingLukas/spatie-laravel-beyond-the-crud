<?php

namespace Domain\Invoices\Models;

use Domain\Client\Models\Client;
use Domain\Invoices\Events\InvoiceSavingEvent;
use Domain\Invoices\Observers\InvoiceObserver;
use Domain\Invoices\States\Cancelled;
use Domain\Invoices\States\InvoiceState;
use Domain\Invoices\States\Overdue;
use Domain\Invoices\States\Paid;
use Domain\Invoices\States\Pending;
use Domain\Payments\Payable;
use Domain\Pdfs\ToPdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\ModelStates\HasStates;

/**
 * @property-read InvoiceState status
 */
class Invoice extends Model implements Payable, ToPdf
{
    use HasFactory,
        HasStates;

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

    public function getColour(): string
    {
        return $this->getState()->getColour();
    }

    public function getState(): InvoiceState
    {
        if ($this->status === 'overdue') {
            return new Overdue();
        }

        if ($this->status === 'paid') {
            return new Paid();
        }

        if ($this->status === 'cancelled') {
            return new Cancelled();
        }

        return new Pending();
    }

    protected function registerStates(): void {
        $this->addState('status', InvoiceState::class)
            ->allowTransition(Pending::class, Paid::class)
            ->allowTransition(Pending::class, Cancelled::class)
            ->allowTransition(Pending::class, Overdue::class)
            ->allowTransition(Overdue::class, Paid::class)
            ->allowTransition(Overdue::class, Cancelled::class);
    }
}
