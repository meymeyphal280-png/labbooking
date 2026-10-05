<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenace extends Model
{
    use HasFactory;

    protected $table = 'maintenaces';

    protected $fillable = [
        'laboratory_id',
        'equipment_id',
        'technician_id',
        'maintenance_date',
        'issue',
        'action_taken',
        'status',
        'cost',
    ];

    protected $casts = [
        'maintenance_date' => 'date',
        'cost' => 'decimal:2',
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class, 'laboratory_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}