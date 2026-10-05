<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_name',
        'faculty',
        'description',
    ];

    /**
     * Department has many users.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Department has many laboratories.
     */
    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }
}