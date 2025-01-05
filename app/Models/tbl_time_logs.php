<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_time_logs extends Model
{
    use HasFactory;

    protected $table = 'tbl_time_logs';

    protected $fillable = [
        'tbl_user_id',
        'tbl_project_id',
        'tbl_task_id',
        'start_time',
        'end_time',
        'tbl_shift_id',
    ];

    // Relationship methods (User, Project, Task, Shift)
    public function user()
    {
        return $this->belongsTo(tbl_users::class, 'tbl_user_id');
    }

    public function project()
    {
        return $this->belongsTo(tbl_projects::class, 'tbl_project_id');
    }

    public function task()
    {
        return $this->belongsTo(tbl_tasks::class, 'tbl_task_id');
    }

    public function shift()
    {
        return $this->belongsTo(tbl_shifts::class, 'tbl_shift_id');
    }

    // Duration calculator method
    public function calculateDuration()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);

        // Calculate the difference
        $duration = $start->diff($end);

        // Return the result in a human-readable format (hours, minutes, seconds)
        return $duration->format('%H hours, %I minutes, %S seconds');
    }
}
