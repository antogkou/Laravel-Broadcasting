<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'project_participants');
    }
}
