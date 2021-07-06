<?php

namespace Domain\Payments;

use Domain\Client\Models\Client;

interface Payable
{
    public function getTotalPrice(): int;

    public function getDescription(): string;

    public function getClient(): Client;
}
