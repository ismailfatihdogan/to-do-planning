<?php

namespace App\Context;

use App\Interfaces\Providers\ProviderServiceInterface;
use Illuminate\Support\Facades\Log;

class ProviderContext
{
    protected ProviderServiceInterface $providerService;

    public function __construct(ProviderServiceInterface $providerService = null)
    {
        if ($providerService) {
            $this->setProviderService($providerService);
        }
    }

    public function setProviderService(ProviderServiceInterface $providerService): self
    {
        $this->providerService = $providerService;

        return $this;
    }

    /**
     * @return int
     */
    public function run(): int
    {
        $taskTotal = $this->providerService->sendQueue();

        Log::info('Provider tasks imported', ['providerService' => get_class($this->providerService), 'taskTotal' => $taskTotal]);

        return $taskTotal;
    }
}
