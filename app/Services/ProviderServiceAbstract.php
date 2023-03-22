<?php

namespace App\Services;

use App\Jobs\TaskQueue;
use App\Models\Provider;
use App\Models\Task;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

abstract class ProviderServiceAbstract
{
    protected Provider $provider;

    protected function getProvider(): ?Provider
    {
        return $this->provider;
    }

    protected function setProvider(Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @param string $method GET or POST
     * @param array $options
     * @return array
     * @throws GuzzleException
     */
    protected function request(string $method, array $options = []): array
    {
        try {
            $response = (new Client())->request($method, $this->getProvider()->url, $options);

            if ($response->getStatusCode() !== 200) {
                Log::error('[Provider Service][Request Error]', [
                    'provider' => $this->getProvider()->getAttributes(),
                    'response' => $response->getBody()->getContents(),
                    'statusCode' => $response->getStatusCode()
                ]);

                return [];
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $exception) {
            Log::error('[Provider Service][Request Exception]', [
                'provider' => $this->getProvider()->getAttributes(),
                'error' => $exception->getMessage()
            ]);

            throw new $exception;
        }
    }

    /**
     * @param Task $task
     * @return mixed
     */
    protected function pushQueue(array $task): mixed
    {
        return Queue::push(TaskQueue::class, $task);
    }
}
