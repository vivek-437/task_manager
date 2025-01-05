<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_roles extends Model
{
    use HasFactory;

    protected $table = 'tbl_roles';

    protected $fillable = ['role_name'];

    public function permissions()
    {
        return $this->belongsToMany(tbl_permissions::class,'tbl_role_permissions', 'tbl_role_id', 'tbl_permission_id');
    }
}
