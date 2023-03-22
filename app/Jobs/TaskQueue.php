<?php

namespace App\Jobs;

use App\Interfaces\Repositories\TaskRepositoryInterface;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Throwable;

class TaskQueue implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;

        $this->onQueue('taskQueue');
    }

    public function fire(Job $job, array $data)
    {
        $task = $this->taskRepository->create($data);

        Queue::push(TaskDeveloperAssignQueue::class, $task->getAttributes());

        $job->delete();
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception): void
    {
        Log::error('[Task Queue][Error]', ['exception' => $exception->getMessage()]);
    }

    /**
     * Determine the time at which the job should time out.
     */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(10);
    }
}
