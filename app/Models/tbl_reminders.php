<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_reminders extends Model
{
    use HasFactory;
    protected $table = 'tbl_reminders';

    protected $fillable = [
        'tbl_project_id',
        'tbl_task_id',
    ];

    /**
     * Relationship with the TblProject model.
     */
    public function project()
    {
        return $this->belongsTo(tbl_projects::class, 'tbl_project_id');
    }

    /**
     * Relationship with the TblTask model.
     */
    public function task()
    {
        return $this->belongsTo(tbl_tasks::class, 'tbl_task_id');
    }
}
