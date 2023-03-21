<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $provider_id
 * @property int $sprint_plan_id
 * @property int $developer_id
 * @property string $title
 * @property int $level
 * @property float $time
 * @property float $developer_estimation_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property Provider $provider
 * @property SprintPlan $sprintPlan
 * @property Developer $developer
 */
class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['provider_id', 'sprint_plan_id', 'developer_id', 'title', 'level', 'time', 'developer_estimation_time'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function sprintPlan()
    {
        return $this->belongsTo(SprintPlan::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }
}
