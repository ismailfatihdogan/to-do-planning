<?php

namespace App\Interfaces\Repositories;

interface DeveloperRepositoryInterface
{
    public function findAvailableDeveloper(int $sprintPlanId, float $taskTime, int $taskLevel): ?object;
}
