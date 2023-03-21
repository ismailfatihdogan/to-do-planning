<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SprintPlanRepositoryInterface;
use App\Models\SprintPlan;

class SprintPlanRepository implements SprintPlanRepositoryInterface
{
    public function count(): int
    {
        return SprintPlan::query()->count();
    }

    public function firstOrCreate(array $attributes, array $values): SprintPlan
    {
        return SprintPlan::query()->firstOrCreate($attributes, $values);
    }
}
