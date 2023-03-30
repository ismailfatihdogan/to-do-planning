<?php

namespace App\Services;

use App\Interfaces\Providers\ProviderServiceInterface;
use App\Models\Provider;

class FirstProviderService extends ProviderServiceAbstract implements ProviderServiceInterface
{
    public function __construct(Provider $provider)
    {
        $this->setProvider($provider);
    }

    public function sendQueue(): int
    {
        $tasks = $this->request('GET');

        foreach ($tasks as $task) {
            $this->pushQueue([
                'provider_id' => $this->getProvider()->id,
                'title' => $task['id'],
                'level' => $task['zorluk'],
                'time' => $task['sure']
            ]);
        }

        return count($tasks);
    }
}
