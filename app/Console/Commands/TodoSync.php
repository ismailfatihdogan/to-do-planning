<?php

namespace App\Console\Commands;

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
    public function handle()
    {
        /** @var Collection<Provider> $providers */
        $providers = Provider::query()->where('status', true)->get();

        foreach ($providers as $provider) {
            app($provider->class_path, ['provider' => $provider])->sendQueue();
        }

        return Command::SUCCESS;
    }
}
