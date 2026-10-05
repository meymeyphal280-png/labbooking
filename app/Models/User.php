<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'department_id',
        'role',
        'status',
        'name',
        'email',
        'phone',
        'password',
        'last_seen_at',
    ];

    /**
     * The attributes that should be hidden.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen_at'      => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Relationship with Department.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Check if the user is currently online.
     *
     * User is considered online when:
     * 1. Their account status is Active.
     * 2. Their last activity was within the last 5 minutes.
     */
    public function isOnline(): bool
    {
        if (strtolower($this->status) !== 'active') {
            return false;
        }

        return $this->last_seen_at
            && $this->last_seen_at->gt(now()->subMinutes(5));
    }

    /**
     * Relationship with Announcements.
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    /**
     * Relationship with Reports.
     *
     * The reports table uses "generated_by"
     * as the foreign key.
     */
    public function reports()
    {
        return $this->hasMany(
            Report::class,
            'generated_by'
        );
    }

    /**
     * User audit logs.
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    |
    | DO NOT add a custom notifications() method here.
    |
    | The Notifiable trait already provides:
    |
    |     $user->notifications
    |     $user->unreadNotifications
    |     $user->readNotifications
    |
    |--------------------------------------------------------------------------
    */
}