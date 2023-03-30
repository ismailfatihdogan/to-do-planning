<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Arr;

class TaskRepository implements TaskRepositoryInterface
{
    public function firstOrCreate(array $data): Task
    {
        return Task::query()->firstOrCreate(
            [
                'provider_id' => $data['provider_id'],
                'title' => $data['title']
            ],
            Arr::except($data, ['provider_id', 'title'])
        );
    }

    public function updateById($id, $data): int
    {
        return Task::query()->where('id', $id)->update($data);
    }
}
