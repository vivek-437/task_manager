<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tasks extends Model
{
    use HasFactory;

    protected $table = 'tbl_tasks'; // Specify the table name if it's not following Laravel's naming conventions

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'tbl_project_id',
        'due_date',
        'parent_task_id'
    ];

    /**
     * A task belongs to a project.
     */
    public function project()
    {
        return $this->belongsTo(tbl_projects::class, 'tbl_project_id');
    }

    /**
     * A task may have a parent task.
     */
    public function parentTask()
    {
        return $this->belongsTo(tbl_tasks::class, 'parent_task_id');
    }

    /**
     * A task may have many sub-tasks (children).
     */
    public function subTasks()
    {
        return $this->hasMany(tbl_tasks::class, 'parent_task_id');
    }
}
