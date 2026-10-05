<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminNotification extends Model
{
    use HasFactory;

    /**
     * Database table.
     */
    protected $table = 'admin_notifications';

    /**
     * Your table currently uses created_at
     * but does not require Laravel's updated_at.
     */
    public $timestamps = false;

    /**
     * Mass assignable fields.
     */
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'is_read',
        'created_at',
    ];

    /**
     * Cast database values.
     *
     * created_at becomes a Carbon instance,
     * so ->format() works correctly in Blade.
     */
    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Notification belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

