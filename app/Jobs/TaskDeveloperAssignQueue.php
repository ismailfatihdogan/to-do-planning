<?php

namespace App\Jobs;

use App\Interfaces\Repositories\DeveloperRepositoryInterface;
use App\Interfaces\Repositories\SprintPlanRepositoryInterface;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Models\Developer;
use App\Models\SprintPlan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class TaskDeveloperAssignQueue implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    private DeveloperRepositoryInterface $developerRepository;
    private SprintPlanRepositoryInterface $sprintPlanRepository;
    private TaskRepositoryInterface $taskRepository;

    public function __construct(DeveloperRepositoryInterface $developerRepository, SprintPlanRepositoryInterface $sprintPlanRepository, TaskRepositoryInterface $taskRepository)
    {
        $this->developerRepository = $developerRepository;
        $this->sprintPlanRepository = $sprintPlanRepository;
        $this->taskRepository = $taskRepository;

        $this->onQueue('taskAssignQueue');
    }

    public function fire(Job $job, array $data)
    {
        $startDate = Carbon::now()->weekday(1);
        $endDate = Carbon::now()->weekday(5);

        /** @var Developer $developer */
        [$sprint, $developer] = $this->sprintAndDeveloperFinder($startDate, $endDate, $data['time'], $data['level']);

        $this->taskRepository->updateById($data['id'], [
            'sprint_plan_id' => $sprint->id,
            'developer_id' => $developer->developer_id,
            'developer_estimation_time' => $developer->estimation_time
        ]);

        $job->delete();
    }

    private function sprintFind(Carbon $startDate, Carbon $endDate)
    {
        $sprintCount = $this->sprintPlanRepository->count() + 1;

        /** @var SprintPlan $sprint */
        return $this->sprintPlanRepository->firstOrCreate(['start_date' => $startDate->toDateString(), 'end_date' => $endDate->toDateString()], ['title' => $sprintCount . '.Week Sprint']);
    }

    private function sprintAndDeveloperFinder(Carbon $startDate, Carbon $endDate, $time, $level)
    {
        $sprint = $this->sprintFind($startDate, $endDate);

        $developer = $this->developerRepository->findAvailableDeveloper($sprint->id, $time, $level);

        if (empty($developer)) {
            return $this->sprintAndDeveloperFinder($startDate->addWeek(), $endDate->addWeek(), $time, $level);
        }

        return [$sprint, $developer];
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception): void
    {
        Log::error('[Task Assign Queue][Error]', ['exception' => $exception->getMessage()]);
    }

    /**
     * Determine the time at which the job should time out.
     */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(10);
    }
}
