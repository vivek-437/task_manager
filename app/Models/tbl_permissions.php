<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_permissions extends Model
{
    use HasFactory;
    protected $table = 'tbl_permissions';

    protected $fillable = ['permission_name', 'description', 'tbl_permission_id'];

        /**
     * The roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(tbl_roles::class, 'tbl_role_permissions', 'tbl_permission_id', 'tbl_role_id');
    }

     /**
     * Get the parent permission for this permission.
     */
    public function parent()
    {
        return $this->belongsTo(tbl_permissions::class, 'tbl_permission_id');
    }

    /**
     * Get all child permissions for this permission.
     */
    public function children()
    {
        return $this->hasMany(tbl_permissions::class, 'tbl_permission_id');
    }
}
