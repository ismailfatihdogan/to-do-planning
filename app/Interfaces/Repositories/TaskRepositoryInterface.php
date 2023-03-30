<?php

namespace App\Interfaces\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function firstOrCreate(array $data): Task;

    public function updateById($id, $data): int;
}
