<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_projects extends Model
{
    use HasFactory; 

    protected $table = "tbl_projects";

    protected $fillable =['project_name','description','project_category','start_date','end_date'];

    
    public function tasks()
    {
        return $this->hasMany(tbl_tasks::class, 'tbl_project_id');
    }
    public function getStartDateFormattedAttribute()
    {
        return $this->start_date 
            ? Carbon::parse($this->start_date)->format('d-m-Y h:i A') 
            : 'N/A';
    }
    
    public function getEndDateFormattedAttribute()
    {
        return $this->end_date 
            ? Carbon::parse($this->end_date)->format('d-m-Y h:i A') 
            : 'N/A';
    }
}
