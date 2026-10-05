<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Database table.
     */
    protected $table = 'category__e_p_s';

    /**
     * Mass assignable fields.
     */
    protected $fillable = [
        'category',
    ];

    /**
     * Equipment belonging to this category.
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }
}