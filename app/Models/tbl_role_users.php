<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_role_users extends Model
{
    use HasFactory;

    protected $table = 'tbl_role_users';

    protected $fillable = [
        'tbl_role_id',
        'tbl_user_id',
    ];

    /**
     * Get the role associated with the user in this pivot table.
     */
    public function role()
    {
        return $this->belongsTo(tbl_roles::class, 'tbl_role_id');
    }

    /**
     * Get the user associated with the role in this pivot table.
     */
    public function user()
    {
        return $this->belongsTo(tbl_users::class, 'tbl_user_id');
    }
}
