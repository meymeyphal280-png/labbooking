<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserReport extends Model
{
    protected $fillable = [

        'user_id',

        'laboratory_id',

        'equipment_id',

        'maintenance_id',

        'title',

        'issue_type',

        'description',

        'priority',

        'status',

        'admin_note',

        'resolved_at',

    ];


    protected $casts = [

        'resolved_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Laboratory
    |--------------------------------------------------------------------------
    */

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Equipment
    |--------------------------------------------------------------------------
    */

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Maintenance
    |--------------------------------------------------------------------------
    */

    public function maintenance(): BelongsTo
    {
        return $this->belongsTo(
            Maintenace::class,
            'maintenance_id'
        );
    }
}