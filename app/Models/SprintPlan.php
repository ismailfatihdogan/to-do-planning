<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string title
 * @property Carbon start_date
 * @property Carbon end_date
 *
 * @property Collection<Task> $tasks
 */
class SprintPlan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
