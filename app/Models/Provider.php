<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $url
 * @property string $class_path
 * @property boolean $status
 *
 * @property Collection<Task> $tasks
 */
class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'url', 'class_path', 'status'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
