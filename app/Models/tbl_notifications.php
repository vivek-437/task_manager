<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_notifications extends Model
{
    use HasFactory;
    protected $table = 'tbl_notifications';

    protected $fillable = [
        'tbl_user_id',
        'tbl_project_id',
        'tbl_task_id',
        'message',
        'read_status',
    ];

    /**
     * Relationship with the TblUser model.
     */
    public function user()
    {
        return $this->belongsTo(tbl_users::class, 'tbl_user_id');
    }

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

    /**
     * Mark the notification as read.
     */
    public function markAsRead()
    {
        $this->update(['read_status' => true]);
    }

    /**
     * Mark the notification as unread.
     */
    public function markAsUnread()
    {
        $this->update(['read_status' => false]);
    }
}
