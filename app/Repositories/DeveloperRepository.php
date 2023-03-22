<?php

namespace App\Repositories;

use App\Interfaces\Repositories\DeveloperRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeveloperRepository implements DeveloperRepositoryInterface
{
    public function findAvailableDeveloper(int $sprintPlanId, float $taskTime, int $taskLevel): ?object
    {
        return DB::selectOne("SELECT de.* FROM (
             SELECT d.id as developer_id, d.level as developer_level, FORMAT(:task_level / d.level * :task_time, 2) as estimation_time, SUM(t.developer_estimation_time) AS sprint_working_hours
             FROM developers d
                 LEFT JOIN tasks t ON d.id = t.developer_id AND t.sprint_plan_id = :sprint_plan_id
             WHERE d.level >= :task_level2
             GROUP BY d.id) AS de
    WHERE (de.sprint_working_hours + de.estimation_time) <= :week_working_hours OR de.sprint_working_hours is null
    ORDER BY de.developer_level DESC, de.sprint_working_hours DESC LIMIT 1",
            ['sprint_plan_id' => $sprintPlanId, 'task_time' => $taskTime, 'task_level' => $taskLevel, 'task_level2' => $taskLevel, 'week_working_hours' => config('settings.WEEK_WORKING_HOURS')]);
    }
}
