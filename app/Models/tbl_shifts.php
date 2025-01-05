<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_shifts extends Model
{
    use HasFactory;

    protected $table = 'tbl_shifts';

    protected $fillable = [
        'shift_type',
        'start_time',
        'end_time',
        'location',
        'notes',
    ];

    /**
     * Get the time logs associated with the shift.
     */
    public function timeLogs()
    {
        return $this->hasMany(tbl_time_logs::class, 'tbl_shift_id');
    }

}
