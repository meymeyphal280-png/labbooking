<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratory_id',
        'day_of_week',
        'session',
        'start_time',
        'end_time',
        'status',
        'created_by',
    ];

    /**
     * Laboratory assigned to this schedule.
     */
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    /**
     * Admin/user who created the schedule.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}