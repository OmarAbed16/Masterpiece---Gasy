<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truck extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'driver_id',
        'license_plate',
        'company_name',
        'capacity',
        'current_load',
        'status',
        'last_service_date',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
        'last_service_date' => 'date',
    ];

    /**
     * Relationships
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
