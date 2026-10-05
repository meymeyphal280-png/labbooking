<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_name',
        'building_code',
        'number_of_floors',
        'location',
        'status',
        'description',
    ];

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }
}