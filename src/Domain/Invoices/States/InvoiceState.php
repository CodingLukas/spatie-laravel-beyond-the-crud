<?php


namespace Domain\Invoices\States;


use Spatie\ModelStates\State;

abstract class InvoiceState extends State
{
    abstract function getColour(): string;

    abstract function shouldBePaid(): bool;
}
