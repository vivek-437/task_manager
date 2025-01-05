<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_role_permissions extends Model
{
    use HasFactory;

    protected $table = 'tbl_role_permission';
    protected $fillable = ['tbl_role_id','tbl_permission_id'];

    public function permissions()
    {
        return $this->belongsToMany(tbl_permissions::class,'tbl_role_permissions', 'tbl_role_id', 'tbl_permission_id');
    }
}
