<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
    'department_id',
    'building_id',
    'lab_name',
    'room_number',
    'capacity',
    'location',
    'status',
    'description',
    'image',
];


    /**
     * Laboratory belongs to one Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    /**
     * Laboratory belongs to one Building
     */
    public function building()
    {
        return $this->belongsTo(Building::class);
    }


    /**
     * Laboratory has many Bookings
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function schedules()
{
    return $this->hasMany(LabSchedule::class);
}
}