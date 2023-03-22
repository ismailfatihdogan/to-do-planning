<?php

namespace App\Interfaces\Providers;

use App\Models\Provider;

interface ProviderServiceInterface
{
    public function __construct(Provider $provider);

    public function sendQueue(): void;
}
