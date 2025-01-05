<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_task_attachments extends Model
{
    use HasFactory;

    protected $table = 'tbl_task_attachments';

    protected $fillable = [
        'tbl_comment_id',
        'file_path',
    ];

    /**
     * Relationship with the TblComment model.
     */
    public function comment()
    {
        return $this->belongsTo(tbl_task_comments::class, 'tbl_comment_id');
    }
}
