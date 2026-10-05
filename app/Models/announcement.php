<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'publish_date',
        'expire_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'publish_date' => 'datetime',
            'expire_date'  => 'datetime',
        ];
    }

    /**
     * Get the user that created the announcement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}