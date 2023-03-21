<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function create(array $data): Task
    {
        return Task::query()->create($data);
    }

    public function updateById($id, $data): int
    {
        return Task::query()->where('id', $id)->update($data);
    }
}
