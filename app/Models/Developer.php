<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $full_name
 * @property int $level
 * @property boolean $status
 * @property Carbon $created_at
 * @property boolean $updated_at
 *
 * @property Collection<Task> $tasks
 */
class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'level', 'status'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
