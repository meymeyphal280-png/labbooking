<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $fillable = [
        'laboratory_id',
        'category_id',
        'equipment_code',
        'equipment_name',
        'image',
        'description',
        'brand',
        'serial_number',
        'purchase_date',
        'condition',
        'status',
        'quantity',
    ];

    /**
     * Equipment belongs to a laboratory.
     */
    public function laboratory()
    {
        return $this->belongsTo(
            Laboratory::class,
            'laboratory_id'
        );
    }

    /**
     * Equipment belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }

    /**
     * Equipment has many maintenance records.
     */
    public function maintenances()
    {
        return $this->hasMany(
            Maintenance::class,
            'equipment_id'
        );
    }
}
