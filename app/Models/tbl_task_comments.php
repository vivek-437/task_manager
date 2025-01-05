<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_task_comments extends Model
{
    use HasFactory;
    protected $table = 'tbl_task_comments';

    protected $fillable = [
        'tbl_task_id',
        'tbl_user_id',
        'comment',
    ];

    /**
     * Relationship with the TblTask model.
     */
    public function task()
    {
        return $this->belongsTo(tbl_tasks::class, 'tbl_task_id');
    }

    /**
     * Relationship with the TblUser model.
     */
    public function user()
    {
        return $this->belongsTo(tbl_users::class, 'tbl_user_id');
    }

    /**
     * Relationship with the TblTaskAttachment model.
     */
    public function attachments()
    {
        return $this->hasMany(tbl_task_attachments::class, 'tbl_comment_id');
    }
}
