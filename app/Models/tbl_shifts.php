<?php

namespace App\Models;

use Carbon\Carbon;
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

        // Accessor for formatted start time
         // Format the start_time to AM/PM
    public function getStartTimeFormattedAttribute()
    {
        return $this->start_time ? Carbon::parse($this->start_time)->format('h:i A') : 'N/A';
    }

    // Format the end_time to AM/PM
    public function getEndTimeFormattedAttribute()
    {
        return $this->end_time ? Carbon::parse($this->end_time)->format('h:i A') : 'N/A';
    }
}
