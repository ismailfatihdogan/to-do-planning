<?php

namespace App\Console\Commands;

use App\Context\ProviderContext;
use App\Models\Provider;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class TodoSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls to-do listings from providers';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        /** @var Collection<Provider> $providers */
        $providers = Provider::query()->where('status', true)->get();
        $providerContext = new ProviderContext();

        $totalTask = 0;

        foreach ($providers as $provider) {
            $totalTask += $providerContext
                ->setProviderService(app($provider->class_path, ['provider' => $provider]))
                ->run();
        }

        $this->info(sprintf('Successfully imported %s jobs from %s providers', $totalTask, count($providers)));

        return Command::SUCCESS;
    }
}
