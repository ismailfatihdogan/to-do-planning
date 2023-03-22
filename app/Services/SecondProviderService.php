<?php

namespace App\Services;

use App\Interfaces\Providers\ProviderServiceInterface;
use App\Models\Provider;

class SecondProviderService extends ProviderServiceAbstract implements ProviderServiceInterface
{
    public function __construct(Provider $provider)
    {
        $this->setProvider($provider);
    }

    public function sendQueue(): void
    {
        foreach ($this->request('GET') as $task) {
            $title = array_key_first($task);

            $this->pushQueue([
                'provider_id' => $this->getProvider()->id,
                'title' => $title,
                'level' => $task[$title]['level'],
                'time' => $task[$title]['estimated_duration']
            ]);
        }
    }
}
