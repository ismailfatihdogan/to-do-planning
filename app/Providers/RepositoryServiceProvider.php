<?php

namespace App\Providers;

use App\Interfaces\Repositories\DeveloperRepositoryInterface;
use App\Interfaces\Repositories\SprintPlanRepositoryInterface;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Repositories\DeveloperRepository;
use App\Repositories\SprintPlanRepository;
use App\Repositories\TaskRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DeveloperRepositoryInterface::class, DeveloperRepository::class);
        $this->app->bind(SprintPlanRepositoryInterface::class, SprintPlanRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
