<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_attendances extends Model
{
    use HasFactory;

    protected $table = 'tbl_attendances';

    protected $fillable = [
        'in_time',
        'out_time',
        'duration',
        'tbl_shift_id',
        'tbl_user_id',
        'over_time',
    ];

    /**
     * Relationship with the TblShift model.
     */
    public function shift()
    {
        return $this->belongsTo(tbl_shifts::class, 'tbl_shift_id');
    }

    /**
     * Relationship with the TblUser model.
     */
    public function user()
    {
        return $this->belongsTo(tbl_users::class, 'tbl_user_id');
    }

    /**
     * Calculate the duration based on in_time and out_time.
     */
    public function calculateDuration()
    {
        if ($this->in_time && $this->out_time) {
            $inTime = strtotime($this->in_time);
            $outTime = strtotime($this->out_time);
            $durationInSeconds = $outTime - $inTime;

            $hours = floor($durationInSeconds / 3600);
            $minutes = floor(($durationInSeconds % 3600) / 60);

            return sprintf('%02d:%02d', $hours, $minutes);
        }

        return null;
    }

    /**
     * Check if the attendance qualifies for overtime.
     */
    public function checkOvertime()
    {
        if ($this->duration && $this->shift) {
            $shiftStart = strtotime($this->shift->start_time);
            $shiftEnd = strtotime($this->shift->end_time);
            $shiftDuration = ($shiftEnd - $shiftStart) / 3600; // In hours

            $attendanceDuration = strtotime($this->duration) / 3600; // In hours

            return $attendanceDuration > $shiftDuration;
        }

        return false;
    }
}
