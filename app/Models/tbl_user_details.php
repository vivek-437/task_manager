<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_user_details extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model
    protected $table = 'tbl_user_details';

    // Define which attributes can be mass assigned
    protected $fillable = [
        'tbl_user_id',
        'address',
        'phone',
        'date_of_birth',
        'gender',
        'profile_image_path',
        'bio',
        'nationality',
        'occupation',
        'resume_path',
        'tbl_shift_id',
    ];

    /**
     * Get the user that owns the user details.
     */
    public function user()
    {
        return $this->belongsTo(tbl_users::class, 'tbl_user_id');
    }

    /**
     * Get the shift that this user is assigned to.
     */
    public function shift()
    {
        return $this->belongsTo(tbl_shifts::class, 'tbl_shift_id');
    }
}
