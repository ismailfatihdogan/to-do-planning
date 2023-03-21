<?php

namespace App\Interfaces\Repositories;

use App\Models\SprintPlan;
use Illuminate\Database\Eloquent\Model;

interface SprintPlanRepositoryInterface
{
    public function count(): int;

    public function firstOrCreate(array $attributes, array $values): SprintPlan;
}
