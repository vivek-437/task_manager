<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_assign_tasks extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(tbl_users::class, 'tbl_user_id');
    }

    /**
     * Get the task that is assigned.
     */
    public function task()
    {
        return $this->belongsTo(tbl_tasks::class, 'tbl_task_id');
    }
}
