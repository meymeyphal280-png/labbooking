<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'laboratory_id',
        'department_id',
        'booking_date',
        'start_time',
        'end_time',
        'participants',
        'purpose',
        'status',
        'approved_by',
        'remark',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'participants' => 'integer',
    ];

    /**
     * Get the user who submitted the booking request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the laboratory reserved for this booking.
     */
    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class, 'laboratory_id');
    }

    /**
     * Get the department associated with this booking.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Get the user who approved or rejected the booking.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}